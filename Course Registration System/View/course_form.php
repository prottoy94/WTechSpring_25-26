<?php
#session_start();
    include "../Controller/courseController.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Registration System</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        td[colspan] 
        {
            text-align: center;
        }
        .error {
            color: red;
        }

        #message {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <p id="message"></p>

        <form id="courseForm" method="post" action="../Controller/courseController.php" enctype="multipart/form-data">
            <label for="student_name">Student name:</label>
            <input type="text" id="student_name" name="student_name">
            <span id="student_name_error" class="error"></span><br><br>

            <label for="student_id">Student ID:</label>
            <input type="text" id="student_id" name="student_id">
            <span id="student_id_error" class="error"></span><br><br>

            <label for="course_name">Course Name:</label>
            <input type="text" id="course_name" name="course_name">
            <span id="course_name_error" class="error"></span><br><br>

            <label for="semester">Semester:</label>
            <select id="semester" name="semester">
                <option value="">Select a semester</option>
                <option value="Spring">Spring</option>
                <option value="Summer">Summer</option>
                <option value="Fall">Fall</option>
            </select>
            <span id="semester_error" class="error"></span><br><br>
            <label for="file">Upload a attachement-</label>
            <input type="file" id="file" name="file">
            <br><br>

            <input type="submit" name="action" value="Register Course"><br><br>

            <label for="student_id_delete">Student ID to delete:</label>
            <input type="text" id="student_id_delete" name="student_id_delete">
            <span id="student_id_delete_error" class="error"></span><br><br>
            <input type="submit" name="action" value="Delete Registration"><br>
            <?php echo "<span style='color: green;'>" . $_SESSION["update_message"] . "</span>"; ?>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Student ID</th>
                    <th>Course Name</th>
                    <th>Semester</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="registrationTableBody">
                <tr>
                    <td colspan="5">Loading</td>
                </tr>
            </tbody>
        </table>
    </div>

    <script src="../Controller/JS/ajax.js"></script>
table>

    </div>
    <script src="../Controller/JS/ajax.js"></script>

cript src="../Controller/JS/ajax.js"></script>

ler/JS/ajax.js"></script>

