$(document).ready(function() 
{
      //Form control
        var validForm;
        var validName;
        var validEmail;
        
        function formControl(option)
        {
			var Name;
			var Email;
			var regexEmail;
			validForm=false;
			validName=false;
			validEmail=false;
			
			if(option === "add")
			{
				Name = $('#umpireName').val();
				Email = $('#umpireEmail').val();
			}
			else if(option === "edit")
			{
				Name = $('#umpireNameChange').val();
				Email = $('#umpireEmailChange').val();
			}
            
            regexName = /^[A-Za-z\s\-]{1,30}$/;
            regexEmail = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            if(regexName.test(Name))
                validName = true;
            if(regexEmail.test(Email))
                validEmail=true;     
            if(validName == true && validEmail==true)
                validForm = true;
                
        }
      
      // form validation with ajax
        
       $("#addUmpireValidation").click(function() 
        	{
                    formControl("add");
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
        			  $("#addUmpire :checkbox").removeAttr("checked"); 
        			  $('#umpireList').html(data);
        			  $('#addUmpireName').removeClass('control-group error');
        			  $('#help-inline-umpireName').html('');
        			  $('#addUmpireEmail').removeClass('control-group error');
        			  $('#help-inline-umpireEmail').html('');
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
                            $('#help-inline-umpireName').html('<p>You must give a valid name for the umpire!');
                        }
                        else
                        {
							$('#addUmpireName').removeClass('control-group error');
							$('#help-inline-umpireName').html('');
						}
                        if(validEmail == false)
                        {
                            $('#addUmpireEmail').addClass('control-group error');
                            $('#help-inline-umpireEmail').html('<p>You must give a valid email address for the umpire!');
                        }      
                        else
                        {
							$('#addUmpireEmail').removeClass('control-group error');
							$('#help-inline-umpireEmail').html('');
						}      
                    }
        		
        	});
        
        $("#editUmpireValidation").click(function() 
        	{
				formControl("edit");
				var isChecked = new Array();
				for(var i=0;i<14;i++)
				{
					isChecked[i] = $("input[id=slott"+i+"]").is(":checked") ? 1:0; 
				}
				if(validForm == true)
                {
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
	        			  $('#editUmpireName').removeClass('control-group error');
	        			  $('#help-inline-umpireNameChange').html('');
	        			  $('#editUmpireEmail').removeClass('control-group error');
	        			  $('#help-inline-umpireEmailChange').html('');
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
                            $('#editUmpireName').addClass('control-group error');
                            $('#help-inline-umpireNameChange').html('<p>You must give a valid name for the umpire!');
                        }
                        else
                        {
							$('#editUmpireName').removeClass('control-group error');
							$('#help-inline-umpireNameChange').html('');
						}
                        if(validEmail == false)
                        {
                            $('#editUmpireEmail').addClass('control-group error');
                            $('#help-inline-umpireEmailChange').html('<p>You must give a valid email address for the umpire!');
                        }
                        else
                        {
							$('#editUmpireEmail').removeClass('control-group error');
							$('#help-inline-umpireEmailChange').html(''); 
						}           
                    }
        	});
        
        $(".btn-danger").live("click", function()
        {
            var id= $(this).attr('id');
            $("#deleteUmpire").modal('show');            
            $("#buttonDeleteUmpire").attr('umpireID',id);
                        
        });
        
        $("#editClose").click(function()
        {
			$('#editUmpireName').removeClass('control-group error');
			$('#help-inline-umpireNameChange').html('');
			$('#editUmpireEmail').removeClass('control-group error');
			$('#help-inline-umpireEmailChange').html('');
		});
        
        $("#buttonDeleteUmpire").click(function(){
            jQuery.ajax({
                        type: 'GET',
                        url: 'ajax/deleteUmpire.php',
                        data: {
                          id: $("#buttonDeleteUmpire").attr('umpireID')
                        }, 
                        success: function(data, textStatus, jqXHR) {
                               $("#deleteUmpire").modal('hide');  
                               $('#umpireList').html(data);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                                alert("Error during form validation, try later !");
                        }
              });
        });
        
		$('.checkall').click(function () {
			//$("#addUmpire :checkbox").attr("checked",this.checked); 
			$(this).parents('fieldset:eq(0)').find(':checkbox').attr('checked', this.checked);
		});
		
        
        $(".btn-warning").live("click", function()
		{
			$('#editUmpire #umpireNameChange').val($(this).parent().parent().children('.umpireName').text());
			$('#editUmpire #umpireEmailChange').val($(this).parent().parent().children('.umpireEmail').text());
			$('#editUmpire .checkall').removeAttr("checked");
			for(var i=0;i<14;i++)
			{
				if($(this).parent().parent().children('.slot'+i).text() ==1)$('#editUmpire #slott'+i).attr('checked',true);
				else $('#editUmpire #slott'+i).attr('checked',false);
			}
			$('#editUmpire #editUmpireValidation').attr('umpireID',$(this).attr('id'));
         });
         
        $(".btn-info").live("click", function()
        {
			var count = $(this).parent().parent().children('.count').text();
			if(count == 0)
			{
				$('#matches #row01').html("This umpire has no matches");
				$('#matches #row02').html("");
				$('#matches #row03').html("");
				$('#matches #row04').html("");
				$('#matches #row05').html("");
			}
			else
			{
				var i=0;
				for(i;i<count;i++)
				{
					$('#matches #row'+i+'1').html($(this).parent().parent().children('.row'+i+'1').text());
					$('#matches #row'+i+'2').html($(this).parent().parent().children('.row'+i+'2').text());
					$('#matches #row'+i+'3').html($(this).parent().parent().children('.row'+i+'3').text());
					$('#matches #row'+i+'4').html($(this).parent().parent().children('.row'+i+'4').text());
					$('#matches #row'+i+'5').html($(this).parent().parent().children('.row'+i+'5').text());
				}
				while(typeof $('#matches #row'+i+'1').val() !== 'undefined')
				{
					$('#matches #row'+i+'1').html("");
					$('#matches #row'+i+'2').html("");
					$('#matches #row'+i+'3').html("");
					$('#matches #row'+i+'4').html("");
					$('#matches #row'+i+'5').html("");
					i++;
				}
			}
		});
        
});
