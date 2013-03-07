function validateForm()
{
	var cardNumberCheck = cardNumberValidation();
	var dateCheck = dateValidation();
	var cscCheck = cscValidation();
	var nameCheck = nameValidation();
	
	if(cardNumberCheck == 1 && dateCheck == 1 && cscCheck == 1 && nameCheck == 1)
	{
		return true;
	}
	else
	{
		return false;
	}
}
function nameValidation()
{
	var name = document.getElementById("nameOnCard");
	if(name.length < 3)
	{
		document.getElementById("nameOnCardControl").className = "control-group error";
		document.getElementById("errorNameOnCard").innerHTML = "<i class='icon-remove'></i> Names must be at least 3 letters long and contain only letters or spaces";
		return 0;
	}
	else
	{
		document.getElementById("nameOnCardControl").className = "control-group success";
		document.getElementById("errorNameOnCard").innerHTML = "<i class='icon-ok'></i>";
		return 1;
	}
}

function cardNumberValidation()
{
	var cardNumber = document.getElementById("cardNo").value;
	var reg = new RegExp("^[0-9]+$");
	if(reg.test(cardNumber) == false || cardNumber.length != 16)
	{
		document.getElementById("cardNumberControl").className = "control-group error";
		document.getElementById("errorCardNumber").innerHTML = "<i class='icon-remove'></i> This Card Number is Invalid, Card Numbers must be numeric, 16 digits long with no spaces"
		return 0;
	}
	else
	{
		document.getElementById("cardNumberControl").className = "control-group success";
		document.getElementById("errorCardNumber").innerHTML = "<i class='icon-ok'></i>"
		return 1;
	}
}

function cscValidation()
{
	var cscNumber = document.getElementById("csc").value;
	var reg = new RegExp("^[0-9]+$");
	if(reg.test(cscNumber) == false || cscNumber.length != 3)
	{
		document.getElementById("cscControl").className = "control-group error";
		document.getElementById("errorCSC").innerHTML = "<i class='icon-remove'></i> Your CSC Number is 3 Digits long and is found on the Back of your Credit Card"
		return 0;
	
	}
	else
	{
		document.getElementById("cscControl").className = "control-group success";
		document.getElementById("errorCSC").innerHTML = "<i class='icon-ok'></i>"
		return 1;
	}
}

function dateValidation()
{
	var month = document.getElementById("month").value;
	var year = document.getElementById("year").value;
	var date = new Date();
	date.setMonth(month - 1);
	date.setFullYear(year);
	date.setDate(01);
	var currentDate = new Date();
	if(date < currentDate)
	{
		document.getElementById("validityControl").className = "control-group error";
		document.getElementById("errorValidity").innerHTML = "<i class='icon-remove'></i> Date is in the Past!"
		return 0;
	}
	else
	{
		document.getElementById("validityControl").className = "control-group success";
		document.getElementById("errorValidity").innerHTML = "<i class='icon-ok'></i>"
		return 1;
	}
}