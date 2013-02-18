<div class='span9 contentbox'>

	<script src="javascript/umpireManagement.js"> </script>    
	<div id="umpireList">
		<?php 
			$allUmpires = $this->umpire;
			include("include/allUmpires.php"); 
		?>	
	</div>

	<!-- Div add umpire  -->
		
	<div id="addUmpire" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
		<div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
   			 <h3 id="myModalLabel">Add an umpire</h3>
 		</div>
 		<div class="modal-body">
                    <div id="addUmpireName">
			<label for="umpireName">Name: </label>
			<input type="text" name="umpireName" id="umpireName"></br><span id="help-inline-umpireName" class="help-inline"></span></br>
                    </div>
                    <div id="addUmpireEmail">
			<label for="umpireEmail">Email: </label>
			<input type="text" id="umpireEmail" name="umpireEmail"></br><span id="help-inline-umpireEmail" class="help-inline"></span>
			</div>
			<fieldset>
				<h5><u>Availability</u></h5>
				
				<table class="table table-hover">
					<thead>
					<tr>
						<td></td>
						<th>Morning</th>
						<th>Afternoon</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td>Monday</td>
	                    <td><label class="checkbox"><input type="checkbox" id="slot0" /></label></td>
	                    <td><label class="checkbox"><input type="checkbox" id="slot1" /></label></td> 
                    </tr>
					<tr>
						<td>Tuesday</td>
	                    <td><label class="checkbox"><input type="checkbox" id="slot2" /></label></td> 
	                    <td><label class="checkbox"><input type="checkbox" id="slot3" /></label></td> 
                    </tr>
					<tr>
						<td>Wednesday</td>
	                    <td><label class="checkbox"><input type="checkbox" id="slot4" /></label></td> 
	                    <td><label class="checkbox"><input type="checkbox" id="slot5" /></label></td> 
                    </tr>
					<tr>
						<td>Thursday</td>
	                    <td><label class="checkbox"><input type="checkbox" id="slot6" /></label></td>
	                    <td><label class="checkbox"><input type="checkbox" id="slot7" /></label></td> 
                    </tr>
					<tr>
						<td>Friday</td>
	                    <td><label class="checkbox"><input type="checkbox" id="slot8" /></label></td> 
	                    <td><label class="checkbox"><input type="checkbox" id="slot9" /></label></td> 
                    </tr>
					<tr>
						<td>Saturday</td>
	                    <td><label class="checkbox"><input type="checkbox" id="slot10" /></label></td> 
	                    <td><label class="checkbox"><input type="checkbox" id="slot11" /></label></td>
                    </tr>
					<tr> 
						<td>Sunday</td>
	                    <td><label class="checkbox"><input type="checkbox" id="slot12" /></label></td>
	                    <td><label class="checkbox"><input type="checkbox" id="slot13" /></label></td> 
                    </tr>
                    </tbody>
                    <tfoot>
						<tr>
							<td></td>
							<td></td>
							<td><input type="checkbox" class="checkall"> Check all</input></td>
						</tr>
                    </tfoot>
				</table>
			</fieldset>                  
		</div>
		 <div class="modal-footer">
		    <button class="btn" id='addClose' data-dismiss="modal" aria-hidden="true">Close</button>
		    <button type='button' value='submit' aria-hidden="true" id='addUmpireValidation' class="btn btn-primary btn"><i class="icon-white icon-ok-sign"></i> Save</button>
  		</div>
	</div>
	
	<button type="button" data-toggle="modal" class="btn btn-primary btn-medium" data-target="#addUmpire"><i class="icon-plus-sign icon-white"></i> Add Umpire</button>


	<!-- Div edit umpire  -->
	
	<div id="editUmpire" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
		<div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
   			 <h3 id="myModalLabel">Edit an umpire</h3>
 		</div>
 		<div class="modal-body">
			<div id="editUmpireName">
			<label for="umpireNameChange">Name: </label>
			<input type="text" id="umpireNameChange" name="umpireNameChange"></br><span id="help-inline-umpireNameChange" class="help-inline"></span></br>
			</div>
			
			<div id="editUmpireEmail">
			<label for="umpireEmailChange">Email: </label>
			<input type="text" id="umpireEmailChange" name ="umpireEmailChange"></br><span id="help-inline-umpireEmailChange" class="help-inline"></span></br>
			</div>
			
			<fieldset>
				<h5><u>Availability</u></h5>
				
				<table class="table table-hover">
					<thead>
					<tr>
						<td></td>
						<th>Morning</th>
						<th>Afternoon</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td>Monday</td>
	                    <td><label class="checkbox"><input type="checkbox" id="slott0" /></label></td>
	                    <td><label class="checkbox"><input type="checkbox" id="slott1" /></label></td> 
                    </tr>
					<tr>
						<td>Tuesday</td>
	                    <td><label class="checkbox"><input type="checkbox" id="slott2" /></label></td> 
	                    <td><label class="checkbox"><input type="checkbox" id="slott3" /></label></td> 
                    </tr>
					<tr>
						<td>Wednesday</td>
	                    <td><label class="checkbox"><input type="checkbox" id="slott4" /></label></td> 
	                    <td><label class="checkbox"><input type="checkbox" id="slott5" /></label></td> 
                    </tr>
					<tr>
						<td>Thursday</td>
	                    <td><label class="checkbox"><input type="checkbox" id="slott6" /></label></td>
	                    <td><label class="checkbox"><input type="checkbox" id="slott7" /></label></td> 
                    </tr>
					<tr>
						<td>Friday</td>
	                    <td><label class="checkbox"><input type="checkbox" id="slott8" /></label></td> 
	                    <td><label class="checkbox"><input type="checkbox" id="slott9" /></label></td> 
                    </tr>
					<tr>
						<td>Saturday</td>
	                    <td><label class="checkbox"><input type="checkbox" id="slott10" /></label></td> 
	                    <td><label class="checkbox"><input type="checkbox" id="slott11" /></label></td>
                    </tr>
					<tr> 
						<td>Sunday</td>
	                    <td><label class="checkbox"><input type="checkbox" id="slott12" /></label></td>
	                    <td><label class="checkbox"><input type="checkbox" id="slott13" /></label></td> 
                    </tr>
                    </tbody>
                    <tfoot>
						<tr>
							<td></td>
							<td></td>
							<td><input type="checkbox" class="checkall"> Check all</input></td>
						</tr>
                    </tfoot>
				</table>
			</fieldset>                    	
		</div>
		<div class="modal-footer">
		    <button class="btn" id='editClose' data-dismiss="modal" aria-hidden="true">Close</button>
		    <button type='button' value='submit' id='editUmpireValidation' class="btn btn-primary btn-medium"><i class="icon-white icon-ok-sign"></i> Save</button>
  		</div>
	</div>
        
	<!-- Div delete umpire  -->
	
	<div id="deleteUmpire" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		 <h3 id="myModalLabel">Are you sure you want to delete this Umpire?</h3>
		</div>
		<div class="modal-body center">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	<button type='button' id='buttonDeleteUmpire' class="btn btn-danger btn-medium"><i class="icon-white icon-remove-sign"></i> Delete</button>
		</div>
	</div>
	
</div>
</div>
