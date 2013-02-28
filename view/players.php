<div class='span9 contentbox'>
    
    <h3 class="center">WattBall Players</h3>
    <?php
        if(count($players) > 0)
        {
    ?>
    <table class="table table-hover table-condensed">
        <thead>
           <tr>
                <th>Player Name</th>
                <th>Team Name</th>
                <th>Players Details</th>
                <th>Team Details</th>
            </tr>
        </thead> 
        <tbody>
    <?php
        for($i=0;$i<count($players);$i++)
        {
            echo "<tr>";
            echo "<td>".$players[$i]->getPlayerName()."</td>";
            echo "<td>".$teamsName[$i]."</td>";
            echo "<td><a href='?player=".$players[$i]->getPlayerID()."' role='button' class='btn btn-mini btn-info'>Player Details</a></td>";
            echo "<td><a href='?team=".$players[$i]->getTeamID()."' role='button' class='btn btn-mini btn-info'>Team Details</a></td>";
            echo "</tr>";
        }
        }
        else
            echo "<div class='alert alert-block'><p>No players</p></br>";
    ?>
        </tbody>
    </table>
</div>
</div>
