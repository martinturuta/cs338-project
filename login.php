<?php
    include_once 'index.php'
?>

<section class="signup-form">
    <h2 style="text-align: center; color: white">Log In</h2>
    <div class="login-form-form">
        <form action="includes/login.inc.php" method="post">
            <input type="text" name="uid" placeholder="Username/Email...">
            <input type="password" name="pwd" placeholder="Password...">
            <button type="submit" name="submit">Log In</button>
        </form>
    </div>
    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<h1 style='text-align: center; color: blue'>Fill in all fields!</h1>";
        } else if ($_GET["error"] == "wronglogin") {
            echo "<h1 style='text-align: center; color: blue'>Incorrect login information!</h1>";
        }
    }
    ?>
</section>
</html>