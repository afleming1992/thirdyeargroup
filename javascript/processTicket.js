function validateForm()
{
	var ticketNumberCheck = ticketValidation();
	
	if(ticketNumberCheck == 1)
	{
		return true;
	}
	else
	{
		return false;
	}
}
function ticketValidation()
{
	var getAdultNumbers = parseInt(document.getElementById("adult").value,10);
	var getConcessionNumbers = parseInt(document.getElementById("concession").value,10);
	if(getAdultNumbers == 0 && getConcessionNumbers == 0)
	{
		document.getElementById("ticketcontrol").className = "control-group error";
		document.getElementById("ticketcontrol2").className = "control-group error";
		document.getElementById("errorticketnumber").innerHTML = "<i class='icon-remove'></i> Please buy at least one ticket!";
		return 0;
	}
	else
	{
		document.getElementById("ticketcontrol").className = "control-group success";
		document.getElementById("ticketcontrol2").className = "control-group success";
		document.getElementById("errorticketnumber").innerHTML = "<i class='icon-ok'></i>";
		return 1;
	}
}
function reCalculatePrice(AdultPrice,ConcessionPrice)
{
	var getAdultNumbers = parseInt(document.getElementById("adult").value,10);
	var getConcessionNumbers = parseInt(document.getElementById("concession").value,10);
	var totalPrice = (getAdultNumbers * AdultPrice) + (getConcessionNumbers * ConcessionPrice);
	document.getElementById("price").innerHTML = totalPrice;
}