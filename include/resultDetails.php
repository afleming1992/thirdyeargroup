<div id="<?php echo "resultID".$m->getResultID(); ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel"><?php echo $m->getTeam1()->getTeamName()." VS ".$m->getTeam2()->getTeamName(); ?></h3>
    </div>
    <div class="modal-body">               
       
    </div>
     <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>    
</div>
