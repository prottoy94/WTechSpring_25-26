document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("courseForm");
    const message = document.getElementById("message");

    const errorName = document.getElementById("student_name_error");
    const errorId = document.getElementById("student_id_error");
    const errorCourse = document.getElementById("course_name_error");
    const errorSemester = document.getElementById("semester_error");

    const tableBody = document.getElementById("registrationTableBody");

    function clearErrors() {
        errorName.textContent = "";
        errorId.textContent = "";
        errorCourse.textContent = "";
        errorSemester.textContent = "";
    }

    function renderTable(rows) {
        tableBody.innerHTML = "";
        if (!rows || rows.length === 0) {
            tableBody.innerHTML = "<tr><td colspan='5'>No records found</td></tr>";
            return;
        }
        rows.forEach(function (row) {
            const tr = document.createElement("tr");
            tr.innerHTML = `
                <td>${row.student_name}</td>
                <td>${row.student_id}</td>
                <td>${row.course_name}</td>
                <td>${row.semester}</td>
                <td>
                    <button type="button" class="delete-btn" data-id="${row.student_id}">Delete</button>
                </td>
            `;
            tableBody.appendChild(tr);
        });
    }

    function fetchAll() {
        const formData = new FormData(); //creates a form data
        formData.append("action", "fetch"); //appends a key-value pair to the form data, where the key is "action" and the value is "fetch". This is used to indicate that we want to fetch all records from the server.

        fetch("../Controller/courseController.php", { //sends a POST request to the specified URL with the form data as the request body. The fetch function returns a promise that resolves to the response from the server.
            method: "POST",
            body: formData
        })
        .then(res => res.json()) //parses the response as JSON. This assumes that the server returns a JSON response containing the data we want to display in the table.
        .then(data => { //takes the parsed JSON data and calls the renderTable function, passing the data as an argument. The renderTable function is responsible for updating the HTML table with the fetched data.
            renderTable(data.data);
        });
    }

    form.addEventListener("submit", function (e) { //adds an event listener to the form that listens for the "submit" event. When the form is submitted, the callback function is executed.
        e.preventDefault();
        clearErrors();

        const formData = new FormData(form);

        fetch("../Controller/courseController.php", {
            method: "POST",
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (!data.success) { //checks if the "success" property in the response data is false. If it is false, it means there were validation errors or some other issue with the form submission.
                errorName.textContent = data.errors.student_name || "";
                errorId.textContent = data.errors.student_id || "";
                errorCourse.textContent = data.errors.course_name || "";
                errorSemester.textContent = data.errors.semester || "";
                message.textContent = data.message || "Please fix the errors.";
                message.style.color = "red";
            } else {
                message.textContent = data.message;
                message.style.color = "green";
                renderTable(data.data);
                form.reset();
            }
        });
    });

    tableBody.addEventListener("click", function (e) { //adds an event listener to the table body that listens for click events. This is used to handle the delete button clicks for each row in the table.
        if (e.target.classList.contains("delete-btn")) {
            const id = e.target.getAttribute("data-id"); //retrieves the student ID from the data-id attribute of the clicked delete button.
            const formData = new FormData();
            formData.append("action", "Delete Registration");
            formData.append("student_id_delete", id);

            fetch("../Controller/courseController.php", {
                method: "POST",
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                message.textContent = data.message;
                message.style.color = data.success ? "green" : "red";
                renderTable(data.data);
            });
        }
    });

    fetchAll();
});