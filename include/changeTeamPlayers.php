 <?php
        if(count($players) > 0)
        {
    ?>
    <table id="table" class="table table-hover table-condensed">
        <thead>
           <tr>
                <th>Player Name</th>
                <th>Change Player Name</th>
                <th>Players Details</th>
                <th>Team Details</th>
                <th>Delete Players</th>
            </tr>
        </thead> 
        <tbody>
    <?php
        for($i=0;$i<count($players);$i++)
        {
            echo "<tr>";
            echo "<td id='name'>".$players[$i]->getPlayerName()."</td>";
            echo "<td><button id='".$players[$i]->getPlayerID()."' title='Change players details' class='btn btn-small btn-warning'><i class='icon-white  icon-wrench'</i></button></td>";
            echo "<td><a href='?player=".$players[$i]->getPlayerID()."' role='button' class='btn btn-mini btn-info'>Player Details</a></td>";
            echo "<td><a href='?team=".$players[$i]->getTeamID()."' role='button' class='btn btn-mini btn-info'>Team Details</a></td>";
            echo "<td><button id='".$players[$i]->getPlayerID()."' title='Delete Player' class='btn btn-danger btn-small'><i class='icon-white icon-remove-sign'</i></button></td>";
            echo "</tr>";
        }
        }
        else
            echo "<div class='alert alert-block'><p>No players</p></br>";
    ?>
        </tbody>
    </table>
