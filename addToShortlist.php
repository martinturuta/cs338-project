<!DOCTYPE html>
<html>
<body>
<div style="margin-top: 30px; margin-bottom: 30px;">
    <a href="viewshortlists.php" style="text-decoration: none; padding: 10px 20px; background-color: #007bff; color: white; border-radius: 5px;">Back</a>
</div>
<form action="doInsertToShortlist.php" method="POST">
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    $sid =  $_GET['sid'];
    $sql = "SELECT company_id, name  FROM company where company_id not in (SELECT company_id FROM shortlist_contains WHERE sid ='".$sid."');";
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
    $result = $conn->query($sql);
    $conn->close();
    $total = 0;
    while($row = $result->fetch_assoc()) {
        echo "<input type='checkbox' id='".$row['company_id'].$total."' name='".$row['company_id'].$total."' value='".$row['company_id']." ".$total."'>";
        echo "<label for='".$row['company_id'].$total."'>".$row['name']."</label><br>\n";
        $total++;
    }

    $_SESSION['sid'] = $sid;
    echo "<input type='submit'>";
?>
</form>
</body>
</html>