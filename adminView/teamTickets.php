<div class='contentbox span9'>
	<div class='page-header'>
		<h1>Authorise Team Tickets</h1>
	</div>
		<?php 
			if(isset($error))
			{
				print("<div class='alert alert-error'>".$error."</div>");
			}
			
			if(isset($ticketsAllocated))
			{
				print("<div class='alert alert-success'>Tickets have been allocated</div>");
			}
		?>
		<form class='form-inline' method='post' action='index.php?adminPage=teamTickets' style='text-align:center'>
			<label>Select which Team you wish to allocate Tickets to</label>
			<select name='team' action='post' action=''>
			<?php
				if(isset($teams))
				{
					for($i = 0;$i < count($teams);$i++)
					{
					?>
						<option value='<?php echo $teams[$i]->getTeamId(); ?>'><?php echo $teams[$i]->getTeamName(); ?></option>
					<?php
					}
				}
			?>
			</select>
			<br />
			<br />
			<input type='hidden' name='teamTickets' value='1' />
			<button type="submit" class="btn btn-success"><i class="icon-white icon-tags"></i> Allocate Tickets</button>
		</form>

</div>