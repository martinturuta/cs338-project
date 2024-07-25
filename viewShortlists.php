<!DOCTYPE html>
<html>
<body>
<div style="margin-top: 30px; margin-bottom: 30px;">
    <a href="index.php" style="text-decoration: none; padding: 10px 20px; background-color: #007bff; color: white; border-radius: 5px;">Back</a>
</div>

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

function retreive_shortlists($post) {
    $email = $_SESSION['email'];
    $sql = "
        select 
            sid, sname
        from shortlist s
        left join users u
            on u.id = s.user_id
        where u.email = '$email'
        "; 
    return $sql;
}

function display_contents($connection) {
    $contents = retreive_shortlists($_POST);
    $result = $connection->query($contents);
    // Output the data of each row
    echo "<table border='1'>";
    echo "<tr><th>Shortlist Name</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['sname'] . "</td>";
        // ability to view shortlist 
        $_SESSION["route"] = 2;
        echo "<td>". "<div class='centered'><a href='viewShortlistcontents.php?sname=" . $row['sname'] . "' class='view-shortlis-contents-btn'> View</a></div>". "</td>";
        // add company to shortlist
        echo "<td>". "<div class='centered'><a href='addToShortlist.php?sname=" . $row['sname'] . "&"."sid=". $row['sid']."' class='view-shortlis-contents-btn'> Add to Shortlist </a></div>". "</td>";
        // delete company from shortlist
        echo "<td>". "<div class='centered'><a href='deleteFromShortlist.php?sname=" . $row['sname'] . "&"."sid=". $row['sid']."' class='view-shortlis-contents-btn'> Delete From Shortlist </a></div>". "</td>";
        // ability to delete shortlist
        echo "<td>". "<div class='centered'><a href='Deleteshortlist.php?sname=" . $row['sname'] . "' class='view-shortlis-contents-btn'> Delete </a></div>". "</td>";
        echo "</tr>";
    }
    // adding a new row for adding shortlists, execute Addshortlist.php
    echo  "<form action = 'Addshortlist.php' method='post'>";
    echo "<td>" . "<input type='text' name='sname'>" . "</td>";
    echo "<td>" . "<button type='submit' name='submit'> Add </button>".
        "</form>".
    "</td>";
    echo "</table>";
}

// execute window 
display_contents($conn)
?>

</body>
</html>
