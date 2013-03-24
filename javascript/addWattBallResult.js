$(document).ready(function() 
{
    var playerTeam1 = new Array();
    var playerTeam2 = new Array();
    var minuteTeam1 = new Array();
    var minuteTeam2 = new Array();
    var date;
    // Datepicker
        $("#addWattBallResult").on( 'focus',"#date", function(){
            $("#date").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            dateFormat: "yy-mm-dd"            
        })});
        
        $("#addWattBallResult").on( 'click',"#search", function()
        {
           date = $("#date").val();
           jQuery.ajax({
        		  type: 'GET',
        		  url: 'ajax/addWattBallResult.php',
        		  data: {
        		    date: date,
        		    tournamentID: $('#tournamentID').val()
        		            		  }, 
        		  success: function(data, textStatus, jqXHR) {                                   
        			  $('#addWattBallResult').html(data);
                                  $("#date").val(date);
        		  },
        		  error: function(jqXHR, textStatus, errorThrown) {
        			  alert("Error during form validation, try later !");
        		  }
        		}); 
        });
        
        $("#addWattBallResult").on( 'click',"#addGoalTeam1", function()
        {
            var minute = $( "#minuteTeam1" ).val();
            var name = $( "#playersTeam1 option:selected" ).text();
            var playerID = $( "#playersTeam1 option:selected" ).val();
            if(minute <= 0 || isNaN(minute) == true)
                alert("Minute must be a number greater than 0");
            else
            {
                playerTeam1.push(playerID);
                minuteTeam1.push(minute);
                $('#goalsTeam1').append("<tr id='"+playerID+"'><td>"+name+"</td><td>"+minute+"</td></tr>");
            }
            return false;
        });
        
         $("#addWattBallResult").on( 'click',"#addGoalTeam2", function()
        {
            var minute = $( "#minuteTeam2" ).val();
            var name = $( "#playersTeam2 option:selected" ).text();
            var playerID = $( "#playersTeam2 option:selected" ).val();
            if(minute <= 0 || isNaN(minute) == true)
                alert("Minute must be a number greater than 0");
            else
            {
                playerTeam2.push(playerID);
                minuteTeam2.push(minute);
                $('#goalsTeam2').append("<tr id='"+playerID+"'><td>"+name+"</td><td>"+minute+"</td></tr>");
            }
            return false;
        });
        
        
        $("#addWattBallResult").on( 'change',"#matches", function()
        {
            jQuery.ajax({
        		  type: 'GET',
        		  url: 'ajax/addWattBallResult.php',
        		  data: {
        		    matchID: $('#matches option:selected').val()
        		  }, 
        		  success: function(data, textStatus, jqXHR) {        			  
        			  $('#addWattBallResult').html(data);
        		  },
        		  error: function(jqXHR, textStatus, errorThrown) {
        			  alert("Error during form validation, try later !");
        		  }
        		}); 
             
        });
        
        var number;
        $("#matchReport").keyup( function(){ 
            number = $(this).val().length;
            var msg = number+" / 200";
            $("#count").text(msg);
            if(number > 0){
                $("#count").removeClass("text-error");
                $("#count").removeClass("text-warning");
                $("#count").addClass("text-info");
            }
            if(number > 180){
                $("#count").removeClass("text-info");
                $("#count").addClass("text-warning");
            }
            if(number > 200){
                $("#count").removeClass("text-warning");
                $("#count").addClass("text-error"); 
            }            
        });
        
        $("#addWattBallResult").on( 'click',"#save", function()
        {
            var matchID = $('#matches option:selected').val();
            
            if(playerTeam1.length == 0)
                playerTeam1.push("0");
            if(playerTeam2.length == 0)
                playerTeam2.push("0");
            if(minuteTeam1.length == 0)
                minuteTeam1.push("0");
            if(minuteTeam2.length == 0)
                minuteTeam2.push("0");
            
            var nb = $("#matchReport").val().length;
            if(nb > 200){
                $("#count").text("Match report is limited to 200 characters only !");
                $("#count").removeClass("text-info");
                $("#count").removeClass("text-warning");
                $("#count").addClass("text-error");
            } 
            else{
                jQuery.ajax({
        		  type: 'GET',
        		  url: 'ajax/addWattBallResult.php',
        		  data: {
        		    matchID: matchID,
                            playerTeam1: playerTeam1,
                            playerTeam2: playerTeam2,
                            minuteTeam1: minuteTeam1,
                            minuteTeam2: minuteTeam2,
                            report: $("#matchReport").val()
        		  }, 
        		  success: function(data, textStatus, jqXHR) {        			  
        			  $('#addWattBallResult').html(data);
        		  },
        		  error: function(jqXHR, textStatus, errorThrown) {
        			  alert("Error during form validation, try later !");
        		  }
        		}); 
            }

            
        });
});