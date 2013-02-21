<div class='span9 contentbox'>
        <?php 
            if(count($matchesResults) == 0)
            {
                echo "No results";
            }
            else
            {
                echo "<a class='pull-right' href='index.php?page=generalranking'>Go to Ranking <i class='icon-arrow-right'></i></a></br></br>";
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
                            echo "<td>".$m->getTeam1()->getTeamName()."</td>";
                            echo "<td>".$m->getTeam1Score()." - ".$m->getTeam2Score()."</td>";
                            echo "<td>".$m->getTeam2()->getTeamName()."</td>";
                            echo "<td><a href='index.php?result=".$m->getResultID()."' role='button' class='btn btn-small btn-info'>Match Details</a></td>";
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
                            echo "<td>".$m->getTeam1()->getTeamName()."</td>";
                            echo "<td>".$m->getTeam1Score()." - ".$m->getTeam2Score()."</td>";
                            echo "<td>".$m->getTeam2()->getTeamName()."</td>";
                            echo "<td><a href='index.php?result=".$m->getResultID()."' role='button' class='btn btn-small btn-info'>Match Details</a></td>";
                        echo "</tr>";
                      }
                }
                echo "</tbody>";
                echo "</table>";
            }

        ?>
</div>
</div>
