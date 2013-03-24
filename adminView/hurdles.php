<div class='span9 contentbox'>

	<script src="javascript/hurdles.js"> </script>   
	<div id="HurdlerList">
		<?php 
			$allHurdlers = $this->allHurdlers;
			$gender = $this->gender;
			include("include/allHurdles.php");
		
		?>	
	</div>
	
	<!-- Div Contact Details  -->
	
	<div id="contactDetails" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
		<div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
   			 <h3 id="myModalLabel"></h3>
 		</div>
 		<div class="modal-body">
				<table class="table table-bordered" id="myTable">
					<tr>
						<td>Email</td>
						<td id='email'> </td>
					</tr>
					<tr>
						<td>Emergency Contact Number</td>
						<td id='number'> </td>
					</tr>
					<tr>
						<td>Address</td>
						<td id='address'></td>
					</tr>
					<tr>
						<td>City</td>
						<td id='city'> </td>
					</tr>
					<tr>
						<td>Postcode</td>
						<td id='postcode'></td>
					</tr>
				</table>                 
		</div>
		<div class="modal-footer">
			<button class="btn" id='close' data-dismiss="modal" aria-hidden="true">Close</button>
		</div>
	</div>
	
</div>
</div>
