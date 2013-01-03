<?php
//Function which display the login form if user try to go to the staff page without sign in
function addLogin()
{
    require_once 'view/login.php';
    ?>
    <div class="alert alert-block" style="text-align: center">
      <h4>Warning!</h4>
      You must be logged in to view this page ! </br></br>
      <a role='button' class='btn btn-warning' href='#login' data-toggle='modal'>Staff Login</a>
    </div>
    <?php
    require_once 'view/footer.php';
}

if(!isset($_SESSION['login']))
{
    addLogin();
    die();
}
else if(isset($_SESSION['login']) && $_SESSION['login']==FALSE)
{
    addLogin();
    die();
}
?>

<div class='row-fluid'>
	<div class='span3 contentbox'>
<?php
require_once 'view/menu-staff.php';
?>
	</div>
		<div class='span9 contentbox'>
<?php
//echo "Hello ".$staff->getName();

if ($staff->getManager()== 1)
{
	?>
	<script src="javascript/staff.js"> </script>    
	
	<div id="tournamentList">
		<fieldset>
		<legend>All Tournament</legend>
			<table  class='table table-hover table-bordered'>
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
		  				echo "<td><button type='button' data-toggle='modal' data-target='#changeTournament' id='".$allTournament[$i]->getTournamentID()."' class='btn btn-warning btn-mini'><i class='icon-white  icon-wrench'</i></button></td>";
		  				echo "<td><button id='".$allTournament[$i]->getTournamentID()."' class='btn btn-danger btn-mini'><i class='icon-white icon-remove-sign'</i></button></td>";		  				
		  				echo "</tr>";
		  			}
		  		?>
			</table>
			<?php 
				if(sizeof($allTournament)==0)
					echo "There are no tournament."
			?>	
		</fieldset>
	</div>
	</br>

	<!-- Div add tournament  -->
	
	<div id="addTournament" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
		<div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
   			 <h3 id="myModalLabel">Add a tournament</h3>
 		</div>
 		<div class="modal-body">
			<label for="tournamentName">Tournament Name: </label>
			<input type="text" name="tournamentName" id="tournamentName"></br>
			
			<label for="startDate">Start Date: </label>
			<input type="text" id="startDate" class='from' name="startDate">
			<label for="endDate">End Date: </label>
			<input type="text" id="endDate" class='to' name="endDate"></br>
			
			<label for="registrationStartDate">Registration Start Date: </label>
			<input type="text" id="registrationStartDate" class='from' name="registrationStartDate">
			<label for="registrationEndDate">Registration End Date: </label>
			<input type="text" id="registrationEndDate" class='to' name="registrationEndDate"></br>
			
		</div>
		 <div class="modal-footer">
		    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		    <button type='button' value='submit' aria-hidden="true" id='createTournamentValidation' class="btn btn-primary btn-medium"><i class="icon-white icon-ok-sign"></i> Save</button>
  		</div>
	</div>
	
	<button type="button" data-toggle="modal" class="btn btn-primary btn-medium" data-target="#addTournament"><i class="icon-plus-sign icon-white"></i> Add tournament</button>
		</div>
	</div>
</div>
	
	
	<!-- Div change tournament  -->
	
	
	<div id="changeTournament" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
		<div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
   			 <h3 id="myModalLabel">Change a tournament</h3>
 		</div>
 		<div class="modal-body">
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
		</div>
		 <div class="modal-footer">
		    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		    <button type='button' value='submit' id='changeTournamentValidation' class="btn btn-primary btn-medium"><i class="icon-white icon-ok-sign"></i> Save</button>
  		</div>
	</div>
	
</div>
	<?php 
}

?>
