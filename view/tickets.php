<div class='contentbox'>
	<div class='page-header'>
		<h1>Tickets for Tournament</h1>
	</div>
	<p>The Riccarton Sports Centre operates a Day-Entry Ticket system which allows you to purchase a ticket which grants enterance for the whole day.</p>
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
			<a href='?page=ticketPurchase&date=<?php echo $days[$i] ?>'>
				<div class='span3 datebox'>
					<center>
					<?php
						echo date("D jS F Y", strtotime($days[$i]));
						$ticketsRemaining = $capacity - $data['total'];
						print("<br />Tickets Remaining :- ". $ticketsRemaining);
					?>
					</center>
				</div>
			</a>
			<?php
			$row++;
		}
	?>
	</div>
</div>
