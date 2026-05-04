<?php

include "../Model/db.php";

$username = trim($_POST["username"] ?? "");

if(!$username)
{
    echo "Username is required";
    exit();
}
else
{
    $database = new db();
    $connection = $database->connection();
    $result = $database->checkUser($connection, "registration", $username);
    
    if($result && $result->num_rows > 0)
    {
        echo "Username has already taken";
    }
    else
    {
        echo "Username is available";
    }
}
?>
