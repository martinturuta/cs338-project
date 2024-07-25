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
    // $sql = "SELECT id from USERS WHERE email = '".$_SESSION['email']."';";
    // $result = $conn->query($sql);
    // $row = $result->fetch_assoc();
    // $id = $row['id'];
    $numValues = 0;
    foreach ($_POST as $item) {
        $numValues++;
    }
    $sql = "INSERT INTO shortlist_contains(sid, company_id) VALUES ";
    foreach ($_POST as $item) {
        $separate =  explode(" ", $item);
        $sql = $sql."('".$_SESSION['sid']."', '".$separate[0]."')";
        --$numValues;
        if ($numValues != 0) {
            $sql = $sql.",";
        }
    }
    $sql = $sql.";";
    echo $sql;
    $result = $conn->query($sql);

    
    header('Location: ViewShortlists.php')
?>
</body>
</html>