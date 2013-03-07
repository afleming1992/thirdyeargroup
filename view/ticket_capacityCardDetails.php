<div class='contentbox'>
<div class='page-header'>
	<h1>Capacity Reached for <?php echo date("d-M-Y",strtotime($_POST['ticketDate'])) ?></h1>
</div>
<div class='alert alert-error' style='text-align:center'>
	<h3>Sorry!</h3>
	<b>Your Ticket Purchase will take us over-capacity!</b>
	<p>Please edit your order or select another date</p>
	<button class='btn btn-large btn-warning' onClick="history.go(-1);return true;" href='#'><i class='icon-calendar icon-white'></i> <b>Edit Order</b></button>
	<a class='btn btn-large btn-info' href='?page=tickets'><i class='icon-calendar icon-white'></i> <b>Re-Select Date</b></a>
</div>
</div>
