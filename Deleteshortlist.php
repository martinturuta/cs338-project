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
$sname = $_GET['sname'];


function delete_shortlist($shortlist_name) {

    $id =  rand(pow(10, 5-1), pow(10, 5)-1);  

    $sql = "
       DELETE FROM SHORTLIST
        WHERE sname = '$shortlist_name'
    "; 

    return $sql;
}

$contents = delete_shortlist($sname);
$result = $conn->query($contents);

header('Location: ViewShortlists.php')



?> 