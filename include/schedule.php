<div class='row-fluid'>
    <table class="table table-hover">
        <thead>
          <tr>
            <th>Teams</th>
            <th>Date</th>
            <th>Hour</th>
            <th>Pitch</th>
            <?php
            if($pageName != 'wattBallReScheduling'){
                echo "<th>Buy Ticket</th>";
            }
            if($pageName == 'wattBallReScheduling')
                echo "<th>Change</th>";
            ?>
          </tr>
        </thead>
        <tbody>
    <?php
        $today = new DateTime(date("Y-m-d"));
        $today->format("Ymd");
        for($i = 0;$i<count($matches);$i++)
        {
            
            echo "<tr>";
            echo "<td id='team1' hidden='true'>".$teams1[$i]->getTeamId()."</td>";
            echo "<td id='team2' hidden='true'>".$teams2[$i]->getTeamId()."</td>";
            echo "<td id='vs' class='text-info center'>".$teams1[$i]->getTeamName()." VS ".$teams2[$i]->getTeamName()."</td>";
            echo "<td id='date' dateSQL='".$matches[$i]->getDateSQLFormat()."'>".$matches[$i]->getDate()."</td>";
            echo "<td id='hour' >".$matches[$i]->getHour()."</td>";
            echo "<td id='pitch' >".$matches[$i]->getPitch()."</td>";
            if($pageName != 'wattBallReScheduling'){
                list($Y,$m,$d)=explode('-',  $matches[$i]->getDateSQLFormat());
                $date = new DateTime(Date("Y-m-d", mktime(0,0,0,$m,$d,$Y)));
                $date->format("Ymd");
                if($today <= $date)
                    echo "<td><a href='?page=ticketPurchase&date=".$matches[$i]->getDateSQLFormat()."' class='btn btn-small btn-primary'><i class='icon-shopping-cart icon-white'></i> Buy</a></td>";
                else
                    echo "<td><a href='#' class='btn btn-small btn-primary disabled'><i class='icon-shopping-cart icon-white'></i> Buy</a></td>";
            }
            if($pageName == 'wattBallReScheduling')
            {
                echo "<td><button id='".$matches[$i]->getID()."' data-target='#changeSchedule' class='btn btn-small btn-primary' type='button'><i class='icon-wrench icon-white'></i> Re-Schedule</button></td>";
            }
            echo "</tr>";
        }
    
    ?>
           </tbody>
    </table>
</div>
