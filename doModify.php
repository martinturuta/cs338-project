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
    $sql = "SELECT id from users WHERE email = '".$_SESSION['email']."';";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $id = $row['id'];
    $sql = "SELECT company_id FROM private_company_ceo WHERE id = '".$id."';";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $company_id = $row['company_id'];
    $sql = "UPDATE company SET ";
    $conditions = array();
    $condCount = 0;
    if (isset($_POST['company_name']) && !empty($_POST['company_name'])) {
        array_push($conditions, "name = '".$_POST['company_name']."'");
        $condCount++;
    }
    if (isset($_POST['sector']) && !empty($_POST['sector'])) {
        array_push($conditions, "sector = '".$_POST['sector']."'");
        $condCount++;
    }
    if (isset($_POST['ebitda']) && !empty($_POST['ebitda'])) {
        array_push($conditions, "ebitda = '".$_POST['ebitda']."'");
        $condCount++;
    }
    if (isset($_POST['rev_growth']) && !empty($_POST['rev_growth'])) {
        array_push($conditions, "revenue_growth = '".$_POST['rev_growth']."'");
        $condCount++;
    }
    if (!empty($conditions)) {
        foreach ($conditions as $condition) {
            $sql = $sql.$condition;
            --$condCount;
            if ($condCount != 0) {
                $sql = $sql.",";
            }
        }
        $sql = $sql." WHERE company_id = '".$company_id."';";
        $result = $conn->query($sql);
    }

    if (isset($_POST['valuation']) && !empty($_POST['valuation'])) {
        $sql = "UPDATE private_company SET valuation= '".$_POST['valuation']."' WHERE company_id='".$company_id."';";
        $result = $conn->query($sql);
    }
    
    $conn->close();
    header('Location: modifyCompInfo.php');
?>
</body>
</html>