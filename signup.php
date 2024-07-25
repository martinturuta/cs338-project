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

            <select id="userRole" name="userRole" required>
                <option value="">Select Role...</option>
                <option value="investor">Investor</option>
                <option value="ceo">CEO</option>
            </select>

            <div id="ceoFields" style="display: none;">
                <input type="text" name="companyName" placeholder="Company Name..." required>
                <input type="text" name="companySector" placeholder="Company Sector..." required>
                <input type="text" name="ebitda" placeholder="EBITDA..." required>
                <input type="text" name="revenueGrowth" placeholder="Revenue Growth..." required>
                <input type="text" name="valuation" placeholder="Valuation..." required>
                <input type="text" name="startingDate" placeholder="Starting Date..." required>
            </div>

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

<script>
    document.getElementById('userRole').addEventListener('change', function () {
        var ceoFields = document.getElementById('ceoFields');
        var ceoInputs = ceoFields.querySelectorAll('input');

        if (this.value === 'ceo') {
            ceoFields.style.display = 'block';
            ceoInputs.forEach(function(input) {
                input.setAttribute('required', true);
            });
        } else {
            ceoFields.style.display = 'none';
            ceoInputs.forEach(function(input) {
                input.removeAttribute('required');
            });
        }
    });
</script>
