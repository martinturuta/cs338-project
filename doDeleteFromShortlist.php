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
        die("Connection failed: " . $conn->connect_error); 
    }
    $numValues = 0;
    foreach ($_POST as $item) {
        $numValues++;
    }
    $sql = "DELETE FROM shortlist_contains WHERE sid = '".$_SESSION['sid']."' AND company_id IN (";
    foreach ($_POST as $item) {
        $separate =  explode(" ", $item);
        $sql = $sql."'".$separate[0]."'";
        --$numValues;
        if ($numValues != 0) {
            $sql = $sql.",";
        }
    }
    $sql = $sql.");";
    echo $sql;
    $result = $conn->query($sql);

    
    header('Location: ViewShortlists.php')
?>
</body>
</html>