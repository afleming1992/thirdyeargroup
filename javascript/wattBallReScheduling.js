$(document).ready(function()
{
    var id = 0;
    var button;
    var vs;
     $(".table").on('click',".btn-small", function()
     {
         
         var hour = $(this).parent().parent().children('#hour').text();
         id = $(this).attr('id');
         button = $(this).parent();
         vs = $(this).parent().parent().children('#vs').text();
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
              vs: vs
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


