<?php
class db
{
    function connection()
    {
        $db_host="localhost";
        $db_user="root";
        $db_password="";
        $db_name="practise_db";

        $connection= new mysqli($db_host, $db_user, $db_password, $db_name);

        if($connection->connect_error)
        {
            die("Please Conenct the Database: ".$connection->connect_error);
        }
        return $connection;
    }
    function signup($connection, $tablename, $name, $password, $email, $website, $comment, $gender, $file)
    {
        $sql="INSERT INTO $tablename (name, password, email, website, comment, gender, filepath) VALUES ('$name', '$password', '$email', '$website', '$comment', '$gender', '$file')";
        $result=$connection->query($sql);
        return $result;
    }
    function signin($connection, $tablename, $name, $password)
    {
        $sql="SELECT * FROM $tablename WHERE name='$name' AND password='$password'";
        $result=$connection->query($sql);
        return $result;
    }
    function checkUser($connection, $tablename, $name)
    {
        $sql="SELECT * FROM $tablename WHERE name='$name'";
        $result=$connection->query($sql);
        return $result;
    }
}
?>

