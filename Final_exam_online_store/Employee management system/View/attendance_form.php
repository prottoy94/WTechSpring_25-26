<!DOCTYPE html>
<html>
    <head>
        <title>Employee Attendance Management</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 30px;
            }

            label {
                display: inline-block;
                width: 130px;
                margin-bottom: 10px;
            }

            input,
            select {
                padding: 6px;
                width: 220px;
            }

            .error {
                color: red;
                margin-left: 10px;
            }

            #message {
                margin: 15px 0;
                font-weight: bold;
            }

            table {
                border-collapse: collapse;
                width: 100%;
                margin-top: 20px;
            }

            th,
            td {
                border: 1px solid #cccccc;
                padding: 8px;
                text-align: left;
            }

            th {
                background-color: #eeeeee;
            }

            button {
                padding: 7px 12px;
                cursor: pointer;
            }
        </style>
    </head>
    <body>
        <h2>Employee Attendance Management</h2>

        <form id="attendanceForm" method="post">
            <label for="employee_name">Employee Name:</label>
            <input type="text" id="employee_name" name="employee_name">
            <span id="employeeNameError" class="error"></span>
            <br>

            <label for="employee_id">Employee ID:</label>
            <input type="text" id="employee_id" name="employee_id" placeholder="EMP-101">
            <span id="employeeIdError" class="error"></span>
            <br>

            <label for="attendance_date">Date:</label>
            <input type="date" id="attendance_date" name="attendance_date">
            <span id="attendanceDateError" class="error"></span>
            <br>

            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="">Select Status</option>
                <option value="Present">Present</option>
                <option value="Absent">Absent</option>
                <option value="Leave">Leave</option>
            </select>
            <span id="statusError" class="error"></span>
            <br><br>

            <button type="submit">Add Attendance</button>
        </form>

        <div id="message"></div>

        <h3>Attendance Records</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Employee Name</th>
                    <th>Employee ID</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="attendanceTableBody">
                <tr>
                    <td colspan="6">Loading attendance records...</td>
                </tr>
            </tbody>
        </table>

        <script src="../Controller/JS/ajax.js"></script>
    </body>
</html>
