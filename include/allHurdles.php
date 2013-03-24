<legend>All <?php echo $gender ?> Hurdlers</legend>
	<table  class='table table-hover table-bordered'>
  		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Date Of Birth</th>
			<th>Performance Time</th>
			<th>Contact Details</th>
  		 </tr>	
  		<?php 	  			
  			for($i=0;$i<sizeof($allHurdlers);$i++)
  			{
				list($minutes, $seconds, $milliseconds) = $allHurdlers[$i]->convertMilliseconds();
				echo "<tr>";
  				echo "<td class='hurdlerName' hidden='true'>".$allHurdlers[$i]->getHurdlerId()."</td>";
  				echo "<td class='hurdlerFirstName'>".$allHurdlers[$i]->getFirstName()."</td>";
  				echo "<td class='hurdlerLastName'>".$allHurdlers[$i]->getLastName()."</td>";
  				echo "<td class='hurdlerEmail' hidden='true'>".$allHurdlers[$i]->getEmail()."</td>";
  				echo "<td class='hurdlerEmergencyContact' hidden='true'>".$allHurdlers[$i]->getEmergencyContact()."</td>";
  				echo "<td class='hurdlerHouseNo' hidden='true'>".$allHurdlers[$i]->getHouseNo()."</td>";
  				echo "<td class='hurdlerStreetName' hidden='true'>".$allHurdlers[$i]->getStreetName()."</td>";
  				echo "<td class='hurdlerPostCode' hidden='true'>".$allHurdlers[$i]->getPostCode()."</td>";
  				echo "<td class='hurdlerDob'>".$allHurdlers[$i]->getDob()."</td>";
  				echo "<td class='hurdlerPerformanceTime'>".$minutes."m ".$seconds."s ".$milliseconds."ms</td>";
  				echo "<td class='hurdlerCity' hidden='true'>".$allHurdlers[$i]->getCity()."</td>";
  				
			
				echo "<td><button type='button' data-toggle='modal' data-target='#contactDetails' id='".$allHurdlers[$i]->getHurdlerId()."' class='btn btn-info btn-mini'><i class='icon-white  icon-list'</i></button></td>";	  				
  				echo "</tr>";
  			}
  		?>
	</table>
	<?php 
		if(sizeof($allHurdlers)==0)
			echo "There are no ".$gender." hurdlers";
	?>
