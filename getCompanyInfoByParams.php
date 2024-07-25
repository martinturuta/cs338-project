<!DOCTYPE html>
<html>
<body>

<?php
    function generateSQLForCompanyInfo($post) {
        $sql = "SELECT * FROM COMPANY";
        $table = "";
        $conditions = array();
        $condCount = 0;
        $table = "COMPANY";
        if (isset($post['company_name']) && !empty($post['company_name'])) {
            array_push($conditions, $table.".name = '".$post['company_name']."'");
            $condCount++;
        }
        if (isset($post['sector']) && !empty($post['sector'])) {
            array_push($conditions, $table.".sector = '".$post['sector']."'");
            $condCount++;
        }
        if (isset($post['ebitda_radio']) && isset($post['ebitda']) && (!empty($post['ebitda']) || $post['ebitda'] == 0)) {
            array_push($conditions,$table.".ebitda ".$post['ebitda_radio']. " ". $post['ebitda'] );
            $condCount++;
        }
        if (isset($post['rev_radio']) && isset($post['rev_growth']) && (!empty($post['rev_growth']) || $post['rev_growth'] == 0)) {
            array_push($conditions,$table.".revenue_growth ".$post['rev_radio']. " ". $post['rev_growth'] );
            $condCount++;
        }
        if (!empty($conditions)) {
            $sql = $sql. " WHERE ";
            foreach ($conditions as $condition) {
                $sql = $sql.$condition;
                --$condCount;
                if ($condCount != 0) {
                    $sql = $sql." AND ";
                }
            }
        }
        $sql = $sql. " LIMIT 20";

        return $sql;
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
    $sqlStatement = generateSQLForCompanyInfo($_POST);
    $result = $conn->query($sqlStatement);
    $conn->close();

    echo '<table border="0" cellspacing="2" cellpadding="2"> 
        <tr> 
            <td> Company Name </td> 
            <td> Sector </td> 
            <td> Ebitda </td> 
            <td> Revenue Growth </td> 
        </tr>';

    while ($row = $result->fetch_assoc()) {
        $name = $row["name"];
        $sector = $row["sector"];
        $ebitda = $row["ebitda"];
        $revenue_growth = $row["revenue_growth"]; 

        echo '<tr> 
                <td>'.$name.'</td> 
                <td>'.$sector.'</td> 
                <td>'.$ebitda.'</td> 
                <td>'.$revenue_growth.'</td> 
            </tr>';
    }
?>
</body>
</html>