<?php

include "../Model/db.php";
$database= new db();
$connection=$database->connection();
$table_name="course_db";

    if(!$connection)
    {
        die("Could not connect to the database: ".mysqli_connect_error());
        return $connection;
    }
    function addStudent($connection, $table_name, $student_name, $student_id, $course_name, $semester)
    {
        $sql="INSERT INTO ".$table_name."(student_name,student_id,course_name,semester) VAlUES ('".$student_name."','".$student_id."','".$course_name."','".$semester."')"; 
        $result=mysqli_query($connection, $sql);
        return $result;
    }
    function searchStudent($connection, $table_name, $student_id)
    {
        $sql="SELECT * FROM ".$table_name." WHERE student_id='".$student_id."'";
        $result=mysqli_query($connection, $sql);
        return $result;
    }
    function deleteStudent($connection, $table_name, $student_id)
    {
        $sql="DELETE FROM ".$table_name." WHERE student_id='".$student_id."'";
        $result=mysqli_query($connection, $sql);
        return $result;

    }
?>    
   
