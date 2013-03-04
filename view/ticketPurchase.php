<div class='contentbox'>
	<h1>Purchase Ticket for <?php echo date('d-M-Y',strtotime($_GET['date'])); ?></h1>
	<?php
		if($ticketTotal < 21)
		{
			print("<div class='alert alert-warning' style='text-align:center'><h3>LIMITED TICKETS REMAINING FOR THIS DAY!</h3><br /><b>Tickets Remaining for this day=".$ticketTotal."</b></div>");
		}
		else
		{
			print("<div class='alert alert-info' style='text-align:center'><b>Tickets Remaining for this Day = ".$ticketTotal."</b></div>");
		}
	?>
<legend>Please complete this form to book your Ticket!</legend>
<b>Let's Confirm how many Tickets you want</b>
<form name='ticketPurchase' id='ticketPurchase' method='post' action='?page=ticketCardDetails' onsubmit='return validateForm();' >
	<div id='ticketcontrol' class='control-group'>
    <label for='adult'>Adult Tickets (Cost = £<?php echo $adult_price ?>)</label>
		<div class='controls'>
			<select id='adult' name='adult' class='span1'>
			<?php
					for($i = 0;$i < 11;$i++)
					{
						print("<option value='".$i."'>".$i."</option>");
					}
			?>
			</select>
		</div>
		
		<label for='concession'>Concession Tickets (Cost = £<?php echo $concession_price ?>)</label>
		<div class='controls'>
			<select id='concession' name='concession' class='span1'>
			<?php
					for($i = 0;$i < 11;$i++)
					{
						print("<option value='".$i."'>".$i."</option>");
					}
			?>
			</select><br />
			<span class='help-inline' id='errorticketnumber' style='font-weight:bolder';></span>
		</div>
	</div>
	
	
		<legend>Collection of Tickets</legend>
	<p>How would you like to collect your Tickets?</p>
	<label class="radio">
	  <input type="radio" name="collection" value="pickup" checked>
	  Collected at the Centre on the Day!
	</label>
	<label class='radio'>
	<?php
		$date = strtotime($_GET['date']) - 432000;
		$today_date = date("Y-m-d");
		$today_date = strtotime($today_date);
		if($date > $today_date)
		{
	?>
		<input type="radio" name="collection" value="postal">
		  Posted out to your Address
		</label>
	<?php
		}	
	?>
	<legend>About you!</legend>
	
	<div id='firstnamecontrol' class='control-group'>
    <label class='control-label' for='firstname'>First Name</label>
		<div class='controls'>
			<input type="text" name='firstname' id='firstname' placeholder="Type something…"><span id='errorfirstname' class="help-inline text-error" style='font-weight:bolder'></span>
		</div>
    </div>
    
    <div id='surnamecontrol' class='control-group'>
    <label for='surname'>Surname</label>
		<div class='controls'>
			<input type="text" name='surname' id='surname' placeholder="Type something…" ><span id='errorsurname' class="help-inline text-error" style='font-weight:bolder'></span>
		</div>
	</div>
    
    <div id='emailcontrol' class='control-group'>
    <label>Email</label>
		<div class='controls'>
			<input type="email" name='email' id='email' placeholder="Type something…"><span id='erroremail' class="help-inline text-error" style='font-weight:bolder'></span>
		</div>
	</div>
	
	<div id='addresscontrol' class='control-group'>
		<label>Address Line 1</label>
		<div class='controls'>
			<input type="text" name="address1" id='address1' placeholder="Type something..." ><span id='erroraddress' class="help-inline text-error" style='font-weight:bolder'></span>
		</div>
		<label>Address Line 2</label>
		<div class='controls'>
			<input type="text" name="address2" id='address2' placeholder="Type something...">
		</div>
	</div>
    
    
    <div id='citycontrol' class='control-group'>
    <label>City</label>
		<div class='controls'>  
			<input type="text" name="city" id='city' placeholder="Type something..." ><span id='errorcity' class="help-inline text-error" style='font-weight:bolder'></span>
		</div>
    </div>
   
    <div id='countycontrol' class='control-group'>
		<label>County</label>
		<div class='controls'>
			<input type="text" name="county" id='county' placeholder="Type something..."><span id='errorcounty' class="help-inline text-error" style='font-weight:bolder'></span>
		</div>
	</div>
	
	<div id='postcodecontrol' class='control-group'>
		<label>Postcode</label>
		<div class='controls'>
			<input type="text" name="postcode" id='postcode' placeholder="Type something..." ><span id='errorpostcode' class="help-inline text-error" style='font-weight:bolder'></span>
		</div>
	</div>
		<input type='hidden' name='ticketDate' value='<?php echo $_GET['date'] ?>'><br />
		<input type='hidden' name='continunity' value='1' >
		
	<div id='formerror'></div>
    <center><input type="submit" class="btn btn-success btn-large"></button></center>
  </fieldset>
</form>
<script src="javascript/ticketingForm.js"></script>
</div>

