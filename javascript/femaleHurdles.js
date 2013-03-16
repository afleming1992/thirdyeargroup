$(document).ready(function(){

$("#performancetime").hide();
$(":radio[name='yesno']").change(function(){
  var newVal = $(":radio[name='yesno']:checked").val();
  if (newVal == "Yes") {
    $("#performancetime").show();
  } else {
    $("#performancetime").hide();
  }
});


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

function houseNumberCheck() {
	
	var getHouseNumber = document.getElementById("housenumber").value;
	var regHouseNumber = /^([0-9\/]{1,4})$/;
	if(regHouseNumber.test(getHouseNumber) == false)  {
		document.getElementById("errorhousenumber").innerHTML = "Please provide a valid house number!";
		return false;
	} else {
		document.getElementById("errorhousenumber").innerHTML = "";
		return true;
	} 
		
}

function streetNameCheck() {
	
	var getStreetName = document.getElementById("streetname").value;
	var regStreetName = /^([A-z\s]{2,})$/;
	if(regStreetName.test(getStreetName) == false)  {
		document.getElementById("errorstreetname").innerHTML = "Please provide a valid street name!";
		return false;
	} else {
		document.getElementById("errorstreetname").innerHTML = "";
		return true;
	} 
		
}

function cityCheck() {
	
	var getCity = document.getElementById("city").value;
	var regCity = /^([A-z]{2,})$/;
	if(regCity.test(getCity) == false)  {
		document.getElementById("errorcity").innerHTML = "Please provide a valid city!";
		return false;
	} else {
		document.getElementById("errorcity").innerHTML = "";
		return true;
	} 
		
}

function postCodeCheck() {
	
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

function radioCheck() {

	var x=document.getElementsByName("yesno");
		for(var i = 0; i < x.length; i++) {
			if(x[0].checked || x[1].checked) {
				return true;
			} else {
				document.getElementById("performancetimeerror").innerHTML = "Please select an option for a performance time";
				return false;
			}
	}
}
    
$('#frmContact').submit(function(){
	var age = calculateAge();
	var email = emailCheck();
	var firstName = firstnameCheck();
	var lastName = lastnameCheck();
	var contactNo = contactNumberCheck();
	var houseNo = houseNumberCheck();
	var street = streetNameCheck();
	var city = cityCheck();
	var postCode = postCodeCheck();
	var radio = radioCheck();
	
	
	if(age == true && email == true && firstName == true && lastName == true && contactNo == true && houseNo == true && street == true && city == true && radio == true) 
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
