<?php
    include_once 'index.php'
?>

<section class="signup-form">
    <h2 style="text-align: center; color: white">Log In</h2>
    <div class="login-form-form">
        <form action="includes/login.inc.php" method="post">
            <input type="text" name="username" placeholder="Username/Email...">
            <input type="password" name="pwd" placeholder="Password...">
            <button type="submit" name="submit">Log In</button>
        </form>
    </div>
    <div class="confirm-form">
        <?php
        if (isset($_GET["error"])) {
            $errorMessages = [
                "emptyinput" => "Fill in all fields!",
                "wrongpassword" => "Incorrect password!",
                "nouser" => "User doesn't exist!",
                "none" => "Welcome!"
            ];
            $error = $_GET["error"];
            if (array_key_exists($error, $errorMessages)) {
                echo "<h1 style='text-align: center; color: white'>{$errorMessages[$error]}</h1>";
            } else {
                echo "<h1 style='text-align: center; color: white'>Unexpected error occurred!</h1>";
            }
        }
        ?>
    </div>
</section>
</html>