<div class='span9 contentbox'>
    
    <?php
    if(isset($_SESSION['backTeamDetails']))
        echo "<a href='index.php?team=".$_SESSION['backTeamDetails']."'><i class='icon-arrow-left'></i> Back to the Team Details</a>";
    else if(isset($_SESSION['back']) && $_SESSION['back'] == "players")
        echo "<a href='index.php?page=".$_SESSION['back']."'><i class='icon-arrow-left'></i> Back to the Players</a>";
    unset($_SESSION['backTeamDetails']);
    unset($_SESSION['back']);
    ?>
    <h3 class="text-info center"><?php echo $player->getPlayerName(); ?></h3>
    <fieldset>
        <legend>Common informations</legend>
        <p class='text-info'>Team Name: <?php echo "<a href='?team=".$player->getTeamID()."'>".$teamName."</a>"; ?></p>
        <p class='text-info'>Goals: <?php echo $player->getGoal(); ?></p>
    </fieldset>
    
    
</div>
</div>
