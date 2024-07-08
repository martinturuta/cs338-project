<!DOCTYPE html>
<html>
<body>
<?php
$servername = "127.0.0.1";
$username = "root";
$password = "martin11";
$dbname = "group11";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error); }


function generate_contents($post) {

    //$username = $post['username'];
    //$sname = $post['sname'];

    $username = 'testing';
    $sname = 'Tech companies';

    $sql = "
        select 
            s.*, 
            c.*
        from SHORTLIST_CONTAINS s
        left join company c
            on c.company_id = s.company_id
        left join users u
            on u.id = s.user_id
        left join shortlist sh
            on sh.sid = s.sid
    where u.username = '$username' and sh.sname = '$sname'
    "; 

    return $sql;
}

$contents = generate_contents($_POST);

$result = $conn->query($contents);

if ($result->num_rows > 0) {
    // Output the data of each row
    echo "<table border='1'>";
    echo "<tr><th>Company Name</th><th>Sector</th><th>EBITDA</th><th>Sentiment</th><th>Date Shortlisted</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
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