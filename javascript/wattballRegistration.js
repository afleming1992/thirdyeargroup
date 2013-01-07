$(document).ready(function() 
{
	$("#result-success").hide();
	
	$("#submitregistration").click(function() 
        	{
        		jQuery.ajax({
        		  type: 'POST',
        		  url: 'ajax/registerTeam.php',
        		  data: {
        		    tournamentId: $('#tournamentId').val(),
        		    teamName: $('#teamName').val(),
        		    nwaNumber: $('#nwaNumber').val(),
        		    contactName: $('#contactName').val(),
        		    contactNumber: $('#contactNumber').val(),
        		    email: $('#email').val(),
        		    players: $('#players').val()
        		  }, 
        		  success: function(data, textStatus, jqXHR) {
        			  $('#form').hide();
        			  $('#result-success').show();
        		  },
        		  error: function(jqXHR, textStatus, errorThrown) {
        			  alert("Error during form validation, try later !");
        		  }
        		});
        	});
     
     $("#nwaNumber").blur(function()
     {
		var number = $('#nwaNumber').val();
		if(number.length != 7)
		{
			$('#submitregistration').attr('disabled','disabled');
		}
		else
		{
		
		}
	 }
});
