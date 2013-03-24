<div class='span9 contentbox'>
    
    <a href="index.php?page=wattBall"><i class="icon-arrow-left"></i> Back to the results</a>
    <h3 class='text-info center'><?php echo $matchResults->getTeam1()->getTeamName()." ".$matchResults->getTeam1Score()." - ".$matchResults->getTeam2Score()." ".$matchResults->getTeam2()->getTeamName();  ?></h3>
    <fieldset>
        <legend>Common Informations</legend>        
        <h5 class='text-info'><?php echo "Date: ".$matchResults->getMatchDate();  ?></h5>
        <h5 class='text-info'><?php echo "Hour: ".$time;  ?></h5>
        <h5 class='text-info'><?php echo "Pitch: ".$pitch;  ?></h5>
        <h5 class='text-info'><?php echo "Umpire: ".$umpire->getName();  ?></h5>
    </fieldset>
    </br>
    <fieldset>
        <legend>Results</legend>
        <div class="span5">
            <h5 class='text-success center'><?php echo $matchResults->getTeam1()->getTeamName();  ?></h5>
            <p class='text-info'><?php echo "Score: ".$matchResults->getTeam1Score();  ?></p>
            <?php
            if(count($matchResults->getTeam1Goals()) > 0)
            {?>
                <p class='text-info'>Goal(s):</p>
                <table class='table table-hover'>
                    <thead>
                        <tr>
                            <th>Player</th>
                            <th>Minute</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            for($i=0;$i<count($matchResults->getTeam1Goals());$i++)
                            {
                                $goals = $matchResults->getTeam1Goals();
                                echo "<tr>";
                                echo "<td>".$goals[$i]['player']."</td>";
                                echo "<td>".$goals[$i]['minute']."</td>";
                                echo "</tr>";
                            }
                        ?>       
                    </tbody>                
                </table>
            <?php
            }
            ?>
                <div class="center">
                    <a href='index.php?team=<?php echo $matchResults->getTeam1()->getTeamID(); ?>' role='button' class='btn btn-mini btn-info center'>Team Details</a>
                    </br></br>
                    <a href='index.php?nextmatches=<?php echo $matchResults->getTeam1()->getTeamID(); ?>' role='button' class='btn btn-mini btn-info center'>Next Matches</a>
                </div>
                              
        </div>
        <div class="span1"></div>
        <div class="span5">
            <h5 class='text-success center'><?php echo $matchResults->getTeam2()->getTeamName();  ?></h5>
            <p class='text-info'><?php echo "Score: ".$matchResults->getTeam2Score();  ?></p>
            <?php
            if(count($matchResults->getTeam2Goals()) > 0)
            {?>
                <p class='text-info'>Goal(s):</p>
                <table class='table table-hover'>
                    <thead>
                        <tr>
                            <th>Player</th>
                            <th>Minute</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            for($i=0;$i<count($matchResults->getTeam2Goals());$i++)
                            {
                                $goals = $matchResults->getTeam2Goals();
                                echo "<tr>";
                                echo "<td>".$goals[$i]['player']."</td>";
                                echo "<td>".$goals[$i]['minute']."</td>";
                                echo "</tr>";
                            }
                        ?>       
                    </tbody>                
                </table>
            <?php
            }
            ?>
                <div class="center">
                    <a href='index.php?team=<?php echo $matchResults->getTeam2()->getTeamID(); ?>' role='button' class='btn btn-mini btn-info center'>Team Details</a>
                    </br></br>
                    <a href='index.php?nextmatches=<?php echo $matchResults->getTeam2()->getTeamID(); ?>' role='button' class='btn btn-mini btn-info center'>Next Matches</a>
                </div>
        </div>
        
    </fieldset>
    
</div>
</div>