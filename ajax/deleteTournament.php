<?php

if(isset($_GET['id']))
{
	include_once '../config/config.php';
	include_once '../controller/mainController.class.php';
	include_once '../model/tournament.class.php';
	try
	{
		$db = new PDO("mysql:host=$server;dbname=$database",$user,$password);
		$id = htmlspecialchars($_GET['id']);
		$db->exec("DELETE FROM tournament WHERE tournamentID=$id");
	
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
			       <th>Change</th>
			       <th>Delete</th>
		  		 </tr>	
		  		<?php 
		  			$allTournament = $app->getTournament();
					for($i=0;$i<sizeof($allTournament);$i++)
		  			{
		  				echo "<tr index='test'>";
		  				echo "<td class='name'>".$allTournament[$i]->getName()."</td>";
		  				echo "<td class='startDate' startDate='".$allTournament[$i]->getDateSQLFormat($allTournament[$i]->getStartDate())."'>".$allTournament[$i]->getStartDate()."</td>";
		  				echo "<td class='endDate' endDate='".$allTournament[$i]->getDateSQLFormat($allTournament[$i]->getEndDate())."'>".$allTournament[$i]->getEndDate()."</td>";
		  				echo "<td class='registrationStart' registrationStart='".$allTournament[$i]->getDateSQLFormat($allTournament[$i]->getRegisterOpen())."'>".$allTournament[$i]->getRegisterOpen()."</td>";
		  				echo "<td class='registrationEnd' registrationEnd='".$allTournament[$i]->getDateSQLFormat($allTournament[$i]->getRegisterClose())."'>".$allTournament[$i]->getRegisterClose()."</td>";
		  				echo "<td><button id='".$allTournament[$i]->getTournamentID()."' class='btn btn-warning btn-mini'><i class='icon-white  icon-wrench'</i></button></td>";
		  				echo "<td><button id='".$allTournament[$i]->getTournamentID()."' class='btn btn-danger btn-mini'><i class='icon-white icon-remove-sign'</i></button></td>";		  				
		  				echo "</tr>";
		  			}
		  		?>
			</table>
			<?php 
				if(sizeof($allTournament)==0)
					echo "There is no tournament."
			?>	
		</fieldset>
			
			<?php 
		} 
		catch (Exception $e) 
		{
			echo "Connection error".$e->getMessage();
		}
}

?>