<?php ?>
<fieldset>
        <legend>Search a match</legend>
        
        <div class="span5">
            <label class='control-label'>Date</label>
            <div class="controls">
                <input type="text" name='date' id='date'>
                <input type="hidden" id="tournamentID" value="<?php if(count($matches) > 0){ echo $tournament[0]->getTournamentID();}else{echo "0";}?>">
                <button id="search" class="btn btn-success"><i class="icon-white icon-ok"></i> Search a match</button>
            </div>
        </div>
        <div class="span5">
           <label class='control-label'>Choose a match: </label>
                <div class="controls">
                        <select class="span12" name="matches" id='matches'>
                                <?php
                                if(count($matches) > 0)
                                {
                                    for($i = 0;$i<count($matches);$i++)
                                    {
                                        echo "<option value='".$matches[$i]['match']->getId()."'>".$matches[$i]['team1']->getTeamName()." VS ".$matches[$i]['team2']->getTeamName()."</option>";
                                    }
                                }
                                else
                                    echo "<option>No Matches</option>";
                                    
                                        
                                ?>
                        </select>
                </div>
        </div>
    </fieldset>
    </br>
    <fieldset>
        <legend>Result</legend>
        <?php 
        if(count($matches) > 0)
        {
        ?>
        <div class="span5">
            <?php echo "<p class='text-info'>".$matches[0]['team1']->getTeamName()."</p>"; ?>
            
            <label class='control-label'>Goal By</label>
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
            
            <label class='control-label'>Goal By</label>
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
        <?php
        }
        ?>
    </fieldset>
    
    <fieldset>
        <legend>Match Report</legend>
        <div class="span10">
        <p id="count" class="text-info">0 / 600</p>
        <textarea id="matchReport" cols="10" rows="10"></textarea>
        </div>
    </fieldset>
    
   <button type="submit" id="save" class="btn btn-primary"><i class="icon-white icon-ok"></i> Save</button> 

    