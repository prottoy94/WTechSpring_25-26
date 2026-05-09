<?php
function getAllAttendance($conn)
{
    $sql = "SELECT id, employee_name, employee_id, attendance_date, status FROM attendance ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);

    $records = array();

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $records[] = $row;
        }
    }

    return $records;
}

function insertAttendance($conn, $employeeName, $employeeId, $attendanceDate, $status)
{
    $sql = "INSERT INTO attendance (employee_name, employee_id, attendance_date, status) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, "ssss", $employeeName, $employeeId, $attendanceDate, $status);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $result;
}

function deleteAttendance($conn, $id)
{
    $sql = "DELETE FROM attendance WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $result;
}
?>
