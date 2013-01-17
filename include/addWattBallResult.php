<?php ?>
<fieldset>
        <legend>Search a match</legend>
        <div class="span5">
            <label class='control-label'>Date</label>
            <div class="controls">
                <input type="text" name='date' id='date'>
                <input type="hidden" id="tournamentID" value="<?php echo $tournament[0]->getTournamentID();?>">
                <button id="search" class="btn btn-success"><i class="icon-white icon-ok"></i> Search a match</button>
            </div>
        </div>
        <div class="span5">
           <label class='control-label'>Choose a match: </label>
                <div class="controls">
                        <select name="matches" id='matches'>
                                <?php
                                    for($i = 0;$i<count($matches);$i++)
                                    {
                                        echo "<option value='".$matches[$i]['match']->getId()."'>".$matches[$i]['team1']->getTeamName()." VS ".$matches[$i]['team2']->getTeamName()."</option>";
                                    }
                                        
                                ?>
                            <option> TEST</option>
                        </select>
                </div>
        </div>
    </fieldset>
    </br>
    <fieldset>
        <legend>Result</legend>
        <div class="span5">
            <?php echo "<p class='text-info'>".$matches[0]['team1']->getTeamName()."</p>"; ?>
            <label class='control-label'>Total number of Goals</label>
            <div class="controls">
                <input type="text" name='goalTeam1' id='goalTeam1'>
            </div>
            <label class='control-label'>By</label>
            <div class="controls">
                <select name="playersTeam1" id='playersTeam1'>
                    <?php
                    for($i = 0;$i<count($matches[0]['playersTeam1']);$i++)
                    {
                        echo "<option value='".$matches[0]['playersTeam1'][$i]->getPlayerID()."'>".$matches[0]['playersTeam1'][$i]->getPlayerName()."</option>";
                    }
                    ?>
                </select>
            </div>
            <label class='control-label'>At</label>
            <div class="controls">
                <input class="span3" type="number" id="minuteTeam1" /><span class='help-inline'> minutes</span>                
            </div>
            <button id="addGoalTeam1" class="btn btn-primary"><i class="icon-white icon-plus"></i> Add a Goal</button>
            <p></p></br>
            <table id="goalsTeam1" class="table table-striped">
                <thead>
                    <tr>
                    <th>Name</th>
                    <th>Minute</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody> 
            </table>
        </div>
        
        <div class="span5">
            <?php echo "<p class='text-info'>".$matches[0]['team2']->getTeamName()."</p>"; ?>
            <label class='control-label'>Total number of Goals</label>
            <div class="controls">
                <input type="text" name='goalTeam2' id='goalTeam2'>
            </div>
            <label class='control-label'>By</label>
            <div class="controls">
                <select name="playersTeam2" id='playersTeam2'>
                    <?php
                    for($i = 0;$i<count($matches[0]['playersTeam2']);$i++)
                    {
                        echo "<option value='".$matches[0]['playersTeam2'][$i]->getPlayerID()."'>".$matches[0]['playersTeam2'][$i]->getPlayerName()."</option>";
                    }
                    ?>
                </select>
            </div>
            <label class='control-label'>At</label>
            <div class="controls">
                <input class="span3" type="number" id="minuteTeam2" /><span class='help-inline'> minutes</span>                
            </div>
            <button id="addGoalTeam2" class="btn btn-primary"><i class="icon-white icon-plus"></i> Add a Goal</button>
            <p></p></br>
            <table id="goalsTeam2" class="table table-striped">
                <thead>
                    <tr>
                    <th>Name</th>
                    <th>Minute</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody> 
            </table>
        </div>
        
    </fieldset>
