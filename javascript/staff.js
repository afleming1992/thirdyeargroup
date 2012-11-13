$(document).ready(function() 
{
	// Datepicker
        $( ".from" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 3,
            dateFormat: "yy-mm-dd",
            onClose: function( selectedDate ) {
                $( ".to" ).datepicker( "option", "minDate", selectedDate );
            }
        });
        $( ".to" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 3,
            dateFormat: "yy-mm-dd",
            onClose: function( selectedDate ) {
                $( ".from" ).datepicker( "option", "maxDate", selectedDate );
            }
        });
        
        $( ".fromChange" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 3,
            dateFormat: "yy-mm-dd",
            onClose: function( selectedDate ) {
                $( ".toChange" ).datepicker( "option", "minDate", selectedDate );
            }
        });
        $( ".toChange" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 3,
            dateFormat: "yy-mm-dd",
            onClose: function( selectedDate ) {
                $( ".fromChange" ).datepicker( "option", "maxDate", selectedDate );
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
        			  $('#addTournament').modal('hide');
        			  $("#addTournament :input").val("");
        			  $('#tournamentList').html(data);
        		  },
        		  error: function(jqXHR, textStatus, errorThrown) {
        			  alert("Error during form validation, try later !");
        		  }
        		});
        	});
        
        $("#changeTournamentValidation").click(function() 
        	{
        		jQuery.ajax({
        		  type: 'GET',
        		  url: 'ajax/changeTournament.php',
        		  data: {
        		    name: $('#tournamentNameChange').val(),
        		    startDate: $('#startDateChange').val(),
        		    endDate: $('#endDateChange').val(),
        		    registrationStartDate: $('#registrationStartDateChange').val(),
        		    registrationEndDate: $('#registrationEndDateChange').val(),
        		    id: $('#changeTournamentValidation').attr('tournamentID')
        		  }, 
        		  success: function(data, textStatus, jqXHR) {
        			  $("#changeTournament").modal('hide');
        			  $("#changeTournament :input").val("");
        			  $('#tournamentList').html(data);
        		  },
        		  error: function(jqXHR, textStatus, errorThrown) {
        			  alert("Error during form validation, try later !");
        		  }
        		});
        	});
        
        $(".btn-danger").live("click", function()
            	{
			        jQuery.ajax({
			  		  type: 'GET',
			  		  url: 'ajax/deleteTournament.php',
			  		  data: {
			  		    id: $(this).attr('id'),
			  		  }, 
			  		  success: function(data, textStatus, jqXHR) {
			  			 $('#tournamentList').html(data);
			  		  },
			  		  error: function(jqXHR, textStatus, errorThrown) {
			  			  alert("Error during form validation, try later !");
			  		  }
			        });
            	});
        
        $(".btn-warning").live("click", function()
            	{
        			//alert('test '+$(this).parent().parent().children('.startDate').attr('startDate'));
        			$('#changeTournament #tournamentNameChange').val($(this).parent().parent().children('.name').text());
        			$('#changeTournament #startDateChange').val($(this).parent().parent().children('.startDate').attr('startDate'));
        			$('#changeTournament #endDateChange').val($(this).parent().parent().children('.endDate').attr('endDate'));
        			$('#changeTournament #registrationStartDateChange').val($(this).parent().parent().children('.registrationStart').attr('registrationStart'));
        			$('#changeTournament #registrationEndDateChange').val($(this).parent().parent().children('.registrationEnd').attr('registrationEnd'));
        			$('#changeTournament #changeTournamentValidation').attr('tournamentID',$(this).attr('id'));
            	});
        
});