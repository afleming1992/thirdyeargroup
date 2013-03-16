<div class='span9 contentbox'>
<?php
    if(isset($_SESSION['error']))
    {
        ?>
            <div class='alert alert-error'>
                    <b>Oh Dear!</b> An Error has occured in Validation, Please check where there is errors and try again!
            </div>
        <?php
    }
    
?>
<h3>Registration for the Men's Hurdles</h3>
<form method='post' name='menHurdlesRegistration' action='index.php'>
	<fieldset>
          <legend>Tournament Selection</legend>
                <label class='control-label'>Choose which Tournament to Register to: </label>
                <div class="controls">
                        <select name="tournamentId" id='tournamentId'>
                                <?php

                                        if(isset($tournament))
                                        {
                                                for($i = 0;$i<count($tournament);$i++)
                                                {
                                                   echo "<option value='".$tournament[$i]['tournamentID']."'>".$tournament[$i]['name']." - FROM ".$tournament[$i]['startDate']." TO ".$tournament[$i]['endDate']."</option>"; 
                                                }
                                        }
                                ?>
                        </select>
                </div>
    </fieldset>
</form>
</div>
