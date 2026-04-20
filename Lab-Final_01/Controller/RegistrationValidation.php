<?php

session_start();

$name="";
$email="";
$website="";
$comment="";
$gender="";

$ccname="";
$ccemail="";
$ccwebsite="";
$cccomment="";
$ccgender="";

$data_file="../data.json";

if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $name=$_POST["name"];
        $email=$_POST["email"];
        $website=$_POST["website"];
        $comment=$_POST["comment"];
        $gender=$_POST["gender"];

        if(!empty($name) && strlen($name)>5)
        {
            $name="Name: ".$name;
            setcookie("name", $name, time() + (86400 * 30), "/");
            $_SESSION["name"]=$name;
        }
        else
        {
            $name="Please fill up the NAME FIELD properly";
            echo "Please fill up the NAME FIELD properly ";
        }

        if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $email="Email accecpted";
            setcookie("email", $email, time() + (86400 * 30), "/");
            $_SESSION["email"]=$email;
        }
        else
        {
            $email="Please fill up the EMAIL FIELD properly";
        }

        if(!empty($website))
        {
            if(preg_match("/^(https?:\/\/)?(www\.)?[a-zA-Z0-9][a-zA-Z0-9-]*\.[a-zA-Z]{2,}([\/?#][a-zA-Z0-9-._~:\/?#\[\]@!$&'()*+,;=]*)?$/", $website))
            {
                $website="Valid Website";
                setcookie("website", $website, time() + (86400 * 30), "/");
                $_SESSION["website"]=$website;
            }
            else
            {
                $website="Invalid Website format :(( [https://www.website.com] ";
            }
        }
        else
        {
            $website="Please fill up the URL properly";
            echo "Please fill up the URL properly ";
        }

        if(!empty($comment))
        {
            setcookie("comment", $comment, time() + (86400 * 30), "/");
            $_SESSION["comment"]=$comment;
            echo "Comment: " . $comment;
        }
        else
        {
            echo "Please fill up the COMMENT section ";
        }

        if(!empty($gender))
        {
            setcookie("gender", $gender, time() + (86400 * 30), "/");
            $_SESSION["gender"]=$gender;
            echo "Gender: " . $gender;
        }
        else
        {
            echo "Please fill up the GENDER section ";
        }

    }

?>