<!DOCTYPE html>
<html>
<body>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$servername = "127.0.0.1";
$username = "root";
$password = "password";
$dbname = "testdb";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error); }

if ($_SESSION["route"] == 1) {
    echo '<div style="margin-top: 30px; margin-bottom: 30px;">
        <a href="viewspecificshortlists.php" style="text-decoration: none; padding: 10px 20px; background-color: #007bff; color: white; border-radius: 5px;">Back</a>
    </div>';
} else {
    echo '<div style="margin-top: 30px; margin-bottom: 30px;">
        <a href="viewshortlists.php" style="text-decoration: none; padding: 10px 20px; background-color: #007bff; color: white; border-radius: 5px;">Back</a>
    </div>';
}

function generate_contents($post) {
    $email = $_SESSION['email'];
    $sname = $_GET['sname'];

    $sql = "
            SELECT 
                c.company_id,
                c.name, 
                c.sector, 
                if(pc.company_id is not null, 'Private Company', 'Public Company') as company_type, 
                pc.valuation, 
                pb.market_cap, 
                pb.market_price, 
                c.ebitda, 
                c.revenue_growth,
                s.date_shortlisted
            FROM SHORTLIST_CONTAINS s
            LEFT JOIN COMPANY c
                ON c.company_id = s.company_id
            LEFT JOIN PRIVATE_COMPANY pc
                ON pc.company_id = c.company_id 
            LEFT JOIN PUBLIC_COMPANY pb
                ON pb.company_id = c.company_id 
            LEFT JOIN SHORTLIST sh
                on sh.sid = s.sid 
            LEFT JOIN USERS u
                ON u.id = sh.user_id
        WHERE u.email = '$email' and sh.sname = '$sname';
    "; 

    return $sql;
}

$contents = generate_contents($_POST);
$result = $conn->query($contents);
$conn->close();
if ($result->num_rows > 0) {
    // Output the data of each row
    echo "<table border='1'>";
    echo "<tr><th>Company Name</th><th>Company Type</th><th>Sector</th><th>EBITDA</th><th>Date Shortlisted</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['company_type'] . "</td>";
        echo "<td>" . $row['sector'] . "</td>";
        echo "<td>" . "$" . $row['ebitda'] . "</td>";
        echo "<td>" . $row['date_shortlisted'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
?>
</body>
</html>