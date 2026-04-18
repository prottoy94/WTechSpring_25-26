<?php

session_start();

if(!isset($_SESSION['username']))
    {
        header("Location: ../View/login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <body>
        <h2> WELCOME TO THE DASHBOARD <?php echo $_SESSION['username']; ?></h2>
        <a href="../Controller/logout.php">Logout</a>
    </body>
</html>