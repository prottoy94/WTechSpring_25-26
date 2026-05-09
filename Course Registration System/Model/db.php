<?php

class db
{
    function connection()
    {
        $db_host="localhost";
        $db_username="root";
        $db_password="";
        $db_name="exam_practise";

        $connection= mysqli_connect($db_host, $db_username, $db_password, $db_name);
        return $connection;
    }
   
}

?>
