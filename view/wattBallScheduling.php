<script src="javascript/wattBall.js"> </script>

<div class='span9 contentbox'>
    <h3 class="center">WattBall Schedule</h3>
    <?php        
        echo "<h5 class='text-info'>".$allTournament[0]->getName()."</h5>";
        if(count($allTournament) > 1)
        {
            echo "<p>Choose a Tournament:</p>";
            echo "<select id='selectTournament'>";
            for($i = 0;$i<count($allTournament);$i++)
            {
                echo "<option value='".$allTournament[$i]->getTournamentID()."'>".$allTournament[$i]->getName()."</option>";
            }
            echo "</select>";
        }
        
    ?>
    </br>
    <div id="schedule">
        <?php 
            include_once 'include/schedule.php';
        ?>
    </div>
</div>
</div>
</div>
</div>

