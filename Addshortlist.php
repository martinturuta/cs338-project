<?php

//db connections
$servername = "127.0.0.1";
$username = "Sathus";
$password = "Husan2404!";
$dbname = "testDB";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error); }


// retreive info 
$username = 'testing';
$sname = $_POST['sname'] ;


function add_shortlist($shortlist_name) {

    if($shortlist_name != '') {

    $id =  rand(pow(10, 5-1), pow(10, 5)-1);  

    $sql = "
        INSERT INTO SHORTLIST 
        VALUES ('$id', '$shortlist_name', 1);
    "; 

    return $sql; }

    else { header('Location: ViewShortlists.php'); }
}

$contents = add_shortlist($sname);
$result = $conn->query($contents);

header('Location: ViewShortlists.php')



?> 