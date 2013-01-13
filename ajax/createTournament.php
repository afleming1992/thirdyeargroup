<?php

if(isset($_GET['name']) && isset($_GET['startDate']) && isset($_GET['endDate']) && isset($_GET['registrationStartDate']) && isset($_GET['registrationEndDate']) && isset($_GET['type']))
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
                $type = htmlspecialchars($_GET['type']);
		$db->exec("INSERT INTO tournament(name,startDate,endDate,registrationOpen,registrationClose,type) VALUES('$name','$start','$end','$regStart','$regEnd','$type')");
		
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