<div class='span9 contentbox'>
	<div class='page-header'>
		<h1>Ticket Status</h1>
	</div>
	<br />
	
	<div class='row-fluid'>
	<?php
		print("<div class='alert alert-info' style='text-align:center'>Current Tournament = ".$tournamentName."</div>");
		$row = 0;
		for($i = 0;$i < count($days);$i++)
		{
			$result = $this->db->query("SELECT count(ticketID) AS total FROM ticket WHERE dateOfTicket = '".$days[$i]."'");
			if($result != false)
			{
				$data = $result->fetch();
			}
			
			if($row >= 4)
			{
				print("</div><br /><br /><div class='row-fluid'>");
				$row = 0;
			}
			?>
			<a href='?adminPage=ticketStatus&date=<?php echo $days[$i] ?>'>
				<div class='span3 datebox'>
					<center>
					<?php
						echo date("D jS F Y", strtotime($days[$i]));
					?>
					</center>
				</div>
			</a>
		<?php
		}
		?>
		</div>
		<?php
		if(isset($_GET['date']))
		{
			?>
				<br />
				<table class='table table-bordered'>
					<tr class='success'><td colspan='2' style='text-align:center;'><h1><?php echo date("D jS F Y", strtotime($_GET['date'])); ?></h1></td></tr>
					<tr class="error"><td colspan='2'></td></tr>
					<tr><th>Total Tickets Sold/Given</th><td><?php echo $adult + $concession + $complimentary; ?></td></tr>
					<tr><th>Adults Ticket Sold</th><td><?php echo $adult; ?></td></tr>
					<tr><th>Concession Ticket Sold</th><td><?php echo $concession; ?></td></tr>
					<tr><th>Total Compilmentary Tickets</th><td><?php echo $complimentary; ?></td></tr>
					<tr><th>Tickets Remaining</th><td><?php echo $capacity - ($adult + $concession + $complimentary); ?></td></tr>
					<tr class="error"><td colspan='2'></td></tr>
					<tr><th>Tickets to be Collected</th><td><?php echo $pickup; ?></td></tr>
					<tr><th>Tickets to be Posted</th><td><?php echo $postal; ?></td></tr>
					<tr class="error"><td colspan='2'></td></tr>
					<tr><th>Total Takings for this Date</th><td>£<?php echo number_format($totalTakings, 2, '.', '') ?></td></tr>
				</table>
			<?php
		}
	?>
	
</div>
