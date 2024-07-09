<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//db connections
$servername = "127.0.0.1";
$username = "root";
$password = "password";
$dbname = "testDB";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error); }


// retreive info 
$email = $_SESSION['email'];
// $username = 'testing';
$sname = $_POST['sname'] ;
echo $sname;


function add_shortlist($shortlist_name, $email, $conn) {

    if($shortlist_name != '') {

    $id = "
        SELECT id from USERS
        WHERE email = '$email';
    ";
    $result = $conn->query($id);
    $row = $result->fetch_assoc();
    $sql = "
        INSERT INTO SHORTLIST (sname, user_id)
        VALUES ('$shortlist_name', " . $row['id'] . ");
    ";

    return $sql; }

    else { header('Location: ViewShortlists.php'); }
}

$contents = add_shortlist($sname, $email, $conn);
$result = $conn->query($contents);

header('Location: ViewShortlists.php');
?> 