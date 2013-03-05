<div class='span9 contentbox'>
    
    <a href="index.php?page=players"><i class="icon-arrow-left"></i> Back to the Players</a></br></br>
    <h3 class="text-info center"><?php echo $player->getPlayerName(); ?></h3>
    <fieldset>
        <legend>Common informations</legend>
        <p class='text-info'>Team Name: <?php echo "<a href='?team=".$player->getTeamID()."'>".$teamName."</a>"; ?></p>
        <p class='text-info'>Goals: <?php echo $player->getGoal(); ?></p>
    </fieldset>
    
    
</div>
</div>
