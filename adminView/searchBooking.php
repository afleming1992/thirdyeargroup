<div class='span9 contentbox'>
	<div class='page-header'>
		<h1>Search Bookings</h1>
	</div>
	<form class="form-horizontal" name='search' method='post' action='index.php?adminPage=bookingList'>
		<div class='control-group'>
			<label class='control-label' for='searchby'>Search by Using</label>
			<div class='controls'>
				<select name='searchby'>
					<option value=''>-Select all-</option>
					<option value='surname'>Surname</option>
					<option value='bookingId'>Booking ID</option>
					<option value='postcode'>Postcode</option>
				</select>
			</div>
		</div>
		<div class='control-group'>
			<label class='control-label' for='restrictions'>Show only</label>
			<div class='controls'>
				<select name='restrictions'></p>
					<option value=''>-Select All-</option>
					<option value='postal'>Postal Bookings Only</option>
					<option value='pickup'>Collection Bookings Only</option>
				</select>
			</div>
		</div>
		<div class='control-group'>
			<label class='control-label' for='date'>Bookings for:</label>
			<div class='controls'>
				<select name='date'>
					<option value=''>-Select All-</option>
					<?php
							for($i = 0;$i < count($days);$i++)
							{
									print("<option value='".$days[$i]."'>".date("D jS F Y", strtotime($days[$i])));
							}	
					?>
				</select>
			</div>
		</div>
		<div class='control-grou'>
			<div class='controls'>
				<label class='checkbox'><input type="checkbox" name='uncollectedOnly' value='1'>Show Bookings not Dispatched/Collected</label>
				
			</div>
		</div>
		<div class='control-group' id='freesearch'>
			<label class='control-label' for='searchinput'>Search Parameters</label>
			<div class='controls'>
				<input type='text' name='searchinput' class='input-medium' placeholder="Text Search">
				<br />
				<br />
				<input type='hidden' name='search' value='1' />
				<button type='submit' class='btn btn-primary btn-large'><i class='icon-search icon-white'></i> Search</button>
			</div>
		</div>
	</form>
</div>