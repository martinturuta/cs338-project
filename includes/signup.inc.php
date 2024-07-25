<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST["submit"])) {
    include '../project_db.php';

    $email = $_POST["email"];
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $companyName = $_POST["companyName"];
    $companySector = $_POST["companySector"];
    $ebitda = $_POST["ebitda"];
    $revenueGrowth = $_POST["revenueGrowth"];
    $valuation = $_POST["valuation"];
    $startingDate = $_POST["startingDate"];

    // Check for empty fields
    if (empty($email) || empty($username) || empty($pwd)) {
        header("Location: ../signup.php?error=emptyinput");
        exit();
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidemail");
        exit();
    }

    // Check for valid username
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invalidusername");
        exit();
    }

    // Check if email already exists
    $sql = "SELECT id FROM USERS WHERE email = ?";
    $query = $conn->prepare($sql);
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        header("Location: ../signup.php?error=emailtaken");
        exit();
    }

    // Hash the password
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    // Insert new user into the database
    $sql = "INSERT INTO USERS (email, username, password) VALUES (?, ?, ?)";
    $query = $conn->prepare($sql);
    $query->bind_param("sss", $email, $username, $hashedPwd);
    $query->execute();

    $userId = $conn->insert_id;
    
    if ($userId === 0) {
        echo "Error retrieving user ID.<br>";
        exit();
    }

    $_SESSION["email"] = $email;
    if (isset($_POST["userRole"]) && $_POST["userRole"] === "ceo") {
        $_SESSION["userRole"] = $_POST["userRole"];
        $sql = "INSERT INTO COMPANY (name, sector, ebitda, revenue_growth) VALUES (?, ?, ?, ?)";
        $query = $conn->prepare($sql);
        $query->bind_param("ssss", $companyName, $companySector, $ebitda, $revenueGrowth);
        $query->execute();

        $sql = "SELECT company_id FROM COMPANY WHERE name = ?";
        $query = $conn->prepare($sql);
        $query->bind_param("s", $companyName);
        $query->execute();
        $result = $query->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $companyId = $row['company_id'];
        } else {
            echo "Error retrieving company ID.<br>";
            exit();
        }

        $sql = "INSERT INTO PRIVATE_COMPANY (company_id, valuation) VALUES (?, ?)";
        $query = $conn->prepare($sql);
        $query->bind_param("ss", $companyId, $valuation);
        $query->execute();

        $sql = "INSERT INTO Private_Company_CEO (id, company_id, starting_date) VALUES (?, ?, ?)";
        $query = $conn->prepare($sql);
        $query->bind_param("sss", $userId, $companyId, $startingDate);
        $query->execute();
    } else if (isset($_POST["userRole"]) && $_POST["userRole"] === "investor") {
        $sql = "INSERT INTO INVESTORS (id) VALUES (?)";
        $query = $conn->prepare($sql);
        $query->bind_param("s", $userId);
        $query->execute();
    }

    header("Location: ../index.php");
    exit();

    $query->close();
    $conn->close();
} else {
    header("Location: ../signup.php");
    exit();
}
?>