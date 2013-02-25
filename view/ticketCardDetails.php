<div class='contentbox'>
	<h1>Purchase Ticket for <?php echo date('d-M-Y',strtotime($_POST['ticketDate'])); ?></h1>
<form method='post' action=''>
  <fieldset>
    <legend>Confirm your Card Details!</legend>
    <h2>Card Details</h2>
    <label>Card Number</label>
    <input type="text" name="cardNo" placeholder="Type something...">
    <label>Card Type</label>
	<select name='cardType'>
		<option value='visa'>Visa</option>
		<option value='mastercard'>Mastercard</option> 
		<option value='delta'>Delta</option>
		<option value='maestro'>Maestro</option>
		<option value='amex'>American Express</option>  
	</select>
    <label>CSC Security Code</label>
    <input type="text" name="csc" placeholder="Type something...">
    <label>Valid Until</label>
    <select name='month' class='span1'>
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
	<select name='year' class='span2'>
		<?php
			$currentyear = date("Y");
			for($i = 0;$i < 10;$i++)
			{
				print("<option value='".$currentyear."'>".$currentyear."</option>");
				$currentyear++;
			}
		?>
	</select><br />
	<input type='hidden' name='ticketDate' value='<?php echo $_GET['date'] ?>' ?>
    <button type="submit" class="btn btn-success btn-large"><i class='icon-check icon-white'></i> Submit</button>
  </fieldset>
</form>
</div>
