<script src="javascript/wattBall.js"> </script>
<?php
if($pageName == 'wattBallReScheduling')
{
    echo "<script src='javascript/wattBallReScheduling.js'> </script>";
}

?>
<div class='span9 contentbox'>
    <h3 class="center">WattBall Schedule</h3>
    <?php
        echo "<p>Choose a Tournament:</p>";
        echo "<select id='selectTournament'>";
        for($i = 0;$i<count($allTournament);$i++)
        {
            echo "<option value='".$allTournament[$i]->getTournamentID()."'>".$allTournament[$i]->getName()."</option>";
        }
        echo "</select>";
    ?>
    </br>
    <div id="schedule">
        <?php 
            include_once 'include/schedule.php';
        ?>
    </div>
    
    <div id="changeSchedule" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Re-Scheduling</h3>
        </div>
        <div class="modal-body">               
            <div id="changeDate">
                <label for="date">Date: </label>
                <input type="text" name="date" id="modalDate"></br>
            </div>
            
            <div id="changeHour">
                <label for="hour">Hour: </label>
                <select name="hour" id='modalHour'>
                    <option value="10am">10am</option>
                    <option value="2pm">2pm</option>
                </select></br>                
            </div>
            
            <div id="changePitch">
                <label for="pitch">Pitch: </label>
                <input type="text" name="pitch" id="modalPitch"></br><span id="help-inline-tournamentName" class="help-inline"></span>
            </div>
            
            <div id="umpireChange">
				<label for="umpire">Umpire: </label>
				<span class="input-xmedium uneditable-input" id="umpire"></span>
			</div>
        </div>
         <div class="modal-footer">
            <button id="closeModalReSchedule" class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            <button type='button' value='submit' aria-hidden="true" id='reSchedule' class="btn btn-primary btn"><i class="icon-white icon-ok-sign"></i> Save</button>
        </div>
        
    </div>    
    
</div>
</div></div></div></div>

