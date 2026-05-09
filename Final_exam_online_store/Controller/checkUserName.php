<?php
include "../Model/db.php";

$username=$_POST["username"];
if(!$username)
{
    echo "Please enter a username";
}
else
{
    $database=new db();
    $connection=$database->connection();
    $result=$database->checkUser($connection, "customer", $username);
    if($result->num_rows>0)
    {
        echo "Username already exists";
    }
    else
    {
        echo "Username is available";
    }

}
?>