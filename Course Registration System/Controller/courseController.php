<?php
session_start();
include "../Model/courseModel.php";

$student_name="";
$student_id="";
$course_name="";
$semester="";
$student_name_delete="";
$data_file="../data.json";
$file="";
$update_message="";

$database= new db();
$connection=$database->connection();

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $student_name=$_POST["student_name"]??"";
    $student_id=$_POST["student_id"]??"";
    $course_name=$_POST["course_name"]??"";
    $semester=$_POST["semester"]??"";
    $action=$_POST["action"]??"";
    $student_id_delete=$_POST["student_id_delete"]??"";
    $file=$_FILES["file"]??"";
    
    if($action=="Register Course")
    {
        if(!empty($student_name)&& preg_match("/^([a-zA-Z ]+)$/", $student_name) && !empty($student_id)&& preg_match("/^STU-[0-9]{3}$/", $student_id)
        && !empty($course_name)&&!empty($semester))
        {
            if($file && $file["error"] === UPLOAD_ERR_OK)
            {
                $targetdirectory="../File/";
                $path=$targetdirectory.basename($file["name"]);
                $result=move_uploaded_file($file["tmp_name"], $path);
            }
            else
            {
                $path="";
            }

            $result=addStudent($connection, $table_name, $student_name, $student_id, $course_name, $semester, $path);
            if (!$result) {
                echo "DB Error: " . mysqli_error($connection);
                exit;
            }
            if($result && $connection->affected_rows > 0)
            {
                $form_data=array("Student_name"=>$student_name, "Student_id"=>$student_id, "Course_name"=>$course_name, "Semester"=>$semester , "File_path"=>$path);

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
                $temp_data[]=$form_data;
                $parse_data=json_encode($temp_data, JSON_PRETTY_PRINT);
                file_put_contents($data_file, $parse_data);
                echo '<script>alert("Student added successfully!");</script>';
                $update_message="Student added successfully!";
                $_SESSION["update_message"] = $update_message;
                header("Location: ../View/course_form.php");

            }
            else
            {
                echo '<script>alert("Failed to add student!");</script>';
                $update_message="Failed to add student!";
                $_SESSION["update_message"] = $update_message;
                header("Location: ../View/course_form.php");
                exit(); 

            }
        }
        else
        {
            echo '<script>
                alert("Invalid input! Please check your data and try again.");
                window.location.href = "../View/course_form.php";
            </script>';
            exit();
        }
    }
    elseif($action=="Delete Registration")
    {
        if(!empty($student_id_delete))
        {
            $result=deleteStudent($connection, $table_name, $student_id_delete);
            if($result && $connection->affected_rows > 0)
            {
                echo '<script>
                alert("Student deleted successfully!");
                window.location.href = "../View/course_form.php";
                </script>';
                $update_message="Student deleted successfully!";
                $_SESSION["update_message"] = $update_message;
                exit();

            }
            else
            {
                echo '<script>
                alert("No student found with this ID!");
                window.location.href = "../View/course_form.php";
                </script>';
                $update_message="No student found with this ID!";
                $_SESSION["update_message"] = $update_message;
                exit();
            }
        }
        else
        {
            echo '<script>
                alert("Invalid Student ID! Please check your input and try again.");
                window.location.href = "../View/course_form.php";
                </script>';
                $update_message="Invalid Student ID!";
                $_SESSION["update_message"] = $update_message;
                exit();
        }
    }

    
}
?>
