$(document).ready(function() 
{
    // Datepicker
        $( "#date" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            dateFormat: "yy-mm-dd"            
        });
        
        $( "#search" ).click(function()
        {
           jQuery.ajax({
        		  type: 'GET',
        		  url: 'ajax/addWattBallResult.php',
        		  data: {
        		    date: $('#date').val(),
        		    tournamentID: $('#tournamentID').val()
        		            		  }, 
        		  success: function(data, textStatus, jqXHR) {        			  
        			  $('#addWattBallResult').html(data);
        		  },
        		  error: function(jqXHR, textStatus, errorThrown) {
        			  alert("Error during form validation, try later !");
        		  }
        		}); 
        });
        
        $( "#addGoalTeam1" ).click(function()
        {
            var minute = $( "#minuteTeam1" ).val();
            var name = $( "#playersTeam1 option:selected" ).text();
            var playerID = $( "#playersTeam1 option:selected" ).val();
            if(minute <= 0 || isNaN(minute) == true)
                alert("Minute must be a number greater than 0");
            else
            {
                $('#goalsTeam1').append("<tr id='"+playerID+"'><td>"+name+"</td><td>"+minute+"</td></tr>");
            }
        });
        
        $( "#addGoalTeam2" ).click(function()
        {
            var minute = $( "#minuteTeam2" ).val();
            var name = $( "#playersTeam2 option:selected" ).text();
            var playerID = $( "#playersTeam2 option:selected" ).val();
            if(minute <= 0 || isNaN(minute) == true)
                alert("Minute must be a number greater than 0");
            else
            {
                $('#goalsTeam2').append("<tr id='"+playerID+"'><td>"+name+"</td><td>"+minute+"</td></tr>");
            }
        });
});