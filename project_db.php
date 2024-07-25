<!DOCTYPE html>
<html>
    <body>
    <?php
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
    ?>
    </body>
</html