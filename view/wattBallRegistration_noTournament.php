<div class='span9 contentbox'>
    <div class="alert alert-block">
        <h4>You can't Register</h4>
        <?php
        if($numberOfRows < 1){
            ?>
         <span>There are no Tournament to Register to at the present time. Please try again later</span><br /><br />    
            <?php
        }
        
        if($numberOfRows2 > 0){
             ?>
         <span>Tournament is started.</span><br /><br />    
            <?php
        }
        ?>
   
</div>
</div>
