<?php
    include_once 'index.php'
?>

<section class="signup-form">
    <h2 style="text-align: center; color: white">Sign Up</h2>
    <div class="signup-form-form">
        <form action="includes/signup.inc.php" method="post">
            <input type="text" name="name" placeholder="Full name...">
            <input type="text" name="email" placeholder="Email...">
            <input type="text" name="uid" placeholder="Username...">
            <input type="password" name="pwd" placeholder="Password...">
            <input type="password" name="pwdrepeat" placeholder="Repeat password...">
            <button type="submit" name="submit">Sign Up</button>
        </form>
    </div>
    <div class="confirm-form">
        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<h1 style='text-align: center; color: blue'>Fill in all fields!</h1>";
            } else if ($_GET["error"] == "invaliduid") {
                echo "<h1 style='text-align: center; color: blue'>Choose a proper username!</h1>";
            } else if ($_GET["error"] == "invalidemail") {
                echo "<h1 style='text-align: center; color: blue'>Choose a proper email!</h1>";
            } else if ($_GET["error"] == "pwddontmatch") {
                echo "<h1 style='text-align: center; color: blue'>Passwords do not match!</h1>";
            } else if ($_GET["error"] == "stmtfailed") {
                echo "<h1 style='text-align: center; color: blue'>Something went wrong, try again!</h1>";
            } else if ($_GET["error"] == "usernametaken") {
                echo "<h1 style='text-align: center; color: blue'>Username already taken!</h1>";
            } else if ($_GET["error"] == "none") {
                echo "<h1 style='text-align: center; color: blue'>You have signed up!</h1>";
            }
        }
        ?>
    </div>
</section>

</html>