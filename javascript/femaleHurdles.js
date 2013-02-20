$(document).ready(function(){

// handle the form submit event
function emailCheck() {
	document.getElementById("frmContact").onsubmit = function() {
		// prevent a form from submitting if no email.
	
	var x = document.forms["frmContact"]["email"].value;
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
			return true;
		}
    };
}



function firstnameCheck() {
	document.getElementById("frmContact").onsubmit = function() {
	var y = document.forms["frmContact"]["firstname"].value;
	var reg = /[A-Za-z]/;
	if(y == "")  {
		document.getElementById("nameerror").innerHTML = "Please provide a valid name!";
		return false;
	} else {
		return true;
			}
		};
	}

function calculateAge() {


	var birthday = document.getElementById("dob").value;
	var today = new Date();
    var birthDate = new Date(birthday);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
}  
	if (birthday == "") {
		document.getElementById("date").innerHTML = "Invalid";
		return false;
}
	else {
		return true;
		}
	//document.getElementById("demo").innerHTML = age;
}

$('#frmContact').submit(function(){
	var age = calculateAge();
	var email = emailCheck();
	var name = firstnameCheck();
	
	if(age == true && email == true && name == true) 
		return true;
	else
		return false; 
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
