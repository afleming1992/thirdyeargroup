<div class='contentbox'>
	<h1>Purchase Ticket for <?php echo date('d-M-Y',strtotime($_GET['date'])); ?></h1>
<legend>Please complete this form to book your Ticket!</legend>
<b>Let's Confirm how many Tickets you want</b>
<form name='ticketPurchase' id='ticketPurchase' method='post' action='?page=ticketCardDetails' onsubmit='return validateForm();' >
	<p id='errorticketnumber' class="text-error"></p>
    <label for='adult'>Adult Tickets (Cost = £<?php echo $adult_price ?>)</label>
			<select id='adult' name='adult' class='span1'>
			<?php
					for($i = 0;$i < 11;$i++)
					{
						print("<option value='".$i."'>".$i."</option>");
					}
			?>
			</select>
    <label for='concession'>Concession Tickets (Cost = £<?php echo $concession_price ?>)</label>
		<select id='concession' name='concession' class='span1'>
		<?php
				for($i = 0;$i < 11;$i++)
				{
					print("<option value='".$i."'>".$i."</option>");
				}
		?>
		</select><br />
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
    <label>First Name</label>
    <input type="text" name='firstname' id='firstname' placeholder="Type something…">
    <label>Surname</label>
    <input type="text" name='surname' id='surname' placeholder="Type something…" >
    <label>Email</label>
    <input type="email" name='email' id='email' placeholder="Type something…">
    <label>Address Line 1</label>
    <input type="text" name="address1" id='address1' placeholder="Type something..." >
    <label>Address Line 2</label>
    <input type="text" name="address2" id='address2' placeholder="Type something...">
    <label>City</label>
    <input type="text" name="city" id='city' placeholder="Type something..." >
    <label>County</label>
    <input type="text" name="county" id='county' placeholder="Type something...">
    <label>Postcode</label>
    <p id='errorpostcode' class="text-error"></p>
    <input type="text" name="postcode" id='postcode' placeholder="Type something..." >
	<input type='hidden' name='ticketDate' value='<?php echo $_GET['date'] ?>'><br />
	<input type='hidden' name='continunity' value='1' >
    <center><input type="submit" class="btn btn-success btn-large"></button></center>
  </fieldset>
</form>
<script src="javascript/ticketingForms.js"></script>
</div>

