<?php
    include_once 'index.php';
?>

<section class="signup-form">
    <h2 style="text-align: center; color: white">Sign Up</h2>
    <div class="signup-form-form">
        <form action="includes/signup.inc.php" method="post">
            <input type="text" name="email" placeholder="Email..." required>
            <input type="text" name="username" placeholder="Username..." required>
            <input type="password" name="pwd" placeholder="Password..." required>
            <button type="submit" name="submit">Sign Up</button>
        </form>
    </div>
    <div class="confirm-form">
        <?php
        if (isset($_GET["error"])) {
            $errorMessages = [
                "emptyinput" => "Fill in all fields!",
                "invalidusername" => "Choose a proper username!",
                "invalidemail" => "Choose a proper email!",
                "queryfailed" => "Something went wrong, try again!",
                "emailtaken" => "Email already taken!",
                "none" => "You have signed up!"
            ];
            $error = $_GET["error"];
            if (array_key_exists($error, $errorMessages)) {
                echo "<h1 style='text-align: center; color: white'>{$errorMessages[$error]}</h1>";
            }
        }
        ?>
    </div>
</section>

</html>