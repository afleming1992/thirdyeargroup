$(document).ready(function() 
{
	// Datepicker
        $( "#startDate" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 3,
            dateFormat: "yy-mm-dd",
            onClose: function( selectedDate ) {
                $( "#endDate" ).datepicker( "option", "minDate", selectedDate );
            }
        });
        $( "#endDate" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 3,
            dateFormat: "yy-mm-dd",
            onClose: function( selectedDate ) {
                $( "#startDate" ).datepicker( "option", "maxDate", selectedDate );
            }
        });

        $( "#registrationStartDate" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 3,
            dateFormat: "yy-mm-dd",
            onClose: function( selectedDate ) {
                $( "#registrationEndDate" ).datepicker( "option", "minDate", selectedDate );
            }
        });
        $( "#registrationEndDate" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 3,
            dateFormat: "yy-mm-dd",
            onClose: function( selectedDate ) {
                $( "#registrationStartDate" ).datepicker( "option", "maxDate", selectedDate );
            }
        });
        
        
      // form validation with ajax
        
        $("#createTournamentValidation").click(function() 
        	{
        		jQuery.ajax({
        		  type: 'GET',
        		  url: 'ajax/createTournament.php',
        		  data: {
        		    name: $('#tournamentName').val(),
        		    startDate: $('#startDate').val(),
        		    endDate: $('#endDate').val(),
        		    registrationStartDate: $('#registrationStartDate').val(),
        		    registrationEndDate: $('#registrationEndDate').val() 
        		  }, 
        		  success: function(data, textStatus, jqXHR) {
        			 $('#tournamentList').html(data);
        		  },
        		  error: function(jqXHR, textStatus, errorThrown) {
        			  alert("Error during form validation, try later !");
        		  }
        		});
        	});
        
        
});