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
            maxDate: +0,
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
                //playerTeam1.push(playerID);
                //minuteTeam1.push(minute);
                $('#goalsTeam1').append("<tr class='idT1' id='"+playerID+"'><td>"+name+"</td><td class='minuteT1'>"+minute+"</td><td><button class='btnT1 btn btn-danger btn-mini'><i class='icon-remove-sign icon-white'></i></button></td></tr>");
            }
            return false;
        });
        
        $("#addWattBallResult").on( 'click',".btnT1", function(){
            $(this).parent().parent().remove();
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
                //playerTeam2.push(playerID);
                //minuteTeam2.push(minute);
                $('#goalsTeam2').append("<tr class='idT2' id='"+playerID+"'><td>"+name+"</td><td class='minuteT2'>"+minute+"</td><td><button class='btnT2 btn btn-danger btn-mini'><i class='icon-remove-sign icon-white'></i></button></td></tr>");
            }
            return false;
        });
        
        $("#addWattBallResult").on( 'click',".btnT2", function(){
            $(this).parent().parent().remove();
            
        });
        
        function arrayUnset(array, value){
            array.splice(array.indexOf(value), 1);
        }

        
        
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
        $("#addWattBallResult").on( 'keyup',"#matchReport", function(){
            number = $(this).val().length;
            var msg = number+" / 600";
            $("#count").text(msg);
            if(number > 0){
                $("#count").removeClass("text-error");
                $("#count").removeClass("text-warning");
                $("#count").addClass("text-info");
            }
            if(number > 500){
                $("#count").removeClass("text-info");
                $("#count").addClass("text-warning");
            }
            if(number > 600){
                $("#count").removeClass("text-warning");
                $("#count").addClass("text-error"); 
            }            
        });
        
        $("#addWattBallResult").on( 'click',"#save", function()
        {
            var matchID = $('#matches option:selected').val();
            
            $(".minuteT2").each(function(){
                minuteTeam2.push($(this).text());
            });
            
            $(".idT2").each(function(){
                playerTeam2.push($(this).attr('id'));
            });
            
            $(".minuteT1").each(function(){
                minuteTeam1.push($(this).text());
            });
            
            $(".idT1").each(function(){
                playerTeam1.push($(this).attr('id'));
            });
            
            
            if(playerTeam1.length == 0)
                playerTeam1.push("0");
            if(playerTeam2.length == 0)
                playerTeam2.push("0");
            if(minuteTeam1.length == 0)
                minuteTeam1.push("0");
            if(minuteTeam2.length == 0)
                minuteTeam2.push("0");
            
            var nb = $("#matchReport").val().length;
            if(nb > 600){
                $("#count").text("Match report is limited to 600 characters only !");
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