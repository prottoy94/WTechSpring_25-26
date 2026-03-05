console.log("Connected to Script.js");

function get_firstname() {
    let firstname=document.getElementById("firstname").value;

    if (firstname==="")
    {
        document.getElementById("firstnameError").style.color="red";
        document.getElementById("firstnameError").innerHTML="Field Value need to be filled up";
        return false;
    } 
    else 
    {
        document.getElementById("firstnameError").innerHTML="";
    }
    console.log("First Name: " + firstname);
    return true;
}

function get_lastname() 
{
    let lastname = document.getElementById("lastname").value;

    if (lastname==="") {
        document.getElementById("lastnameError").style.color="red";
        document.getElementById("lastnameError").innerHTML="Field Value need to be filled up";
        return false;
    } 
    else 
    {
        document.getElementById("lastnameError").innerHTML="";
    }
    console.log("Last Name: " + lastname);
    return true;
}

function get_email() {
    let email = document.getElementById("email").value;

    if (email==="") 
    {
        document.getElementById("emailError").style.color="red";
        document.getElementById("emailError").innerHTML="Field Value need to be filled up";
        return false;
    } 
    else 
    {
        document.getElementById("emailError").innerHTML="";
    }

    console.log("Email: " + email);
    return true;
}

function get_phone() 
{
    let phone=document.getElementById("phone").value;

    if (phone==="")
    {
        document.getElementById("phoneError").style.color="red";
        document.getElementById("phoneError").innerHTML="Field Value need to be filled up";
        return false;
    } 
    else 
    {
        document.getElementById("phoneError").innerHTML="";
    }
    console.log("Phone: " + phone);
    return true;
}

function get_message() 
{
    let message=document.getElementById("message").value;

    if (message==="") 
    {
        document.getElementById("messageError").style.color="red";
        document.getElementById("messageError").innerHTML="Field Value need to be filled up";
        return false;
    } 
    else 
    {
        document.getElementById("messageError").innerHTML="";
    }

    console.log("Message: " + message);
    return true;
}

function validateForm() 
{
    let firstValid=get_firstname();
    let lastValid=get_lastname();
    let emailValid=get_email();
    let phoneValid=get_phone();
    let messageValid=get_message();

    if (!firstValid||!lastValid||!emailValid||!phoneValid||!messageValid) 
    {
        return false;
    }

    return false;
}