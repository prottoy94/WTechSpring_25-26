<?php


$name="";
$password="";
$website="";
$comment="";
$gender="";

$ccname="";
$ccpassword="";
$ccwebsite="";
$cccomment="";
$ccgender="";


if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $name=$_POST["name"];
        $password=$_POST["password"];
        $website=$_POST["website"];
        $comment=$_POST["comment"];
        $gender=$_POST["gender"];

        /*$name=$_REQUEST["name"];
        $password=$_REQUEST["password"];*/

        if(!empty($name) && strlen($name)>5)
        {
            $name="Name: ".$name;
        }
        else
        {
            echo "Please fill up the NAME FIELD properly";
        }
        if(!empty($password) && strlen($password)>8)
        {
            $password="Password accecpted";
        }
        else
        {
            $password="Please fill up the PASSWORD FIELD properly";
            echo "Please fill up the PASSWORD FIELD properly";
        }
        if(!empty($website))
        {
            if(!preg_match("/\b(?:https?|ftp):\/\/[-A-Za-z0-9+&@#\/%?=~_|!:,.;]*[-A-Za-z0-9+&@#\/%=~_|]/",$website));
        }
        else
        {
            echo "Please fill up the URL properly";
        }
        if(!empty($comment))
        {
            echo "Comment: " . $comment;
        }
        else
        {
            echo "Please fill up the COMMENT section";
        }
        if(!empty($gender))
        {
            echo "Gender: " . $gender;
        }
        else
        {
            echo "Please fill up the GENDER section";
        }
    }

?>