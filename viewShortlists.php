<!DOCTYPE html>
<html>
<body>

<?php 

$servername = "127.0.0.1";
$username = "Sathus";
$password = "Husan2404!";
$dbname = "testDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error); }

function retreive_shortlists($post) {

     // $username = $post['username'];
     $username = 'testing';

    $sql = "
        select 
            sname
        from shortlist s
        left join users u
            on u.id = s.user_id
        where u.username = '$username'
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
            echo "<td>". "<div class='centered'><a href='viewShortlistcontents.php?sname=" . $row['sname'] . "' class='view-shortlis-contents-btn'> View</a></div>". "</td>";
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
