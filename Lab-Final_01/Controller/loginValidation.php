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
                if($result->num_rows>0)
                {
                    setcookie("name", $name, time() + (86400 * 30), "/"); 
                    setcookie("password", $password, time() + (86400 * 30), "/");
                    $_SESSION["name"]=$name;
                    $_SESSION["password"]=$password;

                    $formdata=array("Name"=>$name, "Password"=>$password);
                    if(file_exists($datafile))
                    {
                        $existsdata=file_get_contents($datafile);
                        $tempdata=json_decode($existsdata, true);
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
                    if(file_put_contents($datafile, $jsondata)!==false)
                    {
                        echo "Data saved to the file.";

                    }
                    else
                    {
                        echo "Data not saved to the file.";
                    }
                    Header("Location: ../View/User_dashboard.php");
                    exit();

                }
            }    
        }
    }
?>