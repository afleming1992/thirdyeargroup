<div class='row-fluid'>
    <div class='span3 contentbox'>
        <ul class="nav nav-list">
            
            <li <?php if($pageName == "home") echo "class='active'"; ?> ><a href="index.php?adminPage=home">Home</a></li>
            
            <li class="nav-header">Scheduling</li>
            <li class="divider"></li>
            <li <?php if($pageName == "wattBallScheduling") echo "class='active'"; ?>><a href="index.php?adminPage=wattBallScheduling">Initiate WattBall Scheduling</a></li>
            <li>Initiate Hurdles Scheduling</li>
            <li>Edit WattBall Schedule</li>
            <li>Edit Hurdle Schedule</li>
            <li <?php if($pageName == "umpireManagement") echo "class='active'"; ?>><a href='index.php?adminPage=umpireManagement'>Umpire Management</a></li>
            <li>Update Performance Time</li>
            
            <li class="nav-header">Registration</li>
            <li class="divider"></li>
            <li>View Wattball</li>
            <li>View Male Hurdles</li>
            <li>View Female Hurdles</li>
            
            <li class="nav-header">Ticketing</li>
            <li class="divider"></li>
            <li>Ticket Status</li>
            <li>Process Ticket Purchase</li>
            <li>Postal Ticket Sales List</li>
            <li>On Day Ticket Sales List</li>
            
            <li class="nav-header">Results</li>
            <li class="divider"></li>
            <li <?php if($pageName == "addWattBallResults") echo "class='active'"; ?>><a href='index.php?adminPage=addWattBallResults'>Add WattBall Results</a></li>
            <li>Add Hurdle results</li>
            <?php 
            if($staff->getManager() == 1)
            {
                ?>
                <li class="nav-header">Management</li>
                <li class="divider"></li>
                <li <?php if($pageName == "tournamentManagement") echo "class='active'"; ?>><a href='index.php?adminPage=tournamentManagement'>Tournaments Managment</a></li>
                <li>Staff Manager</li>
                <?php
            }
            ?>
        </ul>
    </div>

