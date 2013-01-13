<div class='span9 contentbox'>		
<?php


if ($staff->getManager()== 1)
{
	?>
	<script src="javascript/staff.js"> </script>    
	
	<div id="tournamentList">
        <?php             
            require_once 'include/allTournament.php';
        ?>
	</div>
	</br>

	<!-- Div add tournament  -->
	
	<div id="addTournament" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
		<div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
   			 <h3 id="myModalLabel">Add a tournament</h3>
 		</div>
 		<div class="modal-body">
                    <div id="addTournamentType">
			<label for="tournamentType">Tournament Type: </label>
			<select type="text" name="tournamentType" id="tournamentType">
                            <option value="wattBall">WattBall</option>
                            <option value="hurdle">Hurdle</option>
                        </select>
                    </div>                    
                    <div id="addTournamentName">
			<label for="tournamentName">Tournament Name: </label>
			<input type="text" name="tournamentName" id="tournamentName"></br><span id="help-inline-tournamentName" class="help-inline"></span></br>
                    </div>
                    <div id="addTournamentStartDate">
			<label for="startDate">Start Date: </label>
			<input type="text" id="startDate" class='from' name="startDate"></br><span id="help-inline-startDate" class="help-inline"></span>
                    </div> 
                    <div id="addTournamentEndDate">
			<label for="endDate">End Date: </label>
			<input type="text" id="endDate" class='to' name="endDate"></br><span id="help-inline-endDate" class="help-inline"></span></br>
                    </div>
                    <div id="addTournamentregistrationStartDate">
			<label for="registrationStartDate">Registration Start Date: </label>
			<input type="text" id="registrationStartDate" class='from' name="registrationStartDate"></br><span id="help-inline-registrationStartDate" class="help-inline"></span>
                    </div>
                    <div id="addTournamentregistrationEndDate">
                        <label for="registrationEndDate">Registration End Date: </label>
			<input type="text" id="registrationEndDate" class='to' name="registrationEndDate"></br><span id="help-inline-registrationEndDate" class="help-inline"></span></br>
                    </div>
		</div>
		 <div class="modal-footer">
		    <button id="closeModalAddTournament" class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		    <button type='button' value='submit' aria-hidden="true" id='createTournamentValidation' class="btn btn-primary btn"><i class="icon-white icon-ok-sign"></i> Save</button>
  		</div>
	</div>
	
	<button type="button" data-toggle="modal" class="btn btn-primary btn-medium" data-target="#addTournament"><i class="icon-plus-sign icon-white"></i> Add tournament</button>
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
