<div class='span9 contentbox'>
<a href='index.php?adminPage=searchBooking'><i class='icon-arrow-left'></i> Go Back</a>
	<div class='page-header'>
		<h1>Search Bookings</h1>
	</div>
	<table class='table'>
		<tr><th>Booking ID</th><th>Surname</th><th>First Name</th><th>Postcode</th><th>Actions</th>
		<?php
			for($i = 0;$i < count($bookings);$i++)
			{
				?>
					<tr><td><?php echo $bookings[$i]->getBookingId(); ?></td><td><?php echo $bookings[$i]->getSurname(); ?></td><td><?php echo $bookings[$i]->getFirstName(); ?></td><td><?php echo $bookings[$i]->getPostcode(); ?></td><td><a class='btn btn-primary' href='index.php?adminPage=viewBooking&id=<?php echo $bookings[$i]->getBookingId(); ?>'>View</a></td></tr>
				<?php
			}
		?>
	</table>
</div>