<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_POST["submit"])) {
    include '../project_db.php';

    $email = $_POST["email"];
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

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

    // Check for valid username (e.g., no special characters)
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invalidusername");
        exit();
    }

    // Check if email already exists
    $sql = "SELECT * FROM USERS WHERE email = ?";
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
    $userId = $conn->insert_id;

    if ($query->execute()) {
        $_SESSION["email"] = $email;

        $sql = "INSERT INTO COMPANY(name, sector, ebitda, revenue_growth) VALUES (?, ?, ?, ?)";
        $query = $conn->prepare($sql);
        $query->bind_param("sssd", $companyName, $companySector, $ebitda, $revenueGrowth);

        if (isset($_POST["userRole"]) && $_POST["userRole"] === "ceo") {
            $companyName = $_POST["companyName"];
            $companySector = $_POST["companySector"];
            $ebitda = $_POST["ebitda"];
            $revenueGrowth = $_POST["revenueGrowth"];
            $valuation = $_POST["valuation"];
            $startingDate = $_POST["startingDate"];

            $sql = "SELECT company_id FROM COMPANY WHERE name = ?";
            $query = $conn->prepare($sql);
            $query->bind_param("s", $companyName);
            if ($query->execute()) {
                $result = $query->get_result();
                $row = $result->fetch_assoc();
                $companyId = $row['company_id'];
            }

            $sql = "INSERT INTO PRIVATE_COMPANY(company_id, valuation) VALUES (?, ?)";
            $query = $conn->prepare($sql);
            $query->bind_param("is", $companyId, $valuation);
            
            $sql = "INSERT INTO Private_Company_CEO(company_id, starting_date) VALUES (?, ?)";
            $query = $conn->prepare($sql);
            $query->bind_param("is", $companyId, $startingDate);
        } else if (isset($_POST["userRole"]) && $_POST["userRole"] === "investor") {
            $sql = "INSERT INTO INVESTORS(id) VALUES (?)";
            $query = $conn->prepare($sql);
            $query->bind_param("i", $userId);
        }
        header("Location: ../index.php");
        exit();
    } else {
        header("Location: ../signup.php?error=queryfailed");
        exit();
    }

    // Close the query and connection
    $query->close();
    $conn->close();
} else {
    header("Location: ../signup.php");
    exit();
}
?>
