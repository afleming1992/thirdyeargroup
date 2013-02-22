<div class='span9 contentbox'>
    <h3 class="center">WattBall Ranking</h3>
    </br></br>
    
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
</div>
</div>
