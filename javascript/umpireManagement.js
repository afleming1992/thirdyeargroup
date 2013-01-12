$(document).ready(function() 
{
      //Form control
        var validForm = false;
        var validName = false;
        var validEmail = false;
        function formControl()
        {
            var Name = $('#umpireName').val();
            var Email = $('#umpireEmail').val();
            
            if(Name != "")
                validName = true;
            if(Email != "")
                validEmail=true;
            
            if(validName == true && validEmail==true)
            {
                validForm = true;
            }
                
        }
      
      // form validation with ajax
        
       $("#addUmpireValidation").click(function() 
        	{
                    formControl();
                    var isChecked = new Array();
					for(var i=0;i<14;i++)
					{
						isChecked[i] = $("input[id=slot"+i+"]").is(":checked") ? 1:0; 
					}
                    if(validForm == true)
                    {
                        jQuery.ajax({
        		  type: 'GET',
        		  url: 'ajax/addUmpire.php',
        		  data: {
        		    umpireName: $('#umpireName').val(),
        		    umpireEmail: $('#umpireEmail').val(),
					checklist: isChecked
        		  }, 
        		  success: function(data, textStatus, jqXHR) {
        			  $('#addUmpire').modal('hide');
        			  $("#addUmpire :input").val("");
        			  $('#umpireList').html(data);
        		  },
        		  error: function(jqXHR, textStatus, errorThrown) {
        			  alert("Error during form validation, try later !");
        		  }
        		});
                    }
                    else
                    {
                        if(validName == false)
                        {
                            $('#addUmpireName').addClass('control-group error');
                            $('#help-inline-umpireName').html('<p>You must give a name for the umpire!');
                        }
                        if(validEmail == false)
                        {
                            $('#addUmpireEmail').addClass('control-group error');
                            $('#help-inline-umpireEmail').html('<p>You must give an email address for the umpire!');
                        }             
                    }
        		
        	});
        
        $("#editUmpireValidation").click(function() 
        	{
				var isChecked = new Array();
				for(var i=0;i<14;i++)
				{
					isChecked[i] = $("input[id=slott"+i+"]").is(":checked") ? 1:0; 
				}
        		jQuery.ajax({
        		  type: 'GET',
        		  url: 'ajax/editUmpire.php',
        		  data: {
        		    umpireName: $('#umpireNameChange').val(),
        		    umpireEmail: $('#umpireEmailChange').val(),
					id: $(this).attr('umpireID'),
        		    checklist: isChecked
        		  }, 
        		  success: function(data, textStatus, jqXHR) {
        			  $("#editUmpire").modal('hide');
        			  $("#editUmpire :input").val("");
        			  $('#umpireList').html(data);
        		  },
        		  error: function(jqXHR, textStatus, errorThrown) {
        			  alert("Error during form validation, try later !");
        		  }
        		});
        	});
        
        $(".btn-danger").live("click", function()
            	{
			        jQuery.ajax({
			  		  type: 'GET',
			  		  url: 'ajax/deleteUmpire.php',
			  		  data: {
			  		    id: $(this).attr('id')
			  		  }, 
			  		  success: function(data, textStatus, jqXHR) {
			  			 $('#umpireList').html(data);
			  		  },
			  		  error: function(jqXHR, textStatus, errorThrown) {
			  			  alert("Error during form validation, try later !");
			  		  }
			        });
            	});
        
        $(".btn-warning").live("click", function()
            	{
        			$('#editUmpire #umpireNameChange').val($(this).parent().parent().children('.umpireName').text());
        			$('#editUmpire #umpireEmailChange').val($(this).parent().parent().children('.umpireEmail').text());
        			for(var i=0;i<14;i++)
        			{
						if($(this).parent().parent().children('.slot'+i).text() ==1)$('#editUmpire #slott'+i).attr('checked',true);
						else $('#editUmpire #slott'+i).attr('checked',false);
					}
        			$('#editUmpire #editUmpireValidation').attr('umpireID',$(this).attr('id'));
            	});
                
       $('#addUmpire').on('hidden', function () {
            $('#addUmpireName').removeClass('control-group error');
            $('#help-inline-umpireName').html('');
            $('#addUmpireEmail').removeClass('control-group error');
            $('#help-inline-umpireEmail').html('');
       });
        
});
