<legend>All Staff</legend>
	<table  class='table table-hover table-bordered'>
  		<tr>
			<th>Username</th>
			<th>Name</th>
			<th>Email</th>
			<th>Manager</th>
			<th>Change</th>
			<th>Delete</th>
  		 </tr>	
  		<?php 	
			function trueOrFalse($boolean)
			{
				if($boolean)
					return "Yes";
				else
					return "No";
			}
			
  			for($i=0;$i<sizeof($allStaff);$i++)
  			{
  				echo "<tr>";
  				echo "<td class='username'>".$allStaff[$i]->getUsername()."</td>";
  				echo "<td class='name'>".$allStaff[$i]->getName()."</td>";
  				echo "<td class='email'>".$allStaff[$i]->getEmail()."</td>";
  				echo "<td class='manager'>".trueOrFalse($allStaff[$i]->getManager())."</td>";			
  				echo "<td><button type='button' data-toggle='modal' data-target='#editStaff' id='".$allStaff[$i]->getUsername()."' class='btn btn-warning btn-mini'><i class='icon-white  icon-wrench'</i></button></td>";
				echo "<td><button id='".$allStaff[$i]->getUsername()."' class='btn btn-danger btn-mini'><i class='icon-white icon-remove-sign'</i></button></td>";		  				
  				echo "</tr>";
  			}
  		?>
	</table>
	<?php 
		if(sizeof($allStaff)==0)
			echo "There are no staff."
	?>
