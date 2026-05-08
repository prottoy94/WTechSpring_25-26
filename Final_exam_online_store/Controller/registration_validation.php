<?php
session_start();
include "../Model/db.php";

$name="";
$password="";
$email="";
$gender="";

$isvalid=true;
$data_file="../data.json";

$ccname="";
$ccpassword="";
$ccemail="";
$ccgender="";

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $name=$_POST["username"];
    $password=$_POST["password"];
    $email=$_POST["email"];
    $gender=$_POST["gender"];

    if(!empty($name))
    {
        $ccname=$name;
        setcookie("name", $name, time()+3600*24);
        $_SESSION["name"]=$name;
    }
    else
    {
        $isvalid=false;
        $ccname="Please enter your valid username";
    }
    if(!empty($password)&&strlen($password)>=4)
    {
        $ccpassword=$password;
        setcookie("password", $password, time()+3600*24);
        $_SESSION["password"]=$password;
    }
    else
    {
        $isvalid=false;
        $ccpassword="Please enter a valid password (at least 4 characters)";
    }
    if(!empty($email)&&filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $ccemail=$email;
        setcookie("email", $email, time()+3600*24);
        $_SESSION["email"]=$email;
    }
    else
    {
        $isvalid=false;
        $ccemail="Please enter a valid email address";
    }
    if(!empty($gender))
    {
        $ccgender=$gender;
        setcookie("gender", $gender, time()+3600*24);
        $_SESSION["gender"]=$gender;
    }
    else
    {
        $isvalid=false;
        $ccgender="Please select your gender";  
    }

    if($isvalid)
    {
        $database=new db();
        $connection=$database->connection();
        $isValid=true;

        $result=$database->signup($connection, "customer", $name, $password, $email, $gender);
        if($result)
        {
            echo "<script>alert('Registration successful!');</script>";
            $formdata=array("Name"=>$name, "Password"=>$password, "Email"=>$email, "Gender"=>$gender);

            if(file_exists($data_file))
            {
                $exists_data=file_get_contents($data_file);
                $temp_data=json_decode($exists_data, true);
            }
            else
            {
                $temp_data=array();
            }
            if(!is_array($temp_data))
            {
                $temp_data=array();
            }
            $temp_data[]=$formdata;
            $json_data=json_encode($temp_data, JSON_PRETTY_PRINT);
            file_put_contents($data_file, $json_data);
            header("Location: ../View/login.php");
            exit();
        }
        else
        {
            echo "<script>alert('Registration failed. Please try again.');</script>";
        }

    }
}
?>