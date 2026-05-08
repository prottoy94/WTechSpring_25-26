<?php
session_start();
include "../Model/db.php";

$name="";
$password="";
$data_file="../data.json";

if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $name=$_POST["username"]??"";
        $password=$_POST["password"]??"";
        
        if(!empty($name)&&!empty($password))
        {
            $database= new db();
            $connection=$database->connection();
            $result=$database->signin($connection, "customer", $name, $password);

            if($result && $result->num_rows > 0)
            {
                setcookie("name", $name, time()+3600*2, "/");
                $_SESSION["name"]=$name;

                setcookie("password", $password, time()+3600*2, "/");
                $_SESSION["password"]=$password;

                $formdata=array("Name"=>$name, "Password"=>$password);
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

                header("Location: ../View/userDashboard.php");
                exit();
            }
            else
            {
                echo "Invalid username or password";
            }
        }
    }
?>
