$(document).ready(function()
{
    var id = 0;
    var button;
    var vs;
    var team1;
    var team2;

     $(".table").on('click',".btn-small", function()
     {
         
         var hour = $(this).parent().parent().children('#hour').text();
         id = $(this).attr('id');
         button = $(this).parent();
         vs = $(this).parent().parent().children('#vs').text();
         team1 = $(this).parent().parent().children('#team1').text();
         team2 = $(this).parent().parent().children('#team2').text();
         $('#changeSchedule').modal('show');
         $('#myModalLabel').html("Re-Scheduling:</br> <em>" + vs + "</em>");
         $('#modalDate').val($(this).parent().parent().children('#date').attr('dateSQL'));
         if(hour == "2pm")
             $('#modalHour option[value='+"2pm"+']').attr("selected" , "selected");
         else
             $('#modalHour option[value='+"10am"+']').attr("selected" , "selected");
         
         $('#modalPitch').val($(this).parent().parent().children('#pitch').text());
  
     }); 
     
     
     // Datepicker
        $( "#modalDate" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            dateFormat: "yy-mm-dd"            
        });
     
     $("#reSchedule").click(function()
     {
         jQuery.ajax({
            type: 'GET',
            url: 'ajax/changeMatchSchedule.php',
            data: {
              id: id,
              date: $('#modalDate').val(),
              hour: $("#changeHour option:selected").val(),                           
              pitch: $('#modalPitch').val(),
              vs: vs,
              team1: team1,
              team2: team2
            }, 
            success: function(data, textStatus, jqXHR) {
                    $('#changeSchedule').modal('hide');
                    $(button).html(data);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                    alert("Error during form validation, try later !");
            }
          });
     });
     
});


