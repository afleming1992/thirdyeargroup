<div class='contentbox'>
<div class='page-header'>
	<h1>Capacity Reached for <?php echo date("d-M-Y",strtotime($_GET['date'])) ?></h1>
</div>
<div class='alert alert-error' style='text-align:center'>
	<h3>Sorry!</h3>
	<b>Capacity has been reached for this date!</b>
	<p>Please select another date by clicking the Button below</p>
	<a class='btn btn-large btn-info' href='?page=tickets'><i class='icon-calendar icon-white'></i> <b>Re-Select Date</b></a>
</div>
</div>
