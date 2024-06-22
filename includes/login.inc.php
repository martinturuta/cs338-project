<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST["submit"])) {
    include '../project_db.php';
    
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    // Check for empty fields
    if (empty($username) || empty($pwd)) {
        header("Location: ../login.php?error=emptyinput");
        exit();
    }

    // Determine if input is username or email
    if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
        // If input is an email, directly use it for the query
        $email = $username;
    } else {
        // If input is not an email, assume it's a username and find associated email
        $sql = "SELECT email FROM USERS WHERE username = ?";
        $query = $conn->prepare($sql);
        $query->bind_param("s", $username);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $email = $row['email'];
        } else {
            // Username not found
            header("Location: ../login.php?error=nouser");
            exit();
        }
    }

    // SQL query to select user by email
    $sql = "SELECT * FROM USERS WHERE email = ?";
    $query = $conn->prepare($sql);
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();

    if ($row = $result->fetch_assoc()) {
        // Verify password
        $pwdCheck = password_verify($pwd, $row['password']);
        if ($pwdCheck == true) {
            $_SESSION["email"] = $email;
            header("Location: ../index.php");
            exit();
        } else {
            // Incorrect password
            header("Location: ../login.php?error=wrongpassword");
            exit();
        } 
    } else {
        // User not found
        header("Location: ../login.php?error=nouser");
        exit();
    }

    $query->close();
    $conn->close();
} else {
    header("Location: ../login.php");
    exit();
}
?>