<script src="javascript/staff.js"> </script>
<div class='span9 contentbox'>
    <h3 class="center">Initiate WattBall Scheduling</h3>
    <?php
        echo "<p>Choose a Tournament:</p></br>";
        echo "<select id='selectTournament'>";
        for($i = 0;$i<count($allTournament);$i++)
        {
            echo "<option value='".$allTournament[$i]->getTournamentID()."'>".$allTournament[$i]->getName()."</option>";
        }
        echo "</select>";
    ?>
    </br>
    <fieldset class="center">
      <?php
        
        if($is_scheduled == false)
        {
            echo "<div id='schedulingInfo'>";
            include_once 'include/schedulingInfo.php';
            echo "</div>";
            echo "<button id='startScheduling' class='btn btn-large btn-primary' type='button'>Begin</button>";
        }
        else 
        {
            echo "This tournament is already scheduled</br>";
        }
      ?>
    </fieldset>
    <div id="resultScheduling">
        
    </div>
</div>
</div>