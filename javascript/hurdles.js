$(document).ready(function() 
{ 
        $(".btn-info").live("click", function()
        {
			$('#contactDetails #myModalLabel').html("Contact Details for " + $(this).parent().parent().children('.hurdlerFirstName').text() + " " + $(this).parent().parent().children('.hurdlerLastName').text());
			$('#contactDetails #email').html($(this).parent().parent().children('.hurdlerEmail').text());
			$('#contactDetails #number').html($(this).parent().parent().children('.hurdlerEmergencyContact').text());
			$('#contactDetails #address').html($(this).parent().parent().children('.hurdlerHouseNo').text() + " " + $(this).parent().parent().children('.hurdlerStreetName').text());
			$('#contactDetails #city').html($(this).parent().parent().children('.hurdlerCity').text());
			$('#contactDetails #postcode').html($(this).parent().parent().children('.hurdlerPostCode').text());
		});      
});
