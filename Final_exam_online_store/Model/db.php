<?php
class db
{
    function connection()
    {
        $db_host="localhost";
        $db_user="root";
        $db_password="";
        $db_name="exam_practise";

        $connection= new mysqli($db_host, $db_user, $db_password, $db_name);
        if($connection->connect_error)
        {
            die("Could not connect to the database: ".$connection->connect_error);
        }
        return $connection;
    }
    function signup($connection, $tablename, $username, $password, $email, $gender)
    {
        $sql="INSERT INTO ".$tablename."(name, password, email, gender) VALUES ('".$username."', '".$password."', '".$email."', '".$gender."' )";
        $result=$connection->query($sql);
        return $result;
    }
    function signin($connection, $tablename, $username, $password)
    {
        $sql="SELECT * FROM ".$tablename." WHERE name='".$username."' AND password='".$password."'";
        $result= $connection->query($sql);
        return $result;
    }
}
?>
