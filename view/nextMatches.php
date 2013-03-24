<div class='span9 contentbox'>
    
    <?php
    if(isset($_SESSION['backTeamDetails']))
        echo "<a href='index.php?team=".$_SESSION['back']."'><i class='icon-arrow-left'></i> Back to the Team Details</a>";
    else if(isset($_SESSION['backResult']))
        echo "<a href='index.php?result=".$_SESSION['backResult']."'><i class='icon-arrow-left'></i> Back to the Results Details</a>";
    unset($_SESSION['backTeamDetails']);
    unset($_SESSION['backResult']);
    echo "<h3 class='text-info center'>".$team->getTeamName()."</h3>";    
    if(count($comingMatches) > 0){
        ?>
        <h3>Upcoming Matches</h3>
        <table class="table table-hover">
        <thead>
          <tr>
            <th>Teams</th>
            <th>Date</th>
            <th>Hour</th>
            <th>Pitch</th>
            <th>Umpire</th>
            <th>Buy Ticket</th>
          </tr>
        </thead>
        <tbody>
    <?php
        for($i = 0;$i<count($comingMatches);$i++)
        {
            
            echo "<tr>";
            echo "<td id='vs'>".$comingMatches[$i]->getTeam1()->getTeamName()." VS ".$comingMatches[$i]->getTeam2()->getTeamName()."</td>";
            echo "<td id='date' dateSQL='".$comingMatches[$i]->getDateSQLFormat()."'>".$comingMatches[$i]->getDate()."</td>";
            echo "<td id='hour' >".$comingMatches[$i]->getHour()."</td>";
            echo "<td id='pitch' >".$comingMatches[$i]->getPitch()."</td>";
            echo "<td id='umpire' >".$comingMatches[$i]->getUmpireName()."</td>";
            echo "<td><a href='?page=ticketPurchase&date=".$comingMatches[$i]->getDateSQLFormat()."' class='btn btn-small btn-primary'><i class='icon-shopping-cart icon-white'></i> Buy</a></td>";
            echo "</tr>";
        }
    
    ?>
           </tbody>
    </table>
        <?php
    }
    
    if(count($matchesDone) > 0){
       ?>
        <h3>Finished Matches</h3>
        <table class="table table-hover">
        <thead>
          <tr>
            <th>Team</th>
            <th>Score</th>
            <th>Team</th>
            <th>Details</th>
          </tr>
        </thead>
        <tbody>
    <?php
        for($i = 0;$i<count($matchesDone);$i++)
        {
            
            echo "<tr>";
            echo "<td>".$matchesDone[$i]->getTeam1()->getTeamName()."</td>";
            echo "<td>".$matchesResults[$i]->getTeam1Score()." - ".$matchesResults[$i]->getTeam2Score()."</td>";
            echo "<td>".$matchesDone[$i]->getTeam1()->getTeamName()."</td>";
            echo "<td><a href='index.php?result=".$matchesResults[$i]->getResultID()."' role='button' class='btn btn-small btn-primary'>Match Details</a></td>";
            echo "</tr>";
        }
    
    ?>
           </tbody>
    </table>
        <?php
    }
        
    ?>
</div>
</div>
