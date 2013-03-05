<div class='span9 contentbox'>		

	
	<script src="javascript/staffManagement.js"> </script>    
	<div id="staffList">
		<?php 
			$allStaff = $this->staff;
			include("include/allStaff.php"); 
		?>	
	</div>

	<!-- Div add staff member  -->
		
	<div id="addStaff" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
		<div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
   			<h3 id="myModalLabel">Add Member of Staff</h3>
 		</div>
 		<div class="modal-body">
			<div id="addUsername">
				<label for="username">Username: </label>
				<input type="text" name="username" id="username"></br><span id="help-inline-username" class="help-inline"></span></br>
			</div>
			<div id="addName">
				<label for="name">Name: </label>
				<input type="text" id="name" name="name"></br><span id="help-inline-name" class="help-inline"></span>
			</div>
			<div id="addEmail">
				<label for="email">Email: </label>
				<input type="text" id="email" name="email"></br><span id="help-inline-email" class="help-inline"></span>
			</div>
			<div id="addIsManager">
				<label for="manager">Manager: 
				<input type="checkbox" id="manager" name="manager" /></label>
			</div>
		</div>
		 <div class="modal-footer">
		    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		    <button type='button' value='submit' aria-hidden="true" id='addStaffValidation' class="btn btn-primary btn"><i class="icon-white icon-ok-sign"></i> Save</button>
  		</div>
	</div>
	
	<button type="button" data-toggle="modal" class="btn btn-primary btn-medium" data-target="#addStaff"><i class="icon-plus-sign icon-white"></i> Add Staff Member</button>


	<!-- Div edit staff member  -->
	
	<div id="editStaff" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
		<div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
   			 <h3 id="myModalLabel">Edit staff member</h3>
 		</div>
 		<div class="modal-body">
			<div id="editUsername">
				<label for="usernameChange">Username: </label>
				<span class="input-xmedium uneditable-input" id="fixedUsername"></span></br></br>
			</div>
			<div id="editName">
				<label for="nameChange">Name: </label>
				<input type="text" id="nameChange" name="nameChange"></br><span id="help-inline-nameChange" class="help-inline"></span>
			</div>
			<div id="editEmail">
				<label for="emailChange">Email: </label>
				<input type="text" id="emailChange" name="emailChange"></br><span id="help-inline-emailChange" class="help-inline"></span>
			</div>
			<div id="editIsManager">
				<label for="managerChange">Manager: 
				<input type="checkbox" id="managerChange" name="managerChange" /></label>
			</div>
		</div>
		<div class="modal-footer">
		    <button class="btn" id='editClose' data-dismiss="modal" aria-hidden="true">Close</button>
		    <button type='button' value='submit' id='editStaffValidation' class="btn btn-primary btn-medium"><i class="icon-white icon-ok-sign"></i> Save</button>
  		</div>
	</div>
        
	<!-- Div delete staff member  -->
	
	<div id="deleteStaff" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		 <h3 id="myModalLabel" align="center">Are you sure you want to delete this member of staff?</h3>
		</div>
		<div class="modal-body center">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	<button type='button' id='buttonDeleteStaff' class="btn btn-danger btn-medium"><i class="icon-white icon-remove-sign"></i> Delete</button>
		</div>
	</div>
	
</div>
</div>
