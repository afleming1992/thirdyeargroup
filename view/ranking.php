<div class='span9 contentbox'>
    <h3 class="center">WattBall Ranking</h3>
    </br></br>
    
    <fieldset>
        <legend>Teams Ranking</legend>
        <table class ="table table-condensed table-hover">
        <thead>
            <tr>
                <th>Ranking</th>
                <th>Team</th>
                <th>Won</th>
                <th>Lost</th>
                <th>Drawn</th>
                <th>Match Point</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
        <?php
            for($i=0;$i<count($teams);$i++)
            {
                echo "<tr>";
                echo "<td>".($i+1)."</td>";
                echo "<td>".$teams[$i]->getTeamName()."</td>";
                echo "<td>".$teams[$i]->getWon()."</td>";
                echo "<td>".$teams[$i]->getLost()."</td>";
                echo "<td>".$teams[$i]->getDrawn()."</td>";
                echo "<td>".$teams[$i]->getMatchPoint()."</td>";
                echo "<td><a href='index.php?team=".$teams[$i]->getTeamID()."' role='button' class='btn btn-small btn-info'>Team details</a></td>";
                echo "</tr>";
            }
        ?>
        </tbody>
    </table>
    </fieldset>
    
    <fieldset>
        <legend>Players Ranking</legend>
        <?php
        if(count($players) > 0)
        {
    ?>
    <table class="table table-hover table-condensed">
        <thead>
           <tr>
                <th>Ranking</th>
                <th>Player Name</th>
                <th>Team Name</th>
                <th>Goals</th>
                <th>Players Details</th>
                <th>Team Details</th>
            </tr>
        </thead> 
        <tbody>
    <?php
        for($i=0;$i<count($players);$i++)
        {
            echo "<tr>";
             echo "<td>".($i+1)."</td>";
            echo "<td>".$players[$i]->getPlayerName()."</td>";
            echo "<td>".$teamsName[$i]."</td>";
            echo "<td>".$players[$i]->getGoal()."</td>";
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
    </fieldset>
    
    
    
</div>
</div>
