<div class='span9 contentbox'>

   <?php
        if($data == false)
            echo "<p class='text-error'>No registered teams !</p>";
        else
        {            
        ?>
            <h3 class="center">WattBall Teams</h3>
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Team Name</th>
                    <th>Contact Name</th>
                    <th>Contact Number</th>
                    <th>Contact Email</th>
                    <th>NWA Number</th>
                    <th>Change Team</th>
                  </tr>
                </thead>
                <tbody>
        <?php
            for($i=0;$i<count($teams);$i++)
            {
                echo "<tr>";
                echo "<td>".$teams[$i]->getTeamName()."</td>";
                echo "<td>".$teams[$i]->getContactName()."</td>";
                echo "<td>".$teams[$i]->getContactNumber()."</td>";
                echo "<td>".$teams[$i]->getEmail()."</td>";
                echo "<td>".$teams[$i]->getNWANumber()."</td>";
                echo "<td><a href='index.php?changeTeam=".$teams[$i]->getTeamID()."' role='button' class='btn btn-small btn-info'>Change Team details</a></td>";
                echo "</tr>";
            }
            echo "</tbody>";
             echo "</table>";
        }
        
    ?>
    
</div>
</div>
