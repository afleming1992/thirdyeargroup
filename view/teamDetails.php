<div class='span9 contentbox'>
    
    <a href="index.php?page=teams"><i class="icon-arrow-left"></i> Back to the Teams</a></br></br>
    <h3 class="text-info center"><?php echo $team->getTeamName(); ?></h3>
    <fieldset>
        <legend>Common informations</legend>
        
    </fieldset>
    
    <fieldset>
        <legend>Players</legend>    
        <table class='table table-striped'>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Goals</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
       <?php
            foreach ($players as $p)
            {
                echo "<tr>";
                echo "<td>".$p->getPlayerName()."</td>";
                echo "<td>".$p->getGoal()."</td>";
                echo "<td><a href='?player='".$p->getPlayerID()."role='button' class='btn btn-small btn-info'>Player Details</a></td>";
                echo "</tr>";
            }
       ?>
            </tbody>
        </table>
    </fieldset>
</div>
</div>
