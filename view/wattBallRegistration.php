<div class='row-fluid'>
	<div class='span12 contentbox'>
<?php
//Some Initialisation
$completed = 0;
$error = 0;
$NotEnoughPlayers = 0;
error_reporting(E_ALL ^ E_NOTICE);

//When the Form is submitted, Do this
	if(isset($_POST['tournamentId']) && isset($_POST['teamName']) && isset($_POST['nwaNumber']) && isset($_POST['contactName']) && isset($_POST['contactNumber']) && isset($_POST['email']) && isset($_POST['players']))
	{
		
		$tournamentId = htmlspecialchars($_POST['tournamentId']);
		$teamName = htmlspecialchars($_POST['teamName']);
		$nwaNumber = htmlspecialchars($_POST['nwaNumber']);
		$contactName = htmlspecialchars($_POST['contactName']);
		$contactNumber = htmlspecialchars($_POST['contactNumber']);
		$email = htmlspecialchars($_POST['email']);
		$players = $_POST['players'];
		//NWA Checks
		
		//This checks that the NWA Number is the correct Length
		$nwaLengthError = 0;
		$nwaValidationError = 0;
		if(strlen($nwaNumber) > 7 || strlen($nwaNumber) < 7)
		{
			$nwaLengthError = 1;
		}
		
		//Checks the Contact Number is 11 in Length
		if(strlen($contactNumber) != 11)
		{
			$contactNumberError = 1;
		}
		
		//This Checks that the first six digits are Numerical and the last is a Letter
		if($nwaLengthError == 0)
		{
			//Checks if the first 6 digits are numeric
			for($i = 0;$i < 6;$i++)
			{
				$thispart = substr($nwaNumber,$i,1);
				$test = is_numeric($thispart);
				if($test != 1)
				{
					$nwaValidationError = 1;
				}
			}
			//Checks the last is a letter
				$letter = substr($nwaNumber,6,1);
				if (!(preg_match("/^[a-zA-Z]$/", $letter))) 
				{
					$nwaValidationError = 1;
				}
			
		}
		
		
		//Divide our Players Outpuit
		$players = explode("\n", $players);
		$number = count($players);
		//If there is not enough players in a team, we give a validation error.
		if($number < 11)
		{
			$NotEnoughPlayers = 1;
		}
		
		if($nwaLengthError == 1 || $nwaValidationError == 1 || $NotEnoughPlayers == 1 || $contactNumberError == 1)
		{
			$error = 1;
		}
		
		if($error != 1)
		{
			include 'config/config.php';
			include_once 'controller/mainController.class.php';
			include_once 'model/team.class.php';
			include_once 'model/player.class.php';
			
			$db = new PDO("mysql:host=$server;dbname=$database",$user,$password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
			
			$team = new Team($db);
			$team->setTournamentID($tournamentId);
			$team->setTeamName($teamName);
			$team->setNwaNumber($nwaNumber);
			$team->setContactName($contactName);
			$team->setContactNumber($contactNumber);
			$team->setEmail($email);
			
			$result = $team->addTeamInfo();
			
			try{
				$query_result = $db->query("SELECT teamID FROM wattball_team WHERE teamName = '".$team->getTeamName()."' AND tournamentID = '".$team->getTournamentId()."' ORDER BY teamID DESC");
			}
			catch(PDOException $ex)
			{
				print("<b>An Database Error has occured. Please inform an Adminstrator immediately and try again later</b>");
			}
			
			$data = $query_result->fetch(PDO::FETCH_ASSOC);
			
			$teamID = $data['teamID'];
			
			$team->setTeamID($teamID);
			
			//Player Input
			for($i = 0;$i < $number;$i++)
			{
				trim($players[$i]);
				if($players[$i] != "")
				{
					$player = new Player($db);
					$player->setPlayerName($players[$i]);
					$player->setTeamID($team->getTeamID());
					$result = $player->addPlayerInfo();
				}
			}
			$completed = 1;
		}
	}
	if($completed == 1)
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
		if($error == 1)
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
			<?php
				include 'config/config.php';
				$db = new PDO("mysql:host=$server;dbname=$database",$user,$password);
				$result = $db->query("SELECT COUNT(*) FROM tournament WHERE registrationOpen <= CURDATE() AND registrationClose >= CURDATE() ORDER BY tournamentID DESC");
				$numberOfRows = $result->fetchColumn();
				if($numberOfRows < 1)
				{
					print("<span class='label label-important'>There are no Tournament to Register to at the present time. Please try again later</span><br /><br />");
				}
				else
				{
			?>
			<form class="form-horizontal" method='post' name='wattball_registration' action=''>
				<div class="control-group">
				  <fieldset>
					<legend>Tournament Selection</legend>
					<label class='control-label'>Choose which Tournament to Register to:-</label>
					<div class="controls">
						<select name="tournamentId" id='tournamentId'>
							<?php
								$result = $db->query("SELECT `tournamentID`, `name`, `startDate`, `endDate` FROM tournament WHERE registrationOpen <= CURDATE() AND registrationClose >= CURDATE() ORDER BY tournamentID DESC");
								if($result != false)
								{
									while($data = $result->fetch())
									{
										print("<option value='".$data['tournamentID']."'>".$data['name']." - FROM ".$data['startDate']." TO ".$data['endDate']."</option>");
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
						<input type="text" placeholder="Type something…" name='teamName' id='teamName' value='<?php if($error==1){echo $teamName;} ?>'>
						<span class="help-inline">This is the Name of the Team that you represent</span>
					</div>
					<?php
						if($nwaLengthError == 1 || $nwaValidationError == 1)
						{
					?>
						<div class='control-group error'>
					<?php	
						}
					?>
					<label class='control-label'>NWA Number</label>
					<div class="controls">
						<input type="text" placeholder="Type something…" name='nwaNumber' id='nwaNumber' value='<?php if($error==1){echo $nwaNumber;} ?>'>
					<?php
						if($nwaLengthError == 1 || $nwaValidationError == 1)
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
						if($nwaLengthError == 1 || $nwaValidationError == 1)
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
						<input type="text" placeholder="Type something…" name='contactName' id='contactName' value='<?php if($error==1){echo $contactName;} ?>'>
						<span class="help-inline">Should any problems occur, name someone to be your contact</span>
					</div>
					<?php
						if($contactNumberError)
						{
				
						print("<div class='control-group error'>");
					
						}
					?>
					<label class='control-label'>Contact Number</label>
					<div class="controls">
						<input type="text" placeholder="Type something…" name='contactNumber' id='contactNumber' value='<?php if($error==1){echo $contactNumber;} ?>'>
					
							<span class="help-inline">Please Enter Full Number including Area code (11 Digits)</span>
	
					</div>
					<?php
						if($contactNumberError)
						{
							print("</div>");
						}
					?>
					<label class='control-label'>Contact Email</label>
					<div class="controls">
						<input type="email" placeholder="Type something…" name='email' id='email' value='<?php if($error==1){echo $email;} ?>'>
						<span class="help-inline">Enter a Valid Email we can use to contact you!</span>
					</div>
					<br />
				 </fieldset>
				 <fieldset>
					<legend>Players</legend>
					<?php
						if($NotEnoughPlayers == 1)
						{
					?>
						<div class='control-group error'>
					<?php
						}
					?>
					<label class='control-label'>Enter the Names of Each Player of your Team. One per Line!</label>
					<div class="controls">
						<textarea rows='11' name='players' id='players'><?php if($error==1){echo $_POST['players'];} ?></textarea>
					<?php
						if($NotEnoughPlayers == 1)
						{
					?>
						<span class="help-inline"><b>You must have a team of at least 11 Players</b></span>
					<?php
						}
					?>
					</div>
					<?php
						if($NotEnoughPlayers == 1)
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
			}
			?>
		</div>
	</div>
</div>
