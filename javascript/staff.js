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
        
      // Form control
        var validForm = false;
        var validName = false;
        var validStartDate = false;
        var validEndDate = false;
        var validRegistrationStart = false;
        var validRegistrationEnd = false;
        function formControl()
        {
            var Name = $('#tournamentName').val();
            var StartDate = $('#startDate').val();
            var EndDate = $('#endDate').val();
            var RegistrationStart = $('#registrationStartDate').val();
            var RegistrationEnd = $('#registrationEndDate').val();
            
            if(Name != "")
                validName = true;
            if(StartDate != "")
                validStartDate=true;
            if(EndDate != "")
                validEndDate=true;
            if(RegistrationStart != "")
                validRegistrationStart=true;
            if(RegistrationEnd != "")
                validRegistrationEnd=true;
            
            if(validName == true && validStartDate==true && validEndDate==true && validRegistrationStart==true && validRegistrationEnd==true)
            {
                validForm = true;
            }
                
        }
      
      // form validation with ajax
        
        $("#createTournamentValidation").click(function() 
        	{
                    formControl();
                    if(validForm == true)
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
                    }
                    else
                    {
                        if(validName == false)
                        {
                            $('#addTournamentName').addClass('control-group error');
                            $('#help-inline-tournamentName').html('<p>You must give a name to the tournament !');
                        }
                        if(validStartDate == false)
                        {
                            $('#addTournamentStartDate').addClass('control-group error');
                            $('#help-inline-startDate').html('<p>You must give a start date to the tournament (YYYY-MM-DD) !');
                        }
                        if(validEndDate == false)
                        {
                            $('#addTournamentEndDate').addClass('control-group error');
                            $('#help-inline-endDate').html('<p>You must give an end date to the tournament (YYYY-MM-DD) !');
                        }
                        if(validRegistrationStart == false)
                        {
                            $('#addTournamentregistrationStartDate').addClass('control-group error');
                            $('#help-inline-registrationStartDate').html('<p>You must give a registration start date date to the tournament (YYYY-MM-DD) !');
                        }
                        if(validRegistrationEnd == false)
                        {
                            $('#addTournamentregistrationEndDate').addClass('control-group error');
                            $('#help-inline-registrationEndDate').html('<p>You must give a registration end date date to the tournament (YYYY-MM-DD) !');
                        }
                            
                    }
        		
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
        
        $("#tournamentList").on( 'click',".btn-danger", function()
        {
            var id= $(this).attr('id');
            $("#deleteTournament").modal('show');
            $("#buttonDeleteTournament").attr('tournamentID',id);
        });
        
        $("#buttonDeleteTournament").click(function(){
           jQuery.ajax({
                      type: 'GET',
                      url: 'ajax/deleteTournament.php',
                      data: {
                        id: $(this).attr('tournamentID')
                      }, 
                      success: function(data, textStatus, jqXHR) {
                             $("#deleteTournament").modal('hide'); 
                             $('#tournamentList').html(data);
                      },
                      error: function(jqXHR, textStatus, errorThrown) {
                              alert("Error during form validation, try later !");
                      }
            });
        });
        
        $("#tournamentList").on("click",".btn-warning", function()
        {
                $('#changeTournament #tournamentNameChange').val($(this).parent().parent().children('.name').text());
                $('#changeTournament #startDateChange').val($(this).parent().parent().children('.startDate').attr('startDate'));
                $('#changeTournament #endDateChange').val($(this).parent().parent().children('.endDate').attr('endDate'));
                $('#changeTournament #registrationStartDateChange').val($(this).parent().parent().children('.registrationStart').attr('registrationStart'));
                $('#changeTournament #registrationEndDateChange').val($(this).parent().parent().children('.registrationEnd').attr('registrationEnd'));
                $('#changeTournament #changeTournamentValidation').attr('tournamentID',$(this).attr('id'));
        });
                
       $('#addTournament').on('hidden', function () {
            $('#addTournamentName').removeClass('control-group error');
            $('#help-inline-tournamentName').html('');
            $('#addTournamentStartDate').removeClass('control-group error');
            $('#help-inline-startDate').html('');
            $('#addTournamentEndDate').removeClass('control-group error');
            $('#help-inline-endDate').html('');
            $('#addTournamentregistrationStartDate').removeClass('control-group error');
            $('#help-inline-registrationStartDate').html('');
            $('#addTournamentregistrationEndDate').removeClass('control-group error');
            $('#help-inline-registrationEndDate').html('');
       });
       
       $("#startScheduling").click(function() 
        {
            jQuery.ajax({
        		  type: 'GET',
        		  url: 'ajax/wattBallScheduling.php',
        		  data: {        		    
        		    id: $('#selectTournament option:selected').val()
        		  }, 
        		  success: function(data, textStatus, jqXHR) {
        			  $('#resultScheduling').html(data);
        		  },
        		  error: function(jqXHR, textStatus, errorThrown) {
        			  alert("Error during form validation, try later !");
        		  }
        		});

        });
        
        $("#selectTournament").change(function ()
        {
            jQuery.ajax({
        		  type: 'GET',
        		  url: 'ajax/wattBallScheduling.php',
        		  data: {        		    
        		    tournament: $('#selectTournament option:selected').val()
        		  }, 
        		  success: function(data, textStatus, jqXHR) {
        			  $('#schedulingInfo').html(data);
        		  },
        		  error: function(jqXHR, textStatus, errorThrown) {
        			  alert("Error during form validation, try later !");
        		  }
        		});
        });
        
})