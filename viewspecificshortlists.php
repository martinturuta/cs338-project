<!DOCTYPE html>
<html>
<body>
<div style="margin-top: 30px; margin-bottom: 30px;">
    <a href="viewshortlistsinfo.php" style="text-decoration: none; padding: 10px 20px; background-color: #007bff; color: white; border-radius: 5px;">Back</a>
</div>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    function getUserIdByEmail($email) {
        $sql = "SELECT id FROM users WHERE email='".$email."';";
        return $sql;
    }
    function sqlToGetShortlistIds($post, $userId) {
        $company = "c";
        $conditions = array();
        $condCount = 0;

        if (isset($post['company_name']) && !empty($post['company_name'])) {
            array_push($conditions, $company.".name = '".$post['company_name']."'");
            $condCount++;
        }
        if (isset($post['sector']) && !empty($post['sector'])) {
            array_push($conditions, $company.".sector = '".$post['sector']."'");
            $condCount++;
        }
        if (isset($post['ebitda_radio']) && isset($post['ebitda']) && (!empty($post['ebitda']) || $post['ebitda'] == 0)) {
            array_push($conditions,$company.".ebitda ".$post['ebitda_radio']. " ". $post['ebitda'] );
            $condCount++;
        }
        if (isset($post['rev_radio']) && isset($post['rev_growth']) && (!empty($post['rev_growth']) || $post['rev_growth'] == 0)) {
            array_push($conditions,$company.".revenue_growth ".$post['rev_radio']. " ". $post['rev_growth'] );
            $condCount++;
        }
        $sql = "";
        $shortlistContains = "sc";
        if (!empty($conditions)) {
            $sql = "SELECT DISTINCT sc.sid FROM shortlist_contains sc JOIN COMPANY c ON sc.company_id = c.company_id WHERE ";
            foreach ($conditions as $condition) {
                $sql = $sql.$condition;
                --$condCount;
                if ($condCount != 0) {
                    $sql = $sql." AND ";
                }
            }
        } else {
            $sql = "SELECT sc.sid FROM shortlist sc WHERE user_id='".$userId."'";
        }
        $sql = $sql. " LIMIT 20;";

        return $sql;
    }
    function getShortlistInfo($shortlistIds, $numIds) {
        $sql = "SELECT s.sname from shortlist s WHERE s.sid IN (";
        foreach ($shortlistIds as $id) {
            $sql = $sql."'".$id."'";
            --$numIds;
            if ($numIds != 0) {
                $sql = $sql.",";
            }
        }
        $sql = $sql.");";
        return $sql;

    }
    function display_contents($result) {
        // Output the data of each row
        echo "<table border='1'>";
        echo "<tr><th>Shortlist Name</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['sname'] . "</td>";
            // ability to view shortlist 
            $_SESSION["route"] = 1;
            echo "<td>". "<div class='centered'><a href='viewShortlistcontents.php?sname=" . $row['sname'] . "' class='view-shortlis-contents-btn'> View</a></div>". "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    $servername = "127.0.0.1";
    $username = "root";
    $password = "password";
    $dbname = "testdb";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error); 
    }
    $queryToGetUserId = getUserIdByEmail($_SESSION["email"]);
    $result = $conn->query($queryToGetUserId);
    $userId = $result->fetch_assoc()["id"];
    $sqlStatement = sqlToGetShortlistIds($_POST, $userId);
    $result = $conn->query($sqlStatement);
    $shortlistIds = array();
    $numIds = 0;
    while($row = $result->fetch_assoc()) {
        array_push($shortlistIds, $row['sid']);
        $numIds++;
    }
    if ($numIds > 0) {
        $queryToGetShortlistNames = getShortlistInfo($shortlistIds, $numIds);
        $result = $conn->query($queryToGetShortlistNames);
        display_contents($result);
    } else {
        echo "No shortlists were found that contain the specifics provided. Please provide the correct details.";
    }
    $conn->close();
?>
</body>
</html>