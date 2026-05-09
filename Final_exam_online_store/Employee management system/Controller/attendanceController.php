<?php
header("Content-Type: application/json");

include "../Model/db.php";
include "../Model/attendanceModel.php";

$action = isset($_POST["action"]) ? $_POST["action"] : "fetch";

$response = array(
    "success" => false,
    "message" => "",
    "errors" => array(),
    "records" => array()
);

function isValidDateValue($date)
{
    $dateObject = DateTime::createFromFormat("Y-m-d", $date);
    return $dateObject && $dateObject->format("Y-m-d") === $date;
}

function validateAttendanceData($employeeName, $employeeId, $attendanceDate, $status)
{
    $errors = array();
    $validStatuses = array("Present", "Absent", "Leave");

    if (empty($employeeName)) {
        $errors["employee_name"] = "Employee name is required";
    } elseif (!preg_match("/^[A-Za-z ]+$/", $employeeName)) {
        $errors["employee_name"] = "Only letters and spaces are allowed";
    }

    if (empty($employeeId)) {
        $errors["employee_id"] = "Employee ID is required";
    } elseif (!preg_match("/^EMP-[0-9]+$/", $employeeId)) {
        $errors["employee_id"] = "Employee ID must be like EMP-101";
    }

    if (empty($attendanceDate)) {
        $errors["attendance_date"] = "Attendance date is required";
    } elseif (!isValidDateValue($attendanceDate)) {
        $errors["attendance_date"] = "Enter a valid date";
    }

    if (empty($status)) {
        $errors["status"] = "Attendance status is required";
    } elseif (!in_array($status, $validStatuses)) {
        $errors["status"] = "Select a valid status";
    }

    return $errors;
}

if ($action === "add") {
    $employeeName = isset($_POST["employee_name"]) ? trim($_POST["employee_name"]) : "";
    $employeeId = isset($_POST["employee_id"]) ? trim($_POST["employee_id"]) : "";
    $attendanceDate = isset($_POST["attendance_date"]) ? trim($_POST["attendance_date"]) : "";
    $status = isset($_POST["status"]) ? trim($_POST["status"]) : "";

    $errors = validateAttendanceData($employeeName, $employeeId, $attendanceDate, $status);

    if (!empty($errors)) {
        $response["errors"] = $errors;
        $response["message"] = "Please fix the validation errors";
    } else {
        if (insertAttendance($conn, $employeeName, $employeeId, $attendanceDate, $status)) {
            $response["success"] = true;
            $response["message"] = "Attendance record added successfully";
        } else {
            $response["message"] = "Failed to add attendance record";
        }
    }
} elseif ($action === "delete") {
    $id = isset($_POST["id"]) ? intval($_POST["id"]) : 0;

    if ($id <= 0) {
        $response["message"] = "Invalid attendance record";
    } else {
        if (deleteAttendance($conn, $id)) {
            $response["success"] = true;
            $response["message"] = "Attendance record deleted successfully";
        } else {
            $response["message"] = "Failed to delete attendance record";
        }
    }
} elseif ($action === "fetch") {
    $response["success"] = true;
}

$response["records"] = getAllAttendance($conn);

echo json_encode($response);
?>
