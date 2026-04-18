<?php

session_start();

if(empty($_POST['username'])||empty($_POST['password']))
    {
        echo "Error: All fields are required.";
        exit();
    }
    else
        {
            $username=$_POST['username'];
            $password=$_POST['password'];
        }

if($username == 'admin' && $password == 'admin')
{
    $_SESSION['username']=$username;

    if (isset($_POST['remember'])) {
        setcookie("username", $username, time() + 86400);
    }

    header("Location: ../Dashboard/dashboard.php");
    exit();
}