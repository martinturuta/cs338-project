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

    if ($query->execute()) {
        session_start();
        $_SESSION["email"] = $email;
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
