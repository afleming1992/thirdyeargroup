<?php

if(isset($_GET['name']) && isset($_GET['startDate']) && isset($_GET['endDate']) && isset($_GET['registrationStartDate']) && isset($_GET['registrationEndDate']))
{
	include_once '../config/config.php';
	include_once '../controller/mainController.class.php';
	include_once '../model/tournament.class.php';
	try 
	{
		$db = new PDO("mysql:host=$server;dbname=$database",$user,$password);
		$name = htmlspecialchars($_GET['name']);
		$start = htmlspecialchars($_GET['startDate']);
		$end = htmlspecialchars($_GET['endDate']);
		$regStart = htmlspecialchars($_GET['registrationStartDate']);
		$regEnd = htmlspecialchars($_GET['registrationEndDate']);
		$db->exec("INSERT INTO tournament(name,startDate,endDate,registrationOpen,registrationClose) VALUES('$name','$start','$end','$regStart','$regEnd')");
		
		$app = new MainController($db);
		$app->getAllTournament();
		
		?>
		<fieldset>
		<legend>All Tournament</legend>
		<table>
	  		<tr>
		       <th>Name</th>
		       <th>Start Date</th>
		       <th>End Date</th>
		       <th>Registration Open</th>
		       <th>Registration Close</th>
	  		 </tr>	
	  		<?php 
	  			$allTournament = $app->getTournament();
	  			for($i=0;$i<sizeof($allTournament);$i++)
	  			{
	  				echo "<tr>";
	  				echo "<td>".$allTournament[$i]->getName()."</td>";
	  				echo "<td>".$allTournament[$i]->getStartDate()."</td>";
	  				echo "<td>".$allTournament[$i]->getEndDate()."</td>";
	  				echo "<td>".$allTournament[$i]->getRegisterOpen()."</td>";
	  				echo "<td>".$allTournament[$i]->getRegisterClose()."</td>";
	  				echo "</tr>";
	  			}
	  		?>
		</table>	
	</fieldset>
		
		<?php 
	} 
	catch (Exception $e) 
	{
		echo "Connection error".$e->getMessage();
	}
	
}


?>