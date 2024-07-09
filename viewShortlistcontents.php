<!DOCTYPE html>
<html>
<body>
<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$servername = "127.0.0.1";
$username = "root";
$password = "martin11";
$dbname = "group11_milestone_2";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error); }

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
                s.sentiment,
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
        WHERE u.email = '$email' and sh.sname = '$sname' and
            s.date_shortlisted > DATE_ADD(CURDATE(), INTERVAL -30 DAY);
    "; 

    return $sql;
}

$contents = generate_contents($_POST);
$result = $conn->query($contents);

if ($result->num_rows > 0) {
    // Output the data of each row
    echo "<table border='1'>";
    echo "<tr><th>Company Name</th><th>Company Type</th><th>Sector</th><th>EBITDA</th><th>Sentiment</th><th>Date Shortlisted</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['company_type'] . "</td>";
        echo "<td>" . $row['sector'] . "</td>";
        echo "<td>" . "$" . $row['ebitda'] . "</td>";
        echo "<td>" . $row['sentiment'] . "</td>";
        echo "<td>" . $row['date_shortlisted'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

;
$conn->close();
?>
</body>
</html>