<?php
//Function which display the login form if user try to go to the staff page without sign in
function addLogin()
{
    require_once 'view/login.php';
    ?>
    <div class="alert alert-block" style="text-align: center">
      <h4>Warning!</h4>
      You must be logged in to view this page ! </br></br>
      <a role='button' class='btn btn-warning' href='#login' data-toggle='modal'>Staff Login</a>
    </div>
    <?php
    require_once 'view/footer.php';
}

if(!isset($_SESSION['login']))
{
    addLogin();
    die();
}
else if(isset($_SESSION['login']) && $_SESSION['login']==FALSE)
{
    addLogin();
    die();
}
?>

<div class='row-fluid'>
	<div class='span3 contentbox'>
<?php
require_once 'view/menu-staff.php';
?>
	</div>
		<div class='span9 contentbox'>
<?php

if ($staff->getManager()== 1)
{
	?>
	<script src="javascript/umpireManagement.js"> </script>    
	<div id="umpireList">
		<fieldset>
		<legend>All Umpires</legend>
			<table  class='table table-hover table-bordered'>
		  		<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Change</th>
					<th>Delete</th>
		  		 </tr>	
		  		<?php 
		  			$allUmpires = $this->umpire;		  			
		  			for($i=0;$i<sizeof($allUmpires);$i++)
		  			{
		  				echo "<td class='umpireName'>".$allUmpires[$i]->getName()."</td>";
		  				echo "<td class='umpireEmail'>".$allUmpires[$i]->getEmail()."</td>";
		  				echo "<td class='slot0' hidden='true'>".$allUmpires[$i]->getMonMorning()."</td>";
						echo "<td class='slot1' hidden='true'>".$allUmpires[$i]->getMonAfternoon()."</td>";
						echo "<td class='slot2' hidden='true'>".$allUmpires[$i]->getTuesMorning()."</td>";
						echo "<td class='slot3' hidden='true'>".$allUmpires[$i]->getTuesAfternoon()."</td>";
						echo "<td class='slot4' hidden='true'>".$allUmpires[$i]->getWedMorning()."</td>";
						echo "<td class='slot5' hidden='true'>".$allUmpires[$i]->getWedAfternoon()."</td>";
						echo "<td class='slot6' hidden='true'>".$allUmpires[$i]->getThursMorning()."</td>";
						echo "<td class='slot7' hidden='true'>".$allUmpires[$i]->getThursAfternoon()."</td>";
						echo "<td class='slot8' hidden='true'>".$allUmpires[$i]->getFriMorning()."</td>";
						echo "<td class='slot9' hidden='true'>".$allUmpires[$i]->getFriAfternoon()."</td>";
						echo "<td class='slot10' hidden='true'>".$allUmpires[$i]->getSatMorning()."</td>";
						echo "<td class='slot11' hidden='true'>".$allUmpires[$i]->getSatAfternoon()."</td>";
						echo "<td class='slot12' hidden='true'>".$allUmpires[$i]->getSunMorning()."</td>";
						echo "<td class='slot13' hidden='true'>".$allUmpires[$i]->getSunAfternoon()."</td>";						
		  				echo "<td><button type='button' data-toggle='modal' data-target='#editUmpire' id='".$allUmpires[$i]->getID()."' class='btn btn-warning btn-mini'><i class='icon-white  icon-wrench'</i></button></td>";
						echo "<td><button id='".$allUmpires[$i]->getID()."' class='btn btn-danger btn-mini'><i class='icon-white icon-remove-sign'</i></button></td>";		  				
		  				echo "</tr>";
		  			}
		  		?>
			</table>
			<?php 
				if(sizeof($allUmpires)==0)
					echo "There are no umpires."
			?>	
		</fieldset>
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
	                    <h5>Availability</h5> 
	                    <label class="checkbox">Monday Morning <input type="checkbox" id="slot0" ></label>
	                    <label class="checkbox">Monday Afternoon <input type="checkbox" id="slot1" ></label> 
	                    <label class="checkbox">Tuesday Morning <input type="checkbox" id="slot2" ></label> 
	                    <label class="checkbox">Tuesday Afternoon <input type="checkbox" id="slot3" ></label> 
	                    <label class="checkbox">Wednesday Morning <input type="checkbox" id="slot4"></label> 
	                    <label class="checkbox">Wednesday Afternoon <input type="checkbox" id="slot5"></label> 
	                    <label class="checkbox">Thursday Morning <input type="checkbox" id="slot6" > </label>
	                    <label class="checkbox">Thursday Afternoon <input type="checkbox" id="slot7" ></label> 
	                    <label class="checkbox">Friday Morning <input type="checkbox" id="slot8" ></label> 
	                    <label class="checkbox">Friday Afternoon <input type="checkbox" id="slot9" ></label> 
	                    <label class="checkbox">Saturday Morning <input type="checkbox" id="slot10" ></label> 
	                    <label class="checkbox">Saturday Afternoon <input type="checkbox" id="slot11" ></label> 
	                    <label class="checkbox">Sunday Morning <input type="checkbox" id="slot12" > </label>
	                    <label class="checkbox">Sunday Afternoon <input type="checkbox" id="slot13" ></label>                    
			</div>
			 <div class="modal-footer">
			    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
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
			<label for="umpireNameChange">Name: </label>
			<input type="text" id="umpireNameChange"></br><span id="help-inline-umpireName" class="help-inline"></span></br>
			
			<label for="umpireEmailChange">Email: </label>
			<input type="text" id="umpireEmailChange" ></br><span id="help-inline-umpireName" class="help-inline"></span></br>
			
			<h5>Availability</h5> 
	                    <label class="checkbox">Monday Morning <input type="checkbox" id="slott0" ></label>
	                    <label class="checkbox">Monday Afternoon <input type="checkbox" id="slott1" ></label> 
	                    <label class="checkbox">Tuesday Morning <input type="checkbox" id="slott2" ></label> 
	                    <label class="checkbox">Tuesday Afternoon <input type="checkbox" id="slott3" ></label> 
	                    <label class="checkbox">Wednesday Morning <input type="checkbox" id="slott4"></label> 
	                    <label class="checkbox">Wednesday Afternoon <input type="checkbox" id="slott5"></label> 
	                    <label class="checkbox">Thursday Morning <input type="checkbox" id="slott6" > </label>
	                    <label class="checkbox">Thursday Afternoon <input type="checkbox" id="slott7" ></label> 
	                    <label class="checkbox">Friday Morning <input type="checkbox" id="slott8" ></label> 
	                    <label class="checkbox">Friday Afternoon <input type="checkbox" id="slott9" ></label> 
	                    <label class="checkbox">Saturday Morning <input type="checkbox" id="slott10" ></label> 
	                    <label class="checkbox">Saturday Afternoon <input type="checkbox" id="slott11" ></label> 
	                    <label class="checkbox">Sunday Morning <input type="checkbox" id="slott12" > </label>
	                    <label class="checkbox">Sunday Afternoon <input type="checkbox" id="slott13" ></label>              	
		</div>
		 <div class="modal-footer">
		    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		    <button type='button' value='submit' id='editUmpireValidation' class="btn btn-primary btn-medium"><i class="icon-white icon-ok-sign"></i> Save</button>
  		</div>
	</div>
	
</div>
</div>
	<?php 
}

?>
