<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//db connections
$servername = "127.0.0.1";
$username = "Sathus";
$password = "Husan2404!";
$dbname = "testdb";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error); }


// retreive info 
$email = $_SESSION['email'];
// $username = 'testing';
$sname = $_GET['sname'];


function delete_shortlist($shortlist_name, $email, $conn) {

    $id = "
        SELECT id from USERS
        WHERE email = '$email';
    ";
    $result = $conn->query($id);
    $row = $result->fetch_assoc();

    $sql = "
        DELETE FROM SHORTLIST
        WHERE sname = '$shortlist_name' AND user_id = " . $row['id'] . "
    ";

    return $sql;
}

$contents = delete_shortlist($sname, $email, $conn);
$result = $conn->query($contents);

header('Location: ViewShortlists.php')



?> 