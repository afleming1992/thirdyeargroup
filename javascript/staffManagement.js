$(document).ready(function() 
{
	//Form control
	var validForm;
	var validName;
	var validEmail;
	var validUsername;
	var validPassword;
	
	function formControl(option)
	{
		var name;
		var username;
		var email;
		
		validForm = false;
		validName = false;
		validUsername = false;
		validEmail = false;
		
		if(option === "add")
		{
			name = $('#name').val();
			username = $('#username').val();
			email = $('#email').val();
		}
		
		if(option === "edit")
		{
			validUsername = true;
			name = $('#nameChange').val();
			email = $('#emailChange').val();
		}
		
		regexName = /^[A-Za-z\s\-]{1,30}$/;
		regexUsername = /^[A-Za-z0-9]{4,10}$/;
		regexEmail = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(regexName.test(name))
			validName = true;
		if(regexUsername.test(username))
			validUsername = true; 
		if(regexEmail.test(email))
			validEmail = true; 
		if(validName == true && validUsername==true && validEmail==true)
			validForm = true;
			
	}
	
	function clearAdd()
	{
		if(validName == false)
		{
			$('#addName').addClass('control-group error');
			$('#help-inline-name').html('Invalid name.<br>Names can be alphanumeric, 1-30 characters long with spaces and hyphens.');
		}
		else
		{
			$('#addName').removeClass('control-group error');
			$('#help-inline-name').html('');
		}
		if(validUsername == false)
		{
			$('#addUsername').addClass('control-group error');
			$('#help-inline-username').html('Invalid username.<br>Usernames can be alphanumeric, 4-10 characters long with no spaces and no special characters.');
		}
		else
		{
			$('#addUsername').removeClass('control-group error');
			$('#help-inline-username').html('');
		}
		if(validEmail == false)
		{
			$('#addEmail').addClass('control-group error');
			$('#help-inline-email').html('Invalid email address.');
		}      
		else
		{
			$('#addEmail').removeClass('control-group error');
			$('#help-inline-email').html('');
		}   
	}
	
	function clearEdit()
	{
		if(validName == false)
		{
			$('#editName').addClass('control-group error');
			$('#help-inline-nameChange').html('Invalid name.<br>Names can be alphanumeric, 1-30 characters long with spaces and hyphens.');
		}
		else
		{
			$('#editName').removeClass('control-group error');
			$('#help-inline-nameChange').html('');
		}
		if(validEmail == false)
		{
			$('#editEmail').addClass('control-group error');
			$('#help-inline-emailChange').html('Invalid email address.');
		}      
		else
		{
			$('#editEmail').removeClass('control-group error');
			$('#help-inline-emailChange').html('');
		}   
	}
	
	// form validation with ajax
	
	$("#addStaffValidation").click(function() 
	{
		formControl("add");
		var isManager = $("#manager").is(":checked") ? 1:0;
		if(validForm == true)
		{
			jQuery.ajax({
				type: 'GET',
				url: 'ajax/addStaff.php',
				data: {
				name: $('#name').val(),
				username: $('#username').val(),
				email: $('#email').val(),
				manager: isManager
				}, 
				success: function(data, textStatus, jqXHR) {
				$('#addStaff').modal('hide');
				$("#addStaff :input").val("");
				$("#addStaff :checkbox").removeAttr("checked"); 
				$('#staffList').html(data);
				clearAdd();
				},
				error: function(jqXHR, textStatus, errorThrown) {
					alert("Error during form validation, try later !");
				}
			});
		}
		else
		{
			clearAdd(); 
		}		
	});
	
	$("#editStaffValidation").click(function() 
	{
		formControl("edit");
		var isManager = $("#managerChange").is(":checked") ? 1:0;
		if(validForm == true)
		{
			jQuery.ajax({
				type: 'GET',
				url: 'ajax/editStaff.php',
				data: {
				name: $('#nameChange').val(),
				username: $('#fixedUsername').text(),
				email: $('#emailChange').val(),			
				manager: isManager,
				id: $(this).attr('umpireID')
				}, 
				success: function(data, textStatus, jqXHR) {
				$('#editStaff').modal('hide');
				$("#editStaff :input").val("");
				$("#editStaff :checkbox").removeAttr("checked"); 
				$('#staffList').html(data);
				clearEdit();
				},
				error: function(jqXHR, textStatus, errorThrown) {
					alert("Error during form validation, try later !");
				}
			});
		}
		else
		{
			clearEdit(); 
		}		
	});
	
	$("#buttonDeleteStaff").click(function(){
		jQuery.ajax({
					type: 'GET',
					url: 'ajax/deleteStaff.php',
					data: {
					  username: $("#buttonDeleteStaff").attr('username')
					}, 
					success: function(data, textStatus, jqXHR) {
						   $("#deleteStaff").modal('hide');  
						   $('#staffList').html(data);
					},
					error: function(jqXHR, textStatus, errorThrown) {
							alert("Error during form validation, try later !");
					}
		  });
	});
	
	$(".btn-warning").live("click", function()
	{
		$('#editStaff #fixedUsername').text($(this).parent().parent().children('.username').text());
		$('#editStaff #nameChange').val($(this).parent().parent().children('.name').text());
		$('#editStaff #emailChange').val($(this).parent().parent().children('.email').text());
		if($(this).parent().parent().children('.manager').text() =="Yes")$('#editStaff #managerChange').attr('checked',true);
		else $('#editStaff #managerChange').attr('checked',false);
	});
	
	$(".btn-danger").live("click", function()
	{
		var id= $(this).attr('id');
		$("#deleteStaff").modal('show');            
		$("#buttonDeleteStaff").attr('username',id);
					
	});
	
	$("#editClose").click(function()
        {
			$('#editName').removeClass('control-group error');
			$('#help-inline-nameChange').html('');
			$('#editEmail').removeClass('control-group error');
			$('#help-inline-emailChange').html('');
	});
 
        
       
        
});


