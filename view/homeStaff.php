<?php

echo "Hello ".$staff->getName();

if ($staff->getManager()== 1)
{
	?>
	<script src="javascript/staff.js"> </script>    
	
	<div id="tournamentList">
		<fieldset>
		<legend>All Tournament</legend>
			<table>
		  		<tr>
			       <th>Name</th>
			       <th>Start Date</th>
			       <th>End Date</th>
			       <th>Registration Open</th>
			       <th>Registration Close</th>
		  		 </tr>	
		  		<?php 
		  			$allTournament = $this->tournament;
		  			for($i=0;$i<sizeof($allTournament);$i++)
		  			{
		  				echo "<tr>";
		  				echo "<td>".$allTournament[$i]->getName()."</td>";
		  				echo "<td>".$allTournament[$i]->getStartDate()."</td>";
		  				echo "<td>".$allTournament[$i]->getEndDate()."</td>";
		  				echo "<td>".$allTournament[$i]->getRegisterOpen()."</td>";
		  				echo "<td>".$allTournament[$i]->getRegisterClose()."</td>";
		  				echo "</tr>";
		  			}
		  		?>
			</table>	
		</fieldset>
	</div>
	
	
	<div id='addTournament'>
		<fieldset>
		<legend>Create Tournament</legend>
		<form>
			<label for="tournamentName">Tournament Name: </label></br>
			<input type="text" name="tournamentName" id="tournamentName"></br>
			
			<label for="startDate">Start Date: </label>
			<input type="text" id="startDate" name="startDate">
			<label for="endDate">End Date: </label>
			<input type="text" id="endDate" name="endDate"></br>
			
			<label for="registrationStartDate">Registration Start Date: </label>
			<input type="text" id="registrationStartDate" name="registrationStartDate">
			<label for="registrationEndDate">Registration End Date: </label>
			<input type="text" id="registrationEndDate" name="registrationEndDate"></br>
			<input type='button' value='submit' id='createTournamentValidation'>
		</form>
		</fieldset>
	</div>
	<?php 
}

?>