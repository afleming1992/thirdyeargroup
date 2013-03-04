function validateForm()
{
	var ticketCheck = ticketNumbers();
	var postCodeCheck= postCodeValidation();
	if(ticketCheck == 1 && postCodeCheck == 1) 
	{
		return true;
	}
	else
	{	
		alert('Something has not gone completely right. Please fix any errors!');
		return false;
	}	
}

function ticketNumbers()
{
	var getAdultNumbers = parseInt(document.ticketPurchase.adult.value,10);
	var getConcessionNumbers = parseInt(document.ticketPurchase.concession.value,10);
	if(getAdultNumbers == 0 && getConcessionNumbers == 0)
	{
		document.getElementById("errorticketnumber").innerHTML = "Please buy at least one ticket!";
		return 0;
	}
	else
	{
		document.getElementById("errorticketnumber").innerHTML = "";
		return 1;
	}
}
	
function postCodeValidation()
{
	var getPostCode = document.getElementById("postcode").value;
	if(getPostCode.length < 6)
	{
		document.getElementById("errorpostcode").innerHTML = "Postcodes must be at least 6 Characters (Please include Space)";
		return 0;
	}
	var regPostCode = /^([A-Za-z0-9]{1,2}[A-Za-z0-9]{1,2}\s[0-9]{1}[A-Za-z]{2})$/;
	if(regPostCode.test(getPostCode) == false)  
	{
		document.getElementById("errorpostcode").innerHTML = "Please provide a valid postcode!";
		return 0;
	}
	else 
	{
		document.getElementById("errorpostcode").innerHTML = "";
		return 1;
	} 
}
