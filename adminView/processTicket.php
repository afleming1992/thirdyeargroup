<div class='span9 contentbox'>
	<div class='page-header'>
		<h1>Process Ticket Purchase</h1>
	</div>
	<form method='post' onSubmit='return validateForm();'>
		<table class='table table-bordered'>
			<tr><th>Date</th>
			<td>
				<select name='date'>
					<?php
						for($i = 0;$i < count($dates);$i++)
						{
							if($capacity[$i] != 0)
							{
								print("<option value='".$dates[$i]."'>".date("D jS F Y", strtotime($dates[$i]))." - ".$capacity[$i]." REMAINING</option>");
							}
						}
					?>
				</select>
			</td>
			</tr>
			
			<tr><th>Number of Adult Tickets</th>
			<td>
			<div id='ticketcontrol' class='control-group'>
				<div class='controls'>
					<select id='adult' name='adult' onChange='reCalculatePrice(<?php echo $adultPrice; ?>,<?php echo $concessionPrice; ?>);'>
						<?php
							for($i = 0;$i < 11;$i++)
							{
								print("<option value='".$i."'>".$i."</option>");
							}
						?>
					</select>
				</div>
			</div>
			</td></tr>
			
			<tr><th>Number of Concession Tickets</th>
			<td>
			<div id='ticketcontrol2' class='control-group'>
				<div class='controls'>
					<select id='concession' name='concession' onChange='reCalculatePrice(<?php echo $adultPrice; ?>,<?php echo $concessionPrice; ?>);'>
						<?php
							for($i = 0;$i < 11;$i++)
							{
								print("<option value='".$i."'>".$i."</option>");
							}
						?>
					</select>
					<span class='help-inline' id='errorticketnumber'></p>
				</div>
			</div>
			</td></tr>
			<tr class='error'><td colspan='2'></td></tr>
			<tr><th>This will cost:</th><td>&pound;<span id='price'>0.00</span></td></tr>
			<tr class='error'><td colspan='2'></td></tr>
			<input type='hidden' name='processTicket' value='1' />
			<tr><td colspan='2' style='text-align:center'><button class='btn btn-primary' type='submit'><i class='icon-white icon-shopping-cart'></i> Process Purchase</button></td></tr>
		</table>
		</form>
	<script src="javascript/processTicket.js"></script>
</div>