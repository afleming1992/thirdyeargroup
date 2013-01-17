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
    <script src="javascript/wattballRegistration.js"> </script> 
    <div id='form'>
        <h3>Register for Wattball Tournament</h3>
        <form class="form-horizontal" method='post' name='wattball_registration' action='index.php'>
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
            <fieldset>
                <legend>Basic Details</legend>
                <div id="teamNameDiv" <?php if(isset($_SESSION['teamNameError']) || isset($_SESSION['teamNameAlreadyUsed'])) echo "class='control-group error'"; ?> >
                    <label class='control-label'>Team Name</label>
                    <div class="controls">
                            <input type="text" placeholder="Type something…" name='teamName' id='teamName' <?php if(isset($_SESSION['error']) || isset($_SESSION['teamNameAlreadyUsed'])) echo "value='$teamName'"; ?>>
                            <?php
                            if(isset($_SESSION['teamNameAlreadyUsed']))
                                echo "<span class='help-inline'>This name is already used by another team !</span>";
                            else if(isset($_SESSION['teamNameError']))
                                echo "<span class='help-inline'>You must give a name to your team !</span>";
                            else
                                echo "<span class='help-inline'>This is the Name of the Team that you represent</span>";
                            ?>
                            
                    </div>
                </div>
                
                <div id="nwaNumberDiv" <?php if(isset($_SESSION['nwaValidationError'])) echo "class='control-group error'"; ?> >
                    <label class='control-label'>NWA Number</label>
                    <div class="controls">
                            <input type="text" placeholder="Type something…" name='nwaNumber' id='nwaNumber' <?php if(isset($_SESSION['error'])) echo "value='$NWANumber'"; ?> >
                            <?php
                            if(isset($_SESSION['nwaValidationError']))
                                echo "<span class='help-inline'>NWA Number must contains 6 digits and one letter at the end (Exemple: 111111A)!</span>";                           
                            else
                                echo "<span class='help-inline'>You must be a Member of the NWA in order to register</span>";
                            ?>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>Contact Details</legend>
                
                <div id="contactNameDiv" <?php if(isset($_SESSION['contactNameError'])) echo "class='control-group error'"; ?> >
                    <label class='control-label'>Contact Name</label>
                    <div class="controls">
                            <input type="text" placeholder="Type something…" name='contactName' id='contactName' <?php if(isset($_SESSION['error'])) echo "value='$contactName'"; ?>>
                            <?php
                            if(isset($_SESSION['contactName']))
                                echo "<span class='help-inline'>You must give a contact name !</span>";                           
                            else
                                echo "<span class='help-inline'>Should any problems occur, name someone to be your contact</span>";
                            ?>
                    </div>
                </div>
                
                <div id="contactNumberDiv" <?php if(isset($_SESSION['contactNumberError'])) echo "class='control-group error'"; ?> >
                    <label class='control-label'>Contact Number</label>
                    <div class="controls">
                            <input type="text" placeholder="Type something…" name='contactNumber' id='contactNumber' <?php if(isset($_SESSION['error'])) echo "value='$contactNumber'"; ?> >
                            <?php
                            if(isset($_SESSION['contactName']))
                                echo "<span class='help-inline'>Contact number must be a valid phone number (11 digits including area code) !</span>";                           
                            else
                                echo "<span class='help-inline'>Please Enter Full Number including Area code (11 Digits)</span>";
                            ?>
                    </div>
                </div>
                
                <div id="emailDiv" <?php if(isset($_SESSION['EmailError'])) echo "class='control-group error'"; ?> >
                    <label class='control-label'>Contact Email</label>
                    <div class="controls">
                            <input type="email" placeholder="Type something…" name='email' id='email' <?php if(isset($_SESSION['error'])) echo "value='$email'"; ?> >
                            <?php
                            if(isset($_SESSION['EmailError']))
                                echo "<span class='help-inline'>Contact Email adress must be a valid Email !</span>";                           
                            else
                                echo "<span class='help-inline'>Enter a Valid Email we can use to contact you</span>";
                            ?>
                    </div>
                </div>    
            </fieldset>
            <fieldset>
                <legend>Players</legend>
                <div id="playersDiv" <?php if(isset($_SESSION['NotEnoughPlayers'])) echo "class='control-group error'"; ?> >
                    <label class='control-label'>Enter the Names of Each Player of your Team. One per Line!</label>
                    <div class="controls">
                        <textarea rows='11' name='players' id='players'><?php if(isset($_SESSION['error'])) echo $players; ?></textarea>
                        <?php
                        if(isset($_SESSION['NotEnoughPlayers']))
                            echo "<span class='help-inline'>You must have a team of at least 11 Players, one per line !</span>";                           
                        else
                            echo "<span class='help-inline'>You must have a team of at least 11 Players</span>";
                        ?>
                    </div>
                </div>
            </fieldset>
            <button type="submit" class="btn btn-success"><i class="icon-white icon-ok"></i> Submit Registration</button>
        </form>        
    </div>
</div>
