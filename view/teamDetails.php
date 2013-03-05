<div class='span9 contentbox'>
    
    <a href="index.php?page=teams"><i class="icon-arrow-left"></i> Back to the Teams</a></br></br>
    <h3 class="text-info center"><?php echo $team->getTeamName(); ?></h3>
    <fieldset>
        <legend>Common informations</legend>
        <p class='text-info'>NWA Number: <?php echo $team->getNWANumber(); ?></p>
        <p class='text-info'>Played Matches: <?php echo count($team->getMatchesDone()); ?></p>
        <p class='text-info'>Upcoming Matches: <?php echo count($team->getComingMatches()); ?></p>
        <a  href="index.php?nextmatches=<?php echo $team->getTeamID(); ?>" role='button' class='btn btn-medium btn-info'>Team Matches</a>
    </fieldset>
    </br>
    <fieldset>
        <legend>Ranking</legend>
            <a class="pull-right" href="index.php?page=ranking">Go to Gloabal Ranking <i class="icon-arrow-right"></i> </a></br></br>
            <?php
            if(!$isRanking)
                echo "<div class='alert alert-block'><p>No Ranking</p></br>";
            else
            {?>
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th colspan="3"><p class="center">Match</p></th>
                            <th colspan="2"><p class="center">Goals</p></th>
                        </tr>
                        <tr>
                            <th>Won</th>
                            <th>Lost</th>
                            <th>Drawn</th>
                            <th>For</th>
                            <th>Against</th>
                            <th>Match Point</th>
                            <th>Goal difference</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $team->getWon(); ?></td>
                            <td><?php echo $team->getLost(); ?></td>
                            <td><?php echo $team->getDrawn(); ?></td>
                            <td><?php echo $team->getGoalFor(); ?></td>
                            <td><?php echo $team->getGoalAgainst(); ?></td>
                            <td><?php echo $team->getMatchPoint(); ?></td>
                            <td><?php echo $team->getGoalDifference(); ?></td>
                        </tr>
                    </tbody>
                </table>
                <p class='text-info'>Ranking: <?php echo $team->getTeamRanking(); ?></p>
            <?php
            }
            ?>
    </fieldset>
    
    <fieldset>
        <legend>Players</legend>    
        <table class='table table-striped table-condensed'>
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
                echo "<td><a href='?player=".$p->getPlayerID()."' role='button' class='btn btn-mini btn-info'>Player Details</a></td>";
                echo "</tr>";
            }
       ?>
            </tbody>
        </table>
    </fieldset>
</div>
</div>
