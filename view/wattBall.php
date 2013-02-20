<div class='span9 contentbox'>
        <?php 
            if(count($matchesResults) == 0)
            {
                echo "No results";
            }
            else
            {
                $date = $matchesResults[0]->getMatchDate();
                echo "<h3 class='text-info'>$date</h3>";
                echo "<table class='table table-hover'>";
                echo "<thead>";
                echo "<tr>";
                    echo "<th>Team</th>";
                    echo "<th>Score</th>";
                    echo "<th>Team</th>";
                    echo "<th>Details</th>";
                echo "</tr>";        
                echo "</thead>";
                echo "<tbody>";           
                foreach ($matchesResults as $m)
                {                    
                    if($date == $m->getMatchDate())
                    {
                        echo "<tr>";
                            echo "<th>".$m->getTeam1()->getTeamName()."</th>";
                            echo "<th>".$m->getTeam1Score()." - ".$m->getTeam2Score()."</th>";
                            echo "<th>".$m->getTeam2()->getTeamName()."</th>";
                            echo "<th><button class='btn btn-small btn-info' type='button'>See details</button></th>";
                        echo "</tr>";
                    }
                    else
                    {
                        echo "</tbody>";
                        echo "</table>";
                        $date = $m->getMatchDate();
                        echo "<h3 class='text-info'>$date</h3>";
                        echo "<table class='table table-hover'>";
                        echo "<thead>";
                        echo "<tr>";
                            echo "<th>Team</th>";
                            echo "<th>Score</th>";
                            echo "<th>Team</th>";
                            echo "<th>Details</th>";
                        echo "</tr>";        
                        echo "</thead>";
                        echo "<tbody>";
                        echo "<tr>";
                            echo "<th>".$m->getTeam1()->getTeamName()."</th>";
                            echo "<th>".$m->getTeam1Score()." - ".$m->getTeam2Score()."</th>";
                            echo "<th>".$m->getTeam2()->getTeamName()."</th>";
                            echo "<th><button class='btn btn-small btn-info' type='button'>See details</button></th>";
                        echo "</tr>";
                        
                    }
                }
                echo "</tbody>";
                echo "</table>";
            }

        ?>
</div>
</div>
