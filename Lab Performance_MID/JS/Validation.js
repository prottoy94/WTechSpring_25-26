console.log("Connected to Validation.js");

const unitPrice=1000;
const days=30;

let qInput=document.getElementById("quantity");
qInput.addEventListener("input",totalSum);

function totalSum()
{
    let quantity=parseInt(document.getElementById("quantity").value);
    if(quantity<0)
    {
        document.getElementById("quantityError").innerHTML="Quantity cannot be negative! Enter a valid quantity :((";
        document.getElementById("quantity").value=0;
        document.getElementById("totalPrice").value=0;
        return;
    }
    else
    {
        document.getElementById("quantityError").innerHTML="";
    }
    if(isNaN(quantity))
    {
        quantity=0;
    }

    let total=unitPrice*quantity*days;
    document.getElementById("totalPrice").value = total;

    if(total>1000){
        alert("Congratulations!!! You are eligible for a gift coupon :))");
    }
}
