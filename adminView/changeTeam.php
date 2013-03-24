<div class='span9 contentbox'>
    <?php
    var_dump($_SESSION);
    if(isset($_SESSION['error']))
    {
        ?>
            <div class='alert alert-error'>
                    <b>Oh Dear!</b> An Error has occured in Validation, Please check where there is errors and try again!
            </div>
        <?php
        unset($_SESSION['error']);
        var_dump($_SESSION);
    }
    
?>
    <script src="javascript/wattballRegistration.js"> </script> 
    <a href="index.php?adminPage=wattBall"><i class="icon-arrow-left"></i> Back to the Teams</a></br></br>
    <div id='form'>
        <h3>Change Team Details</h3>
        <form class="form-horizontal" method='post' name='wattball_registration' action='index.php'>
            <fieldset>
                <legend>Basic Details</legend>
                <div id="teamNameDiv" <?php if(isset($_SESSION['teamNameError']) || isset($_SESSION['teamNameAlreadyUsed'])) echo "class='control-group error'"; ?> >
                    <label class='control-label'>Team Name</label>
                    <div class="controls">
                            <input type="text" placeholder="Type something…" name='changeteamName' id='teamName' <?php echo "value='".$team->getTeamName()."'"; if(isset($_SESSION['error']) || isset($_SESSION['teamNameAlreadyUsed'])) echo "value='$teamName'"; ?>>
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
                            <input type="text" placeholder="Type something…" name='changenwaNumber' id='nwaNumber' <?php echo "value='".$team->getNWANumber()."'"; if(isset($_SESSION['error'])) echo "value='$NWANumber'"; ?> >
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
                            <input type="text" placeholder="Type something…" name='changecontactName' id='contactName' <?php echo "value='".$team->getContactName()."'"; if(isset($_SESSION['error'])) echo "value='$contactName'"; ?>>
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
                            <input type="text" placeholder="Type something…" name='changecontactNumber' id='contactNumber' <?php echo "value='".$team->getContactNumber()."'"; if(isset($_SESSION['error'])) echo "value='$contactNumber'"; ?> >
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
                            <input type="email" placeholder="Type something…" name='changeemail' id='email' <?php echo "value='".$team->getEmail()."'"; if(isset($_SESSION['error'])) echo "value='$email'"; ?> >
                            <?php
                            if(isset($_SESSION['EmailError']))
                                echo "<span class='help-inline'>Contact Email adress must be a valid Email !</span>";                           
                            else
                                echo "<span class='help-inline'>Enter a Valid Email we can use to contact you</span>";
                            ?>
                    </div>
                </div>    
            </fieldset>
            <input id="hidden" type="hidden" name="teamID" value="<?php echo htmlspecialchars($_GET['changeTeam']); ?>"/>
            <button type="submit" class="btn btn-success"><i class="icon-white icon-ok"></i>Save Change</button>
        </form>        
    </div>
</div>
</div>
<?php 
unset($_SESSION['teamNameError']);
unset($_SESSION['nwaValidationError']);
unset($_SESSION['contactNameError']);
unset($_SESSION['contactNumberError']);
unset($_SESSION['EmailError']);


?>
