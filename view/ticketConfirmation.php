<div class='contentbox'>
	<div class='page-header'>
		<h1>Ticket Confirmation</h1>
	</div>
	<div class='alert alert-success'>
		<b>Thats your tickets booked!</b>
		Thank you for booking your tickets for the Riccarton Sports Centre!
	</div>
	<div class="well well-large">
	  <table class='table table-bordered'>
		<tr><th>Your Name</th><td><?php echo $_POST['firstname']." ".$_POST['surname'] ?></td></tr>
		<tr><th>Your Email</th><td><?php echo $_POST['email'] ?></td></tr>
		<tr><th>Your Address</th><td><address><?php echo $_POST['address1'] ?><br /><?php if(strlen($_POST['address2']) > 0){ echo $POST['address2'];print("<br />");} echo $_POST['city'] ?><br /><?php echo $_POST['county'] ?><br /><?php echo $_POST['postcode'] ?></address></td></tr>
		<tr><th>You have booked:-</th><td><?php if($_POST['adult'] > 0){echo $_POST['adult'];print(" Adult Ticket(s)<br />");} if($_POST['concession'] > 0){echo $_POST['concession'];print(" Concession Ticket(s)<br />");} ?></td></tr>
		<tr><th>For Entry on:-</th><td><?php echo date('d-M-Y',strtotime($_POST['ticketDate'])); ?></td></tr>
		<tr><th>Which will cost you</th><td>&#163;<?php echo number_format($transactionCost, 2, '.', '') ?></td></tr>
		<tr><th colspan='2' style='text-align:center'>
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
			<p>You have also been emailed concerning your booking! Thank you and we look forward to welcoming you!
		</th></tr>
	  </table>
	</div>
</div>