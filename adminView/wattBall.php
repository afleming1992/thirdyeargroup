<div class='span9 contentbox'>
    <script src="javascript/wattBall.js"></script>
    <div id="divTeam">
        <?php include_once 'include/adminWattBall.php'; ?>
    </div>
    
                    
    <div id="deleteTeam" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Are you sure you want to delete this Team ?</h3>
        </div>
    <div class="modal-body center">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button type='button' id='buttonDeleteTeam' class="btn btn-danger btn-medium"><i class="icon-white icon-remove-sign"></i> Delete</button>
    </div>
    </div>
    
</div>
</div>
