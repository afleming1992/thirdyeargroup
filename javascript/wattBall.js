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
    
    $("#divTeam").on( 'click',".btn-danger", function(){
        var id= $(this).attr('id');
        $("#deleteTeam").modal('show');
        $("#buttonDeleteTeam").attr('teamID',id);
    });
    
    $("#buttonDeleteTeam").click(function(){
        jQuery.ajax({
                      type: 'GET',
                      url: 'ajax/deleteTeam.php',
                      data: {        		    
                        id: $("#buttonDeleteTeam").attr('teamID')
                      }, 
                      success: function(data, textStatus, jqXHR) {
                              $('#divTeam').html(data);
                              $("#deleteTeam").modal('hide');
                      },
                      error: function(jqXHR, textStatus, errorThrown) {
                              alert("Error during form validation, try later !");
                      }
                    });
    });
})

