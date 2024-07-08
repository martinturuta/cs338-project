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

    if ($result->num_rows > 0) {
        // Output the data of each row
        echo "<table border='1'>";
        echo "<tr><th>Shortlist Name</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['sname'] . "</td>";
            echo "<td>". "<div class='centered'><a href='viewShortlistcontents.php' class='view-shortlis-contents-btn'> View</a></div>". "</td>";
            echo "</tr>";
        }
        // adding a new row for adding shortlists 
        echo "<td>" . "<input type='text' name='shortlist_name'>" . "</td>";
        echo "<td>" . 
            '<form method="post">
            <button type="submit" name="submit"> Add </button>
            </form>'
            .
        "</td>";
        echo "</table>";
    } else {
        echo "0 results";
    }


}


function delete_shortlist($post) {

}

function add_shortlist($_POST) {
    



    $sql = "
    INSERT INTO SHORTLIST VALUES
        ('asdfg', 'Test', 1);
    "; 

}

// execute window 

display_contents($conn)






?> 
</body>
</html>
