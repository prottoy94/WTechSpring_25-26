<?php
session_start();

$name=$_SESSION["name"];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>User Dashboard</title>
    </head>
    <body>
        <h1>Welcome, <?php echo $name; ?></h1>
    </body>
</html>