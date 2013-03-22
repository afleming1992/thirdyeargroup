<div class='span9 contentbox'>
<a href='index.php?adminPage=bookingList'><i class='icon-arrow-left'></i> Back to Results List</a>
	<div class='page-header'>
		<h1>View Booking Details for ID <?php echo $booking->getBookingId(); ?></h1>
	</div>
		<h3>Contact Details for Customer</h3>
		<table class='table table-bordered'>
			<tr><th>Surname</th><td><?php echo $booking->getSurname(); ?></td></tr>
			<tr><th>First Name</th><td><?php echo $booking->getFirstName(); ?></td></tr>
			<tr><th>Address</th><td><address><?php echo $booking->getAddress1(); ?><br /><?php echo $booking->getAddress2(); ?><br /><?php echo $booking->getCity(); ?><br /><?php echo $booking->getCounty(); ?><br /><?php echo $booking->getPostcode(); ?></td></tr>
			<tr><th>Email</th><td><a href='mailto:<?php echo $booking->getEmail(); ?>'><i class='icon-envelope'></i> <?php echo $booking->getEmail(); ?></a></td></tr>
		</table>
		<br />
		<table class='table table-bordered'>
		<tr><th>Transaction Total</th><td>&pound;<?php echo number_format($booking->getTotalCost(), 2, '.', '') ?></td></tr>
		</table>
		<h3>Tickets Associated with this Booking</h3>
		<div style='text-align:center'>
			Number of Adult Tickets :- <span class='badge badge-info'><?php echo $adultTickets; ?></span><br />
			Number of Concession Tickets :- <span class='badge badge-info'><?php echo $concessionTickets; ?></span><br />
		</div>
		<table class='table'>
		<tr><th>#</th><th>Date</th><th>Type</th><th>Method of Collection</th><th>Status</th><th style='text-align:center'><a class='btn btn-primary' href='index.php?adminPage=viewBooking&id=<?php echo $_GET['id'] ?>&collect=all'><i class='icon-white icon-tags'></i> Collect All Tickets</a></th></tr>
		<?php
			for($i = 0;$i < count($tickets);$i++)
			{
				if(strcmp($tickets[$i]->getMethodOfSale(),"pickup") == 0)
				{
					if(strcmp($tickets[$i]->getStatus(),"COLLECTED") == 0)
					{
						$rowclass = 'error';
					}
					else
					{
						$rowclass = 'success';
					}
				}
				else
				{
					if(strcmp($tickets[$i]->getStatus(),"POSTED") == 0)
					{
						$rowclass = 'error';
					}
					else
					{
						$rowclass = 'success';
					}
				}
				?>
				<tr class='<?php echo $rowclass ?>'>
					<td><?php echo $tickets[$i]->getTicketId(); ?></td>
					<td><?php echo date('d-M-Y',strtotime($tickets[$i]->getDate())); ?></td>
					<td><?php echo $tickets[$i]->getType(); ?></td>
					<td><?php echo $tickets[$i]->getMethodOfSale(); ?></td>
					<td><?php echo $tickets[$i]->getStatus(); ?></td>
					<td style='text-align:center'>
						<?php 
							if($rowclass == 'success')
							{ 
						?>
							<a class='btn btn-success' href='index.php?adminPage=viewBooking&id=<?php echo $_GET['id'] ?>&collect=<?php echo $tickets[$i]->getTicketId() ?>'>
								<i class='icon-white icon-tag'></i> Collect
							</a>
						<?php 
							} 
						?>
					</td>
				</tr>
				<?php
			}
		?>
		</table>
</div>