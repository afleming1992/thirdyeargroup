<div class='contentbox'>
	<div class='page-header'>
	<h1>Purchase Ticket for <?php echo date('d-M-Y',strtotime($_POST['ticketDate'])); ?></h1>
	</div>
	<h3>Summary of your Booking</h3>
	<div class="well well-large">
	  <table class='table table-bordered'>
		<tr><th>Your Name</th><td><?php echo $_POST['firstname']." ".$_POST['surname'] ?></td></tr>
		<tr><th>Your Email</th><td><?php echo $_POST['email'] ?></td></tr>
		<tr><th>Your Address</th><td><address><?php echo $_POST['address1'] ?><br /><?php if(strlen($_POST['address2']) > 0){ echo $POST['address2'];print("<br />");} echo $_POST['city'] ?><br /><?php echo $_POST['county'] ?><br /><?php echo $_POST['postcode'] ?></address></td></tr>
		<tr><th>You would like:-</th><td><?php if($_POST['adult'] > 0){echo $_POST['adult'];print(" Adult Ticket(s)<br />");} if($_POST['concession'] > 0){echo $_POST['concession'];print(" Concession Ticket(s)<br />");} ?></td></tr>
		<tr><th>For Entry on:-</th><td><?php echo date('d-M-Y',strtotime($_POST['ticketDate'])); ?></td></tr>
		<tr><th>Which will cost you</th><td>£<?php echo number_format($transactionCost, 2, '.', '') ?></td></tr>
		<tr><th colspan='2'>
		<?php
			if(strcmp($_POST['collection'],"postal") == 0)
			{
				print("<b>Your Ticket will be posted out to the Address listed above around 5 Days before the Ticket Date</b>");
			}
			else
			{
				print("<b>Your Ticket will be available for collection from the Riccarton Sports Centre Reception on the Day!</b>");
			}
		?>
		</th></tr>
	  </table>
	</div>
	<b>Happy with this? Then enter your Card Details in order to pay!</b>
<form method='post' onsubmit="return validateForm();" action='?page=ticketingConfirmation'>
  <fieldset>
    <legend>Confirm your Card Details!</legend>
    <div id='nameOnCardControl' class='control-group'>
		<label>Name on Card</label>
		<div class='controls'>
		<input type='text' id='nameOnCard' name='nameOnCard' placeholder="Type something..." />
		<span id='errorNameOnCard' class='help-inline'></span>
		</div>
    </div>
     <label>Card Type</label>
		<select id='cardType' name='cardType'>
			<option value='visa'>Visa</option>
			<option value='mastercard'>Mastercard</option> 
			<option value='delta'>Delta</option>
			<option value='maestro'>Maestro</option>
			<option value='amex'>American Express</option>  
		</select>
	<div id='cardNumberControl' class='control-group'>
		<label>Card Number</label>
		<div class='controls'>
		<input type="text" id='cardNo' name="cardNo" placeholder="Type something...">
		<span id='errorCardNumber' class='help-inline'></span>
		</div>
	</div>
	<div id='cscControl' class='control-group'>
		<label>CSC Security Code</label>
		<div class='controls'>
			<input type="text" name="csc" id='csc' placeholder="Type something...">
			<span id='errorCSC' class='help-inline'></span>
		</div>
	</div>
	<div id='validityControl' class='control-group'>
		<label>Valid Until</label>
		<div class='controls'>
				<select name='month'id='month' class='span1'>
				<option value='1'>1</option>
				<option value='2'>2</option> 
				<option value='3'>3</option>
				<option value='4'>4</option>
				<option value='5'>5</option>
				<option value='6'>6</option>
				<option value='7'>7</option> 
				<option value='8'>8</option>
				<option value='9'>9</option>
				<option value='10'>10</option>
				<option value='11'>11</option>
				<option value='12'>12</option>
			</select>
			<select name='year' id='year' class='span2'>
				<?php
					$currentyear = date("Y");
					for($i = 0;$i < 10;$i++)
					{
						print("<option value='".$currentyear."'>".$currentyear."</option>");
						$currentyear++;
					}
				?>
			</select>
			<span id="errorValidity" class='help-inline'></span>
		</div>
	</div>
	<input type='hidden' name='ticketDate' value='<?php echo $_POST['ticketDate'] ?>' >
	<input type='hidden' name='firstname' value='<?php echo $_POST['firstname'] ?>'>
	<input type='hidden' name='surname' value='<?php echo $_POST['surname'] ?>'>
	<input type='hidden' name='email' value='<?php echo $_POST['email'] ?>'>
	<input type='hidden' name='address1' value='<?php echo $_POST['address1'] ?>'>
	<input type='hidden' name='address2' value='<?php echo $_POST['address2'] ?>'>
	<input type='hidden' name='city' value='<?php echo $_POST['city'] ?>'>
	<input type='hidden' name='county' value='<?php echo $_POST['county'] ?>'>
	<input type='hidden' name='postcode' value='<?php echo $_POST['postcode'] ?>'>
	<input type='hidden' name='collection' value='<?php echo $_POST['collection'] ?>'>
	<input type='hidden' name='adult' value='<?php echo $_POST['adult'] ?>'>
	<input type='hidden' name='concession' value='<?php echo $_POST['concession'] ?>'>
    <button type="submit" class="btn btn-success btn-large"><i class='icon-check icon-white'></i> Confirm and Pay</button>
  </fieldset>
  <script src='javascript/ticketCardForm.js'></script>
</form>
</div>
