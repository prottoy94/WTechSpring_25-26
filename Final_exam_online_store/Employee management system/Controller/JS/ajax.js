document.addEventListener("DOMContentLoaded", function () {
    fetchAttendanceRecords();

    document.getElementById("attendanceForm").addEventListener("submit", function (event) {
        event.preventDefault();
        addAttendanceRecord();
    });

    document.getElementById("attendanceTableBody").addEventListener("click", function (event) {
        if (event.target.classList.contains("delete-btn")) {
            let id = event.target.getAttribute("data-id");
            deleteAttendanceRecord(id);
        }
    });
});

function clearMessages()
{
    document.getElementById("employeeNameError").innerHTML = "";
    document.getElementById("employeeIdError").innerHTML = "";
    document.getElementById("attendanceDateError").innerHTML = "";
    document.getElementById("statusError").innerHTML = "";
    document.getElementById("message").innerHTML = "";
}

function addAttendanceRecord()
{
    clearMessages();

    let form = document.getElementById("attendanceForm");
    let formData = new FormData(form);
    formData.append("action", "add");

    let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let response = parseAjaxResponse(this.responseText);

            if (!response) {
                return;
            }

            handleResponse(response);

            if (response.success) {
                form.reset();
            }
        }
    };

    xhttp.open("POST", "../Controller/attendanceController.php", true);
    xhttp.send(formData);
}

function fetchAttendanceRecords()
{
    let formData = new FormData();
    formData.append("action", "fetch");

    let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let response = parseAjaxResponse(this.responseText);

            if (!response) {
                return;
            }

            updateAttendanceTable(response.records);
        }
    };

    xhttp.open("POST", "../Controller/attendanceController.php", true);
    xhttp.send(formData);
}

function deleteAttendanceRecord(id)
{
    let formData = new FormData();
    formData.append("action", "delete");
    formData.append("id", id);

    let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let response = parseAjaxResponse(this.responseText);

            if (!response) {
                return;
            }

            handleResponse(response);
        }
    };

    xhttp.open("POST", "../Controller/attendanceController.php", true);
    xhttp.send(formData);
}

function handleResponse(response)
{
    clearMessages();

    if (response.errors) {
        if (response.errors.employee_name) {
            document.getElementById("employeeNameError").innerHTML = response.errors.employee_name;
        }

        if (response.errors.employee_id) {
            document.getElementById("employeeIdError").innerHTML = response.errors.employee_id;
        }

        if (response.errors.attendance_date) {
            document.getElementById("attendanceDateError").innerHTML = response.errors.attendance_date;
        }

        if (response.errors.status) {
            document.getElementById("statusError").innerHTML = response.errors.status;
        }
    }

    if (response.message) {
        let messageElement = document.getElementById("message");
        messageElement.innerHTML = response.message;
        messageElement.style.color = response.success ? "green" : "red";
    }

    updateAttendanceTable(response.records);
}

function parseAjaxResponse(responseText)
{
    try {
        return JSON.parse(responseText);
    } catch (error) {
        let messageElement = document.getElementById("message");
        messageElement.innerHTML = responseText;
        messageElement.style.color = "red";
        return null;
    }
}

function updateAttendanceTable(records)
{
    let tableBody = document.getElementById("attendanceTableBody");
    tableBody.innerHTML = "";

    if (!records || records.length === 0) {
        tableBody.innerHTML = '<tr><td colspan="6">No attendance records found</td></tr>';
        return;
    }

    records.forEach(function (record) {
        let row = document.createElement("tr");

        row.innerHTML =
            "<td>" + escapeHtml(record.id) + "</td>" +
            "<td>" + escapeHtml(record.employee_name) + "</td>" +
            "<td>" + escapeHtml(record.employee_id) + "</td>" +
            "<td>" + escapeHtml(record.attendance_date) + "</td>" +
            "<td>" + escapeHtml(record.status) + "</td>" +
            '<td><button type="button" class="delete-btn" data-id="' + escapeHtml(record.id) + '">Delete</button></td>';

        tableBody.appendChild(row);
    });
}

function escapeHtml(value)
{
    let div = document.createElement("div");
    div.textContent = value;
    return div.innerHTML;
}
