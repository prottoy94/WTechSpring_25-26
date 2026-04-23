<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>
<body>
    <h2>
        Welcome <?php echo $_SESSION["name"]; ?> to your Dashboard 
    </h2>
    <br><br>
    <button><a href="login.php">Logout</a></button><br><br>
    <button><a href="Registration.php">Go to Registration Page</a></button>
</body>
</html>