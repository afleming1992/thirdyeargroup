$(document).ready(function() 
{
    $("#selectTournament").change(function ()
           {
               jQuery.ajax({
                             type: 'GET',
                             url: 'ajax/wattBallScheduling.php',
                             data: {        		    
                               schedule: $('#selectTournament option:selected').val()
                             }, 
                             success: function(data, textStatus, jqXHR) {
                                     $('#schedule').html(data);
                             },
                             error: function(jqXHR, textStatus, errorThrown) {
                                     alert("Error during form validation, try later !");
                             }
                           });
           });
})

