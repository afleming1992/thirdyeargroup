<div class='row-fluid'>
    <?php
        for($i = 0;$i<count($matches);$i++)
        {
            if($i % 3 == 0)
                 echo "<div class='row-fluid'>";
            echo "<div class='span4 bordered'>";
            echo "<p class='text-info center'>".$teams1[$i]->getTeamName()." VS ".$teams2[$i]->getTeamName()."</p>";
            echo "<p> Date: ".$matches[$i]->getDate()."</p>";
            echo "<p> Hour: ".$matches[$i]->getHour()."</p>";
            echo "<p> Pitch: ".$matches[$i]->getPitch()."</p>";
            echo "</div>";
            if($i % 3 == 0)
                 echo "</div'>";
        }
    
    ?>
    </div>
