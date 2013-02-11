<div class='row-fluid'>
    <table class="table table-hover">
        <thead>
          <tr>
            <th>Teams</th>
            <th>Date</th>
            <th>Hour</th>
            <th>Pitch</th>
            <?php
            if($pageName == 'wattBallReScheduling')
                echo "<th>Change</th>";
            ?>
          </tr>
        </thead>
        <tbody>
    <?php
        for($i = 0;$i<count($matches);$i++)
        {
            echo "<tr>";
            echo "<td id='vs' class='text-info center'>".$teams1[$i]->getTeamName()." VS ".$teams2[$i]->getTeamName()."</td>";
            echo "<td id='date' dateSQL='".$matches[$i]->getDateSQLFormat()."'>".$matches[$i]->getDate()."</td>";
            echo "<td id='hour' >".$matches[$i]->getHour()."</td>";
            echo "<td id='pitch' >".$matches[$i]->getPitch()."</td>";
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
