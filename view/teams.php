<div class='span9 contentbox'>
    <?php
        if($data == false)
            echo "<p class='text-error'>No registered teams !</p>";
        else
        {            
        ?>
            <a class="pull-right" href="index.php?page=generalranking">Go to General Ranking <i class="icon-arrow-right"></i></a></br></br>
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Team Name</th>
                    <th>Contact Name</th>
                    <th>NWA Number</th>
                    <th>Team Details</th>
                  </tr>
                </thead>
                <tbody>
        <?php
            for($i=0;$i<count($teams);$i++)
            {
                echo "<tr>";
                echo "<td>".$teams[$i]->getTeamName()."</td>";
                echo "<td>".$teams[$i]->getContactName()."</td>";
                echo "<td>".$teams[$i]->getNWANumber()."</td>";
                echo "<td><a href='index.php?team=".$teams[$i]->getTeamID()."' role='button' class='btn btn-small btn-info'>Team details</a></td>";
                echo "</tr>";
            }
            echo "</tbody>";
             echo "</table>";
        }
        
    ?>
    
</div>
</div>
