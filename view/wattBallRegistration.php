<div class='row-fluid'>
	<div class='span12 contentbox'>
<?php
	if(isset($_SESSION['completed']))
	{
?>
	<div id='result-success'>
		<div class='alert alert-success'>
			<b>Congratulations</b> Your team is now registered for Wattball! We look forward to seeing you at the Tournament!
		</div>
	</div>
<?php

	}
	else
	{
		if(isset($_SESSION['error']))
		{
?>
	<div class='alert alert-error'>
		<b>Oh Dear!</b> An Error has occured in Validation, Please check where there is errors and try again!
	</div>
<?php
		}
?>
	<div id='form'>
		<script src="javascript/wattballRegistration.js"> </script> 
		<h3>Register for Wattball Tournament</h3>
			<form class="form-horizontal" method='post' name='wattball_registration' action='index.php'>
				<div class="control-group">
				  <fieldset>
					<legend>Tournament Selection</legend>
					<label class='control-label'>Choose which Tournament to Register to:-</label>
					<div class="controls">
						<select name="tournamentId" id='tournamentId'>
							<?php
								
								if(isset($tournament))
								{
									for($i = 0;$i<count($tournament);$i++)
                                                                        {
                                                                           echo "<option value='".$tournament[$i]['tournamentID']."'>".$tournament[$i]['name']." - FROM ".$tournament[$i]['startDate']." TO ".$tournament[$i]['endDate']."</option>"; 
                                                                        }
								}
							?>
						</select>
					</div>
				  </fieldset>
				  </fieldset>
					<legend>Basic Details</legend>
					<label class='control-label'>Team Name</label>
					<div class="controls">
						<input type="text" placeholder="Type something…" name='teamName' id='teamName' value='<?php if(isset($_SESSION['error'])){echo $teamName;} ?>' required>
						<span class="help-inline">This is the Name of the Team that you represent</span>
					</div>
					<?php
						if(isset($_SESSION['nwaLengthError']) || isset($_SESSION['nwaValidationError']))
						{
					?>
						<div class='control-group error'>
					<?php	
						}
					?>
					<label class='control-label'>NWA Number</label>
					<div class="controls">
						<input type="text" placeholder="Type something…" name='nwaNumber' id='nwaNumber' value='<?php if(isset($_SESSION['error'])){echo $nwaNumber;} ?>' required>
					<?php
						if(isset($_SESSION['nwaLengthError']) || isset($_SESSION['nwaValidationError']))
						{
					?>
						<span class="help-inline"><b>Your NWA Number must be 7 Characters Long with 6 Numbers and a Letter at the end</b></span>
					<?php
						}
						else
						{
					?>
						<span class="help-inline">You must be a Member of the NWA in order to register</span>
					<?php
						}
					?>
					</div>
					<?php
						if(isset($_SESSION['nwaLengthError']) || isset($_SESSION['nwaValidationError']))
						{
					?>
						</div>
					<?php
						}
					?>
				  </fieldset>
				  <fieldset>
					<legend>Contact Details</legend>
					<label class='control-label'>Contact Name</label>
					<div class="controls">
						<input type="text" placeholder="Type something…" name='contactName' id='contactName' value='<?php if(isset($_SESSION['error'])){echo $contactName;} ?>' required>
						<span class="help-inline">Should any problems occur, name someone to be your contact</span>
					</div>
					<?php
						if(isset($_SESSION['contactNumberError']))
						{
				
						print("<div class='control-group error'>");
					
						}
					?>
					<label class='control-label'>Contact Number</label>
					<div class="controls">
						<input type="text" placeholder="Type something…" name='contactNumber' id='contactNumber' value='<?php if(isset($_SESSION['error'])){echo $contactNumber;} ?>' required>
					
							<span class="help-inline">Please Enter Full Number including Area code (11 Digits)</span>
	
					</div>
					<?php
						if(isset($_SESSION['contactNumberError']))
						{
							print("</div>");
						}
					?>
					<label class='control-label'>Contact Email</label>
					<div class="controls">
						<input type="email" placeholder="Type something…" name='email' id='email' value='<?php if(isset($_SESSION['error'])){echo $email;} ?>' required>
						<span class="help-inline">Enter a Valid Email we can use to contact you!</span>
					</div>
					<br />
				 </fieldset>
				 <fieldset>
					<legend>Players</legend>
					<?php
						if(isset($_SESSION['NotEnoughPlayers']))
						{
					?>
						<div class='control-group error'>
					<?php
						}
					?>
					<label class='control-label'>Enter the Names of Each Player of your Team. One per Line!</label>
					<div class="controls">
						<textarea rows='11' name='players' id='players' required><?php if(isset($_SESSION['error'])){echo $_POST['players'];} ?></textarea>
					<?php
						if(isset($_SESSION['NotEnoughPlayers']))
						{
					?>
						<span class="help-inline"><b>You must have a team of at least 11 Players</b></span>
					<?php
						}
					?>
					</div>
					<?php
						if(isset($_SESSION['NotEnoughPlayers']))
						{
					?>
					</div>
					<?php
						}
					?>	
				</fieldset>
					
				<br />	
				<button type="submit" class="btn btn-success"><i class="icon-white icon-ok"></i> Submit Registration</button>
				</div>
			</form>
			<?php			
			}
			?>
		</div>
	</div>
</div>
