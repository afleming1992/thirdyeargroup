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
			if($row >= 4)
			{
				print("</div><br /><br /><div class='row-fluid'>");
				$row = 0;
			}
			?>
			<a href=''>
				<div class='span3 datebox'>
					<center>
					<?php
						echo date("D jS F Y", strtotime($days[$i]));
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
