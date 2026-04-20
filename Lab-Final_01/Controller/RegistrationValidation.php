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
            $ccname="Name: ".$name;
            setcookie("name", $name, time() + (86400 * 30), "/");
            $_SESSION["name"]=$name;
        }
        else
        {
            $ccname="Please fill up the NAME FIELD properly";
        }

        if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $ccemail="Email accecpted";
            setcookie("email", $email, time() + (86400 * 30), "/");
            $_SESSION["email"]=$email;
        }
        else
        {
            $ccemail="Please fill up the EMAIL FIELD properly";
        }

        if(!empty($website))
        {
            if(preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $website))
            {
                $ccwebsite="Valid Website";
                setcookie("website", $website, time() + (86400 * 30), "/");
                $_SESSION["website"]=$website;
            }
            else
            {
                $ccwebsite="Invalid Website format :(( [https://www.website.com] ";
            }
        }
        else
        {
            $ccwebsite="Please fill up the URL properly";
        }

        if(!empty($comment))
        {
            setcookie("comment", $comment, time() + (86400 * 30), "/");
            $_SESSION["comment"]=$comment;
            $cccomment="Comment: " . $comment;
        }
        else
        {
            $cccomment="Please fill up the COMMENT section ";
        }

        if(!empty($gender))
        {
            setcookie("gender", $gender, time() + (86400 * 30), "/");
            $_SESSION["gender"]=$gender;
            $ccgender="Gender: " . $gender;
        }
        else
        {
            $ccgender="Please fill up the GENDER section ";
        }

    }
    // JSON part
    $formdata=array("Name"=>$name, "Password"=>$password, "Website"=>$website, "Comment"=>$comment, "Gender"=>$gender);

    if(file_exists($data_file))
    {
        $existdata=file_get_contents($data_file);
        $tempdata=json_decode($existdata, true);
    }
    else
    {
        $tempdata=array();
    }

    if(!is_array($tempdata))
    {
        $tempdata=array();
    }

    $tempdata[]=$formdata;
    $jsondata=json_encode($tempdata, JSON_PRETTY_PRINT);

    if(file_put_contents($data_file, $jsondata)==false)
    {
        echo "Data saved to the file.";
    }
    else
    {
        echo "Data saved";
    }
?>