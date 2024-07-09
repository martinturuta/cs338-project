<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>CS 338 PROJECT</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    ?>

    <div class="container">
        <div class="nav-wrapper">
            <div class="left-side"></div>
            <div class="right-side">
                <div class="nav-link-wrapper">
                    <a href="index.php">Home</a>
                </div>
                <?php
                if (isset($_SESSION["email"])) {
                    $email = $_SESSION["email"];
                    echo "<div class='nav-link-wrapper'><a>$email</a></div>";
                    echo "<div class='nav-link-wrapper'><a href='includes/logout.inc.php'>Log Out</a></div>";
                    echo "<div class='centered'><a href='viewcompanyinfo.php' class='view-company-info-btn'>View Company Info</a>";
                    echo "<a href='viewShortlists.php' class='view-shortlist-btn'>View Shortlists</a></div>";
                } else {
                    echo "<div class='nav-link-wrapper'><a href='login.php'>Log In</a></div>";
                    echo "<div class='nav-link-wrapper'><a href='signup.php'>Sign Up</a></div>";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>