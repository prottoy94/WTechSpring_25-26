<?php
include "../Model/db.php";
session_start();

$name="";
$password="";

$datafile="../data.json";

if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $name=$_POST["name"];
        $password=$_POST["password"];

        if(!empty($name) && !empty($password))
        {
            $database =new db();
            $connection=$database->connection();
            $result=$database->signin($connection,"registration", $name, $password);
            if($result)
            {
                if(result->num_rows>0)
                {
                    setcookie("name", $name, time() + (86400 * 30), "/"); // 86400 = 1 day
                }
            }    
        }
    }
?>