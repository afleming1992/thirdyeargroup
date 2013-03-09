$(document).ready(function() 
{
    //Delete
    $("#players").on( 'click',".btn-danger", function(){
        var id= $(this).attr('id');
        var nb = $("#table").find('tr').length - 1;
        if(nb - 1 < 11)
            $("#deletePlayerFail").modal('show');
        else
        {
            $("#deletePlayer").modal('show');
            $("#buttonDeletePlayer").attr('player',id);
        }    
        
    });
    
    $("#buttonDeletePlayer").click(function(){
        jQuery.ajax({
                      type: 'GET',
                      url: 'ajax/managePlayers.php',
                      data: {        		    
                        id: $('#buttonDeletePlayer').attr('player'),
                        teamID: $('#teamId').val()
                      }, 
                      success: function(data, textStatus, jqXHR) {
                              $('#players').html(data);
                              $("#deletePlayer").modal('hide');
                      },
                      error: function(jqXHR, textStatus, errorThrown) {
                              alert("Error during form validation, try later !");
                      }
                    });
    });
    
    //change
     $("#players").on( 'click',".btn-warning", function(){
         var id= $(this).attr('id');
         var name = $(this).parent().parent().children('#name').text();
         $("#playerNameChange").attr('value',name);
         $("#buttonAddPlayerChange").attr('player',id);
         $("#divAddPlayerChange").modal('show');         
     });
     
     $("#buttonAddPlayerChange").click(function(){
        if($('#playerNameChange').val() == "")
        {
            $("#divError").addClass("control-group error");
            $("#error").html("Add a Name !</br>");
        }
        else
        {
            jQuery.ajax({
                      type: 'GET',
                      url: 'ajax/managePlayers.php',
                      data: {
                        id: $('#buttonAddPlayerChange').attr('player'),
                        name: $('#playerNameChange').val(),
                        teamID: $('#teamId').val()
                      }, 
                      success: function(data, textStatus, jqXHR) {
                              $('#players').html(data);
                              $("#divAddPlayerChange").modal('hide');
                      },
                      error: function(jqXHR, textStatus, errorThrown) {
                              alert("Error during form validation, try later !");
                      }
                    });
        }
    });
    
    
    //add
    $("#addPlayers").click(function(){
        $("#divAddPlayer").modal('show');
    });
    
    
    
    $("#buttonAddPlayer").click(function(){
        if($('#playerName').val() == "")
        {
            $("#divError").addClass("control-group error");
            $("#error").html("Add a Name !</br>");
        }
        else
        {
            jQuery.ajax({
                      type: 'GET',
                      url: 'ajax/managePlayers.php',
                      data: {        		    
                        name: $('#playerName').val(),
                        teamID: $('#teamId').val()
                      }, 
                      success: function(data, textStatus, jqXHR) {
                              $('#players').html(data);
                              $("#divAddPlayer").modal('hide');
                      },
                      error: function(jqXHR, textStatus, errorThrown) {
                              alert("Error during form validation, try later !");
                      }
                    });
        }
    });
});


