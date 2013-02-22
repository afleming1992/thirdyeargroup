$(document).ready(function(){

// handle the form submit event
function emailCheck() {
	
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
	document.getElementById("emailerror").innerHTML = "Please provide a valid email address!";
			// to STOP the form from submitting
	return false;
		} else {
			// reset and allow the form to submit
			document.getElementById("emailerror").innerHTML = "";
			return true;
		}
    
}

function firstnameCheck() {
	
	var firstName = document.getElementById("firstname").value;
	var reg = /^([A-z]{2,30})$/;
	if(reg.test(firstName) == false)  {
		document.getElementById("nameerror").innerHTML = "Please provide a valid first name!";
		return false;
	} else {
		document.getElementById("nameerror").innerHTML = "";
		return true;
			}
		
	}
function lastnameCheck() {
	
	var lastName = document.getElementById("lastname").value;
	var reg = /^([A-z]{2,30})$/;
	if(reg.test(lastName) == false)  {
		document.getElementById("lastnameerror").innerHTML = "Please provide a valid last name!";
		return false;
	} else {
		document.getElementById("lastnameerror").innerHTML = "";
		return true;
			}
		
	}
	
function contactNumberCheck() {
	
	var contactNumber = document.getElementById("emcontact").value;
	var reg = /^([0-9]{11})$/;
	if(reg.test(contactNumber) == false)  {
		document.getElementById("emcontacterror").innerHTML = "Please provide a valid contact number!";
		return false;
	} else {
		document.getElementById("emcontacterror").innerHTML = "";
		return true;
	} 
		
}

function addressCheck() {
	
	var getAddress = document.getElementById("address").value;
	var regNo = /^([0-9]{1,3})$/;
	if(reg.test(contactNumber) == false)  {
		document.getElementById("erroraddress").innerHTML = "Please provide a valid contact number!";
		return false;
	} else {
		document.getElementById("erroraddress").innerHTML = "";
		return true;
	} 
		
}

function calculateAge() {

	
	var birthday = document.getElementById("dob").value;
	var birthdayEdit = birthday.replace(/\//g,'-');
	var today = new Date();
    var birthDate = new Date(birthday);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
}  
	if (birthdayEdit == "" || age < 16) {
		document.getElementById("date").innerHTML = "Please provide a valid date of birth. Entrants must be 16 or over";
		return false;
}
	else {
		document.getElementById("date").innerHTML = "";
		return true;
		}
}

$('#frmContact').submit(function(){
	var age = calculateAge();
	var email = emailCheck();
	var firstName = firstnameCheck();
	var lastName = lastnameCheck();
	var contactNo = contactNumberCheck();
	alert('age:'+age+'email'+email+'name'+firstName+'name'+lastName+'number'+contactNo);
	if(age == true && email == true && firstName == true && lastName == true && contactNo == true) 
	{
		
		return true;
	}
	else
	{	
	alert('Validation Unsuccessful');
	return false;
	}	
});

 $( "#dob" ).datepicker({
 			yearRange: "-50:+0",
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            dateFormat: "yy/mm/dd"
            
            
        });

});
