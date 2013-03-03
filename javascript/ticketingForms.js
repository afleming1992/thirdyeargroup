$(document).ready(function(){
	function ticketsNumbers()
	{
		var getAdultNumbers = document.getElementById("adult").value;
		var getConcessionNumbers = document.getElementById("concession").value;
		if(getAdultNumbers == 0 && getConcessionNumbers == 0)
		{
			document.getElementById("errorticketnumber").innerHTML = "Please buy at least one ticket!";
			return false;
		}
		else
		{
			document.getElementById("errorticketnumber").innerHTML = "";
			return true;
		}
	}
	
	function postCodeCheck()
	{
		var getPostCode= document.getElementById("postcode").value;
		var regPostCode = /^([A-Za-z0-9]{1,2}[A-Za-z0-9]{1,2}\s[0-9]{1}[A-Za-z]{2})$/;
		if(regPostCode.test(getPostCode) == false)  {
		document.getElementById("errorpostcode").innerHTML = "Please provide a valid postcode!";
		return false;
		} else {
		document.getElementById("errorpostcode").innerHTML = "";
		return true;
		} 
	}
	
	$('#ticketPurchase').submit(function(){
		var ticketCheck = ticketNumbers();

		if(ticketCheck == true) 
		{
			return true;
		}
		else
		{	
		alert('Something has not gone completely right. Please fix any errors!');
		return false;
		}	
	});
});
