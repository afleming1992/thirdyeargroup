<div class='span9 contentbox'>
    <script src="javascript/changeTeamPlayers.js"></script>
    <h3><?php echo htmlspecialchars($_GET['teamName']); ?></h3>
    <div id="players">
        <?php
            include_once 'include/changeTeamPlayers.php';
        ?>
    </div>
    <input id="teamId" type="hidden" value="<?php echo htmlspecialchars($_GET['changeTeamPlayers']);  ?>"/>
    <button id="addPlayers" class="btn btn-primary"><i class="icon-search icon-plus"></i> Add A Player</button>
    
    <!-- Add players form -->
    <div id="divAddPlayer" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Add A New Player</h3>
        </div>
    <div class="modal-body center">
        <div id="divError">
        <input type="text" placeholder="Player Name…" name='playerName' id='playerName'/></br>
        <span id="error" class="help-inline"></span>
        </div>
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>        
        <button type='button' id='buttonAddPlayer' name="buttonAddPlayer" class="btn btn-info btn-medium"><i class="icon-white icon-plus-sign"></i> Add</button>
    </div>
    </div>
    
    <!-- change players form -->
    <div id="divAddPlayerChange" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Change Player Name</h3>
        </div>
    <div class="modal-body center">
        <div id="divError">
        <input type="text" placeholder="Player Name…" name='playerName' id='playerNameChange'/></br>
        <span id="error" class="help-inline"></span>
        </div>
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>        
        <button type='button' id='buttonAddPlayerChange' name="buttonAddPlayer" class="btn btn-info btn-medium"><i class="icon-white icon-ok-sign"></i> Save</button>
    </div>
    </div>
    
   
    <!-- Delete players form -->
    <div id="deletePlayer" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Are you sure you want to delete this Player ?</h3>
        </div>
    <div class="modal-body center">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button type='button' id='buttonDeletePlayer' class="btn btn-danger btn-medium"><i class="icon-white icon-remove-sign"></i> Delete</button>
    </div>
    </div>
    
    <!-- Delete players fail -->
    <div id="deletePlayerFail" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">You can't delete players</h3>
        </div>
    <div class="modal-body center">
        <p>A team must have at least 11 players</p>
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
    </div>
    
</div>
</div>
