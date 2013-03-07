function validateForm()
{
	var ticketCheck = ticketNumbers();
	var postCodeCheck= postCodeValidation();
	var cityCheck = cityValidation();
	var firstNameCheck = firstnameValidation();
	var addressCheck = addressValidation();
	var surnameCheck = surnameValidation();
	var emailCheck = emailValidation();
	var countyCheck = countyValidation();
	
	if(ticketCheck == 1 && postCodeCheck == 1 && cityCheck == 1 && firstNameCheck == 1 && addressCheck == 1 && surnameCheck == 1 && emailCheck == 1 && countyCheck == 1)
	{
		document.getElementById("formerror").innerHTML = "<div class='alert alert-success'><b>Looks Great!</b></div>";
		return true;
	}
	else
	{	
		document.getElementById("formerror").innerHTML = "<div class='alert alert-error'><b>We have a problem!</b><br/>Some of your Information doesn't look right. Please go back and check any fields in red!</div>";
		return false;
	}	
}

function addressValidation()
{
	var getAddress = document.getElementById("address1").value;
	if(getAddress.length < 3)
	{
		document.getElementById("addresscontrol").className = "control-group error";
		document.getElementById("erroraddress").innerHTML = "<i class='icon-remove'></i> Please enter a valid address!";
		return 0;
	}
	else
	{
		document.getElementById("addresscontrol").className = "control-group success";
		document.getElementById("erroraddress").innerHTML = "<i class='icon-ok'></i> ";
		return 1;
	}
}

function surnameValidation() 
{
	var firstName = document.getElementById("surname").value;
	if(firstName.length < 1)
	{
		document.getElementById("surnamecontrol").className = "control-group error";
		document.getElementById("errorsurname").innerHTML = "<i class='icon-remove'></i> Please enter a surname!";
		return 0;
	}
	var reg = /^([A-z]{2,30})$/;
	if(reg.test(firstName) == false)  
	{
		document.getElementById("surnamecontrol").className = "control-group error";
		document.getElementById("errorsurname").innerHTML = "<i class='icon-remove'></i> Please provide a valid surname!";
		return 0;
	} 
	else 
	{
		document.getElementById("surnamecontrol").className = "control-group success";
		document.getElementById("errorsurname").innerHTML = "<i class='icon-ok'></i>";
		return 1;
	}

}

function firstnameValidation() 
{
	var firstName = document.getElementById("firstname").value;
	if(firstName.length < 1)
	{
		
		document.getElementById("firstnamecontrol").className = "control-group error";
		document.getElementById("errorfirstname").innerHTML = "<i class='icon-remove'></i> Please enter a first name!";
		return 0;
	}
	var reg = /^([A-z]{2,30})$/;
	if(reg.test(firstName) == false)  
	{
		document.getElementById("firstnamecontrol").className = "control-group error";
		document.getElementById("errorfirstname").innerHTML = "<i class='icon-remove'></i> Please provide a valid first name!";
		return 0;
	} 
	else 
	{
		document.getElementById("firstnamecontrol").className = "control-group success";
		document.getElementById("errorfirstname").innerHTML = "<i class='icon-ok'></i>";
		return 1;
	}

}

function cityValidation() {

	var getCity = document.getElementById("city").value;
	var regCity = /^([A-z]{2,})$/;
	if(regCity.test(getCity) == false)  {
		document.getElementById("citycontrol").className = "control-group error";
		document.getElementById("errorcity").innerHTML = "<i class='icon-remove'></i> Please provide a valid city!";
		return 0;
	} else {
		document.getElementById("citycontrol").className = "control-group success";
		document.getElementById("errorcity").innerHTML = "<i class='icon-ok'></i>";
		return 1;
	} 

}

function ticketNumbers()
{
	var getAdultNumbers = parseInt(document.ticketPurchase.adult.value,10);
	var getConcessionNumbers = parseInt(document.ticketPurchase.concession.value,10);
	if(getAdultNumbers == 0 && getConcessionNumbers == 0)
	{
		document.getElementById("ticketcontrol").className = "control-group error";
		document.getElementById("errorticketnumber").innerHTML = "<i class='icon-remove'></i> Please buy at least one ticket!";
		return 0;
	}
	else
	{
		document.getElementById("ticketcontrol").className = "control-group success";
		document.getElementById("errorticketnumber").innerHTML = "<i class='icon-ok'></i>";
		return 1;
	}
}
	
function postCodeValidation()
{
	var getPostCode = document.getElementById("postcode").value;
	if(getPostCode.length < 6)
	{
		document.getElementById("postcodecontrol").className = "control-group error";
		document.getElementById("errorpostcode").innerHTML = "<i class='icon-remove'></i> Postcodes must be at least 6 Characters (Please include Space)";
		return 0;
	}
	var regPostCode = /^([A-Za-z0-9]{1,2}[A-Za-z0-9]{1,2}\s[0-9]{1}[A-Za-z]{2})$/;
	if(regPostCode.test(getPostCode) == false)  
	{
		document.getElementById("postcodecontrol").className = "control-group error";
		document.getElementById("errorpostcode").innerHTML = "Please provide a valid postcode!";
		return 0;
	}
	else 
	{
		document.getElementById("postcodecontrol").className = "control-group success";
		document.getElementById("errorpostcode").innerHTML = "<i class='icon-ok'></i>";
		return 1;
	} 
}

function emailValidation() {

	var x = document.getElementById("email").value;
	var atpos = x.indexOf("@"); 
	//The indexOf() method returns the position of the first occurrence of a specified value in a string.
	var dotpos = x.lastIndexOf(".");
	//The lastIndexOf() method returns the position of the last occurrence of a specified value in a string.
	//lastIndexOf() starts from the end of the string. 

	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length || x == "")
	//checks if the input doesnt start with an @, checks if they are no .'s before the @ symbol, 
	//checks that the last occurence of a . isnt greater than the length of the string and checks
	//that the field isnt left blank. 
	{
	document.getElementById("emailcontrol").className = "control-group error";
	document.getElementById("erroremail").innerHTML = "<i class='icon-remove'></i> Please provide a valid email address!";
			// to STOP the form from submitting
	return 0;
		} else {
			// reset and allow the form to submit
			document.getElementById("emailcontrol").className = "control-group success";
			document.getElementById("erroremail").innerHTML = "<i class='icon-ok'></i>";
			return 1;
		}
}
   
function countyValidation() 
{
	var getCounty = document.getElementById("county").value;
	var regCounty = /^([A-z]{2,})$/;
	if(regCounty.test(getCounty) == false)  {
		document.getElementById("countycontrol").className = "control-group error";
		document.getElementById("errorcounty").innerHTML = "<i class='icon-remove'></i> Please provide a valid county!";
		return 0;
	} else {
		document.getElementById("countycontrol").className = "control-group success";
		document.getElementById("errorcounty").innerHTML = "<i class='icon-ok'></i>";
		return 1;
	} 

}
