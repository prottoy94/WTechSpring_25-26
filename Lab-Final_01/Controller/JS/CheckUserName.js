function checkUserName()
{
    let username = document.getElementById("name").value.trim();
    let response = document.getElementById("userresponse");

    if (username === "") {
        response.innerHTML = "";
        return;
    }

    let xhttp = new XMLHttpRequest();

    xhttp.onload = function() {
        if (this.status === 200) {
            response.innerHTML = this.responseText;
        } else {
            response.innerHTML = "Could not check username";
        }
    };

    xhttp.onerror = function() {
        response.innerHTML = "Could not check username";
    };

    xhttp.open("POST", "../Controller/CheckUserName.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("username=" + encodeURIComponent(username));
}
