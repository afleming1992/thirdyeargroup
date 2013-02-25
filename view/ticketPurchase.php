<div class='contentbox'>
	<h1>Purchase Ticket for <?php echo date('d-M-Y',strtotime($_GET['date'])); ?></h1>
<legend>Please complete this form to book your Ticket!</legend>
<b>Let's Confirm how many Tickets you want</b>
<form method='post' action='?page=ticketCardDetails'>
    <label for='adult'>Adult Tickets</label>
			<select name='adult' class='span1'>
			<?php
					for($i = 1;$i < 11;$i++)
					{
						print("<option value='".$i."'>".$i."</option>");
					}
			?>
			</select>
    <label for='concession'>Concession Tickets</label>
		<select name='concession' class='span1'>
		<?php
				for($i = 1;$i < 11;$i++)
				{
					print("<option value='".$i."'>".$i."</option>");
				}
		?>
		</select><br />
	<p>How would you like to collect your Tickets?</p>
	<label class="radio">
	  <input type="radio" name="collection" value="pickup">
	  Collected at the Centre on the Day!
	</label>
	<label class='radio'>
	  <input type="radio" name="collection" value="postal">
	  Posted out to your Address
	</label>
	<legend>About you!</legend>
    <label>Full Name</label>
    <input type="text" name='name' placeholder="Type something…">
    <span class="help-block">Example block-level help text here.</span>
    <label>Email</label>
    <input type="email" name='email' placeholder="Type something…">
    <label>Address Line 1</label>
    <input type="text" name="address1" placeholder="Type something...">
    <label>Address Line 2</label>
    <input type="text" name="address2" placeholder="Type something...">
    <label>City</label>
    <input type="text" name="city" placeholder="Type something...">
    <label>County</label>
    <input type="text" name="county" placeholder="Type something...">
    <label>Postcode</label>
    <input type="text" name="postcode" placeholder="Type something...">
	<input type='hidden' name='ticketDate' value='<?php echo $_GET['date'] ?>' ?><br />
    <center><button type="submit" class="btn btn-success btn-large"><i class='icon-check icon-white'></i> Submit</button></center>
  </fieldset>
</form>
</div>
