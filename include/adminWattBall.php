<?php
    if(isset($delete) && $delete == false)
    {
        echo "<div class='alert alert-error'>";
        echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
        echo "<p>You can't delete this team !</p>";
        echo "</div>";
    }
    else if(isset($delete) && $delete == true)
    {
        echo "<div class='alert alert-success'>";
        echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
        echo "<p>Team Deleted !</p>";
        echo "</div>";
    }
    if($isScheduled)
    {
        echo "<div class='alert alert-info'>";
        echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
        echo "<p>You can't Delete Team if matches are scheduled</p>";
        echo "</div>";
    }
    if($data == false)
        echo "<p class='text-error'>No registered teams !</p>";
    else
    {            
    ?>

        <h3 class="center">WattBall Teams</h3>
        <table id="teams" class="table table-hover">
            <thead>
              <tr>
                <th>Team Name</th>
                <th>Contact Name</th>
                <th>Contact Number</th>
                <th>Contact Email</th>
                <th>NWA Number</th>
                <th>Change Team Details</th>
                <?php if($isTournamentStarted == false && $isScheduled == false) echo "<th>Delete Team</th>" ?>
              </tr>
            </thead>
            <tbody>
    <?php
        for($i=0;$i<count($teams);$i++)
        {
            echo "<tr>";
            echo "<td>".$teams[$i]->getTeamName()."</td>";
            echo "<td>".$teams[$i]->getContactName()."</td>";
            echo "<td>".$teams[$i]->getContactNumber()."</td>";
            echo "<td>".$teams[$i]->getEmail()."</td>";
            echo "<td>".$teams[$i]->getNWANumber()."</td>";
            echo "<td><a href='index.php?changeTeam=".$teams[$i]->getTeamID()."' role='button' class='btn btn-small btn-warning'><i class='icon-white  icon-wrench'</i></a></td>";
            if($isTournamentStarted == false && $isScheduled == false) 
                echo "<td><button id='".$teams[$i]->getTeamID()."' class='btn btn-danger btn-small'><i class='icon-white icon-remove-sign'</i></button></td>";
            echo "</tr>";
        }
        echo "</tbody>";
         echo "</table>";
    }

?>
