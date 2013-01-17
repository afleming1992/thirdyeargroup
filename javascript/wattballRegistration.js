$(document).ready(function() 
{
	$("#result-success").hide();
	
        
        
        var validForm = false;
        var validTeamName = false;
        var validNWA = false;
        var validNumber = false;
        var validContactName = false;
        var validEmail = false;
        var validPlayers = false;
        function formControl()
        {
            var teamName = $("#teamName").val();
            var NWA = $("#nwaNumber").val();
            var number = $("#contactNumber").val();
            var contactName = $("#contactName").val();
            var email = $("#email").val();
            var players = $("#players").val();
            var regexNWA = /^([0-9]{6})+([A-Z]{1})$/;
            var regexPhoneNumber = /^([0-9]{11})$/;
            var regexEmail = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            var regexPlayers = /^(([A-Za-z0-9])+([\-])){11}$/;
            
            players = players.replace(/[\n]/gi, "-" );
            players = players + "-";
            if(teamName != "")
                validTeamName = true;
            if(regexNWA.test(NWA))
                validNWA = true;
            if(regexPhoneNumber.test(number))
                validNumber = true;
            if(contactName != "")
                validContactName = true;
            if(regexEmail.test(email))
                validEmail = true;
            if(regexPlayers.test(players) == true)
                validPlayers = true;
            if(validTeamName == true && validNWA == true && validNumber == true && validContactName == true && validEmail == true && validPlayers == true)
                validForm = true;
            
            
            
        }        
        
        
	$("#form").submit(function() 
        {
            
            validForm = false;
            validTeamName = false;
            validNWA = false;
            validNumber = false;
            validContactName = false;
            validEmail = false;
            validPlayers = false;
            formControl();
            if(validForm == true)
                return true;
            else
            {
                if(validTeamName == false)
                {
                    $('#teamNameDiv').addClass('control-group error');
                    $('#teamNameDiv .help-inline').html('You must give a name to your team !');
                }
                else
                {
                    $('#teamNameDiv').removeClass('control-group error');
                    $('#teamNameDiv .help-inline').html('This is the Name of the Team that you represent');
                }
                if(validNWA == false)
                {
                    $('#nwaNumberDiv').addClass('control-group error');
                    $('#nwaNumberDiv .help-inline').html('NWA Number must contains 6 digits and one letter at the end (Exemple: 111111A)!');
                }
                else
                {
                    $('#nwaNumberDiv').removeClass('control-group error');
                    $('#nwaNumberDiv .help-inline').html('You must be a Member of the NWA in order to register');
                }
                if(validNumber == false)
                {
                    $('#contactNumberDiv').addClass('control-group error');
                    $('#contactNumberDiv .help-inline').html('Please Enter Full Number including Area code (11 Digits)');
                }
                else
                {
                    $('#contactNumberDiv').removeClass('control-group error');
                    $('#contactNumberDiv .help-inline').html('Contact number must be a valid phone number (11 digits including area code)!');
                }
                if(validContactName == false)
                {
                    $('#contactNameDiv').addClass('control-group error');
                    $('#contactNameDiv .help-inline').html('You must give a contact name !');
                }
                else
                {
                    $('#contactNameDiv').removeClass('control-group error');
                    $('#contactNameDiv .help-inline').html('Should any problems occur, name someone to be your contact');
                }
                if(validEmail == false)
                {
                    $('#emailDiv').addClass('control-group error');
                    $('#emailDiv .help-inline').html('Contact Email adress must be a valid Email !');
                }
                else
                {
                    $('#emailDiv').removeClass('control-group error');
                    $('#emailDiv .help-inline').html('Enter a Valid Email we can use to contact you');
                }
                if(validPlayers == false)
                {
                    $('#playersDiv').addClass('control-group error');
                    $('#playersDiv .help-inline').html('You must have a team of at least 11 Players, one per line !');
                }
                else
                {
                    $('#playersDiv').removeClass('control-group error');
                    $('#playersDiv .help-inline').html('You must have a team of at least 11 Players');
                }
                return false;
            }
            
        });
     
     
});