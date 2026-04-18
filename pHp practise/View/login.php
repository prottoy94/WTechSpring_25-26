<?php

session_start();

$remembered_user="";
if (isset($_COOKIE['username']))
    {
        $remembered_user=$_COOKIE['username'];
    }
else
    {
        $remembered_user="No user remembered";
    }
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <h2>Login Form</h2>
    <form action="../Controller/process.php" method="post">
        User name: <input type="text" name="username" value="<?php echo $remembered_user; ?>"><br><br>
        Password: <input type="password" name="password"><br><br>

        Remember me: <input type="checkbox" name="remember"><br><br>
        <input type="submit" value="login">
    </form>
</body>
</html>