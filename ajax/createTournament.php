<?php

if(isset($_GET['name']) && isset($_GET['startDate']) && isset($_GET['endDate']) && isset($_GET['registrationStartDate']) && isset($_GET['registrationEndDate']))
{
	include_once '../config/config.php';
	include_once '../controller/mainController.class.php';
	include_once '../model/Tournament.class.php';
	try 
	{
		$db = new PDO("mysql:host=$server;dbname=$database",$user,$password);
		$name = mysql_escape_string(htmlspecialchars($_GET['name']));
		$start = htmlspecialchars($_GET['startDate']);
		$end = htmlspecialchars($_GET['endDate']);
		$regStart = htmlspecialchars($_GET['registrationStartDate']);
		$regEnd = htmlspecialchars($_GET['registrationEndDate']);
		$db->exec("INSERT INTO tournament(name,startDate,endDate,registrationOpen,registrationClose) VALUES('$name','$start','$end','$regStart','$regEnd')");
		
		$app = new MainController($db);
		$app->getAllTournament();
                $allTournament = $app->getTournament();
                require_once '../include/allTournament.php';
                $db = null;
	} 
	catch (Exception $e) 
	{
		echo "Connection error".$e->getMessage();
	}
	
}


?>