<?php
	
?>
<h3>Register for Wattball Tournament</h3>
<form class="form-horizontal" method='post' name='wattball_registration'>
	<div class="control-group">
	  <fieldset>
		<legend>Basic Details</legend>
		<label class='control-label'>Team Name</label>
		<div class="controls">
			<input type="text" placeholder="Type something…" name='teamName'>
			<span class="help-block">This is the Name of the Team that you represent</span>
		</div>
		<label class='control-label'>NWA Number</label>
		<div class="controls">
			<input type="text" placeholder="Type something…" name='nwaNumber'>
			<span class="help-block">All Teams must be a part of the National Wattball Association in order to participate</span>
		</div>
	  </fieldset>
	  <fieldset>
		<legend>Contact Details</legend>
		<label class='control-label'>Contact Name</label>
		<div class="controls">
			<input type="text" placeholder="Type something…" name='contactName'>
			<span class="help-block">Should any problems occur, name someone to be your contact</span>
		</div>
		<label class='control-label'>Contact Number</label>
		<div class="controls">
			<input type="text" placeholder="Type something…" name='contactNumber'>
			<span class="help-block">Please Enter Full Number including Area code</span>
		</div>
		<br />
	 </fieldset>
	 <fieldset>
		<legend>Players</legend>
		<label class='control-label'>Enter the Names of Each Player of your Team. One per Line!</label>
		<div class="controls">
			<textarea rows='11' name='players'></textarea>
		</div>
	</fieldset>
		
	<br />	
	<button type="submit" class="btn btn-success"><i class="icon-white icon-ok"></i> Submit Registration</button>
	</div>
</form>
