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
			       <th>Change</th>
			       <th>Delete</th>
		  		 </tr>	
		  		<?php 
		  			$allTournament = $this->tournament;		  			
		  			for($i=0;$i<sizeof($allTournament);$i++)
		  			{
		  				echo "<tr index='test'>";
		  				echo "<td class='name'>".$allTournament[$i]->getName()."</td>";
		  				echo "<td class='startDate' startDate='".$allTournament[$i]->getDateSQLFormat($allTournament[$i]->getStartDate())."'>".$allTournament[$i]->getStartDate()."</td>";
		  				echo "<td class='endDate' endDate='".$allTournament[$i]->getDateSQLFormat($allTournament[$i]->getEndDate())."'>".$allTournament[$i]->getEndDate()."</td>";
		  				echo "<td class='registrationStart' registrationStart='".$allTournament[$i]->getDateSQLFormat($allTournament[$i]->getRegisterOpen())."'>".$allTournament[$i]->getRegisterOpen()."</td>";
		  				echo "<td class='registrationEnd' registrationEnd='".$allTournament[$i]->getDateSQLFormat($allTournament[$i]->getRegisterClose())."'>".$allTournament[$i]->getRegisterClose()."</td>";
		  				echo "<td><button id='".$allTournament[$i]->getTournamentID()."' class='btn btn-warning btn-mini'><i class='icon-white  icon-wrench'</i></button></td>";
		  				echo "<td><button id='".$allTournament[$i]->getTournamentID()."' class='btn btn-danger btn-mini'><i class='icon-white icon-remove-sign'</i></button></td>";		  				
		  				echo "</tr>";
		  			}
		  		?>
			</table>
			<?php 
				if(sizeof($allTournament)==0)
					echo "There is no tournament."
			?>	
		</fieldset>
	</div>
	</br>
	<button id='buttonAddTournament' class="btn btn-primary btn-medium"><i class="icon-white icon-plus-sign"></i> Add a tournament</button>
	
	<div id='addTournament' title='Add a tournament'>
		<form>
			<label for="tournamentName">Tournament Name: </label></br>
			<input type="text" name="tournamentName" id="tournamentName"></br>
			
			<label for="startDate">Start Date: </label>
			<input type="text" id="startDate" class='from' name="startDate">
			<label for="endDate">End Date: </label>
			<input type="text" id="endDate" class='to' name="endDate"></br>
			
			<label for="registrationStartDate">Registration Start Date: </label>
			<input type="text" id="registrationStartDate" class='from' name="registrationStartDate">
			<label for="registrationEndDate">Registration End Date: </label>
			<input type="text" id="registrationEndDate" class='to' name="registrationEndDate"></br>
			<input type='button' value='submit' id='createTournamentValidation'>
		</form>
	</div>
	
	<div id='changeTournament' title='Change a tournament'>
		<form>
			<label for="tournamentNameChange">Tournament Name: </label></br>
			<input type="text" name="tournamentNameChange" id="tournamentNameChange"></br>
			
			<label for="startDateChange">Start Date: </label>
			<input type="text" id="startDateChange" class='fromChange' name="startDateChange">
			<label for="endDateChange">End Date: </label>
			<input type="text" id="endDateChange" class='toChange' name="endDateChange"></br>
			
			<label for="registrationStartDateChange">Registration Start Date: </label>
			<input type="text" id="registrationStartDateChange" class='fromChange' name="registrationStartDateChange">
			<label for="registrationEndDateChange">Registration End Date: </label>
			<input type="text" id="registrationEndDateChange" class='toChange' name="registrationEndDateChange"></br>
			<input type='button' value='submit' id='changeTournamentValidation'>
		</form>
	</div>
	<?php 
}

?>