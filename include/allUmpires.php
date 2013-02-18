<legend>All Umpires</legend>
	<table  class='table table-hover table-bordered'>
  		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Change</th>
			<th>Delete</th>
  		 </tr>	
  		<?php 	  			
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
