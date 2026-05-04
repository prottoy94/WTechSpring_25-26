<?php
include "../Model/db.php";
session_start();

$name="";
$password="";
$email="";
$website="";
$comment="";
$gender="";

$ccname="";
$ccpassword="";
$ccemail="";
$ccwebsite="";
$cccomment="";
$ccgender="";
$ccfile="";
$path="";

$data_file="../data.json";

$database = new db();
$connection =$database->connection();
$isValid=true;


if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $name=$_POST["name"] ?? "";
        $password=$_POST["password"] ?? "";
        $email=$_POST["email"] ?? "";
        $website=$_POST["website"] ?? "";
        $comment=$_POST["comment"] ?? "";
        $gender = $_POST["gender"] ?? "";
        $file = $_FILES["file"] ?? null;

        if(!empty($name) && strlen($name)>3)
        {
            $ccname="Name: ".$name;
            setcookie("name", $name, time() + (86400 * 30), "/");
            $_SESSION["name"]=$name;
            
        }
        else
        {
            $ccname="Please fill up the NAME FIELD properly";
            $isValid=false;
        }
        if(!empty($password) && strlen($password)>3)
        {
            $ccpassword="Password accepted";
            setcookie("password", $password, time() + (86400 * 30), "/");
            $_SESSION["password"]=$password;
        }
        else
        {
            $ccpassword="Please fill up the PASSWORD FIELD properly";
            $isValid=false;
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
            $isValid=false;
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
                $isValid=false;
            }
        }
        else
        {
            $ccwebsite="Please fill up the URL properly";
            $isValid=false;
        }
        if($file)
        {
            $target_dir = "../File/";
            $target_file = $target_dir . basename($file["name"]);
            $result = move_uploaded_file($file["tmp_name"], $target_file);
            if ($result) {
                $path = $target_file;
                $ccfile = "File uploaded successfully";
            } else {
                $ccfile = "Sorry, there was an error uploading your file.";
                $isValid=false;
            }
        }
        else
        {
            $path="";
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
            $isValid=false;
        }
        $allowedGenders = ["Female", "Male", "Other"];
        if ($gender !== "" && in_array($gender, $allowedGenders, true))
        {
            setcookie("gender", $gender, time() + (86400 * 30), "/");
            $_SESSION["gender"] = $gender;
            $ccgender = "Gender: " . $gender;
        } 
        else
        {
            $ccgender = "Please fill up the GENDER section";
            $isValid = false;
        }
        if($isValid)
        {
            $result=$database->signup($connection, "registration", $name, $password, $email, $website, $comment, $gender, $path);
            if($result)
            {
                $formdata=array("Name"=>$name, "Password"=>$password, "Email"=>$email, "Website"=>$website, "Comment"=>$comment, "Gender"=>$gender, "FilePath"=>$path);

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
                file_put_contents($data_file, $jsondata);

                Header("Location: ../View/login.php");
                exit();
            }
            else
            {
                echo "Error inserting data: " . $connection->error;
            }
        }
        else
        {
            echo "Please fill up the form properly";
            exit();
        }

    }
?>
