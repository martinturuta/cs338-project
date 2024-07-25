<!DOCTYPE html>
<html>
<body>
<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$servername = "127.0.0.1";
$username = "Sathus";
$password = "Husan2404!";
$dbname = "testdb";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error); }

function generate_Summary($post) {

    $sql = "
           SELECT COUNT(*) AS Total_Company, MAX(ebitda) AS Highest_EBITDA,
   	       MIN(ebitda) AS Lowest_EBITDA,
    	   MAX(revenue_growth) AS Highest_RevGrowth,
    	   MIN(revenue_growth) AS Lowest_RevGrowth
           FROM COMPANY;
    "; 

    return $sql;
}

$Summary = generate_Summary($_POST);
$result = $conn->query($Summary);

if ($result->num_rows > 0) {
    // Output the data of each row
    echo "<table border='1'>";
    echo "<tr><th>Total Company</th><th>Highest EBITDA</th><th>Lowest EBITDA</th><th>Highest Revenue Growth</th><th>Lowest Revenue Growth</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['Total_Company'] . "</td>";
        echo "<td>" . $row['Highest_EBITDA'] . "</td>";
        echo "<td>" . $row['Lowest_EBITDA'] . "</td>";
        echo "<td>" . "$" . $row['Highest_RevGrowth'] . "</td>";
        echo "<td>" . $row['Lowest_RevGrowth'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
?>

<div style="margin-top: 20px;">
    <a href="index.php" style="text-decoration: none; padding: 10px 20px; background-color: #007bff; color: white; border-radius: 5px;">Back</a>
</div>

</body>
</html> 