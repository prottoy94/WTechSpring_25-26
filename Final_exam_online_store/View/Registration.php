<?php
include "../Controller/registration_validation.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Registration</title>
    </head>
    <body>
        <div class="container">
            <h1>Registration</h1>
            <form method="post" action="">
                <label for="username">Username: </label>
                <input type="text" id="username" name="username" required><?php echo $ccname; ?><br><br>

                <label for="password">Password: </label>
                <input type="password" id="password" name="password"><?php echo $ccpassword; ?><br><br>

                <label for="email">Email: </label>
                <input type="email" id="email" name="email"><?php echo $ccemail; ?><br><br>

                <label for="gender">Gender: </label>
                <input type="radio" id="male" name="gender" value="male"> Male
                <input type="radio" id="female" name="gender" value="female"> Female <?php echo $ccgender; ?><br><br>

                <button type="submit"> Register</button><br><br>
                <a href="login.php"> Already have an account? Login here</a>


            </form>   
        </div>
    </body>
</html>