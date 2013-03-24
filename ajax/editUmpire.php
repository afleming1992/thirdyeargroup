<?php

if(isset($_GET['umpireName']) && isset($_GET['umpireEmail']) && isset($_GET['id']) && isset($_GET['checklist']))
{
	include_once '../config/config.php';
	include_once '../controller/mainController.class.php';
	include_once '../model/Umpire.class.php';
	try 
	{
		$db = new PDO("mysql:host=$server;dbname=$database",$user,$password);
		$umpireName = mysql_escape_string(htmlspecialchars($_GET['umpireName']));
		$umpireEmail = mysql_escape_string(htmlspecialchars($_GET['umpireEmail']));
		$id = htmlspecialchars($_GET['id']);
		$checklist = ($_GET['checklist']);
		
		$db->exec("UPDATE umpire SET umpireName = '$umpireName', umpireEmail = '$umpireEmail', monMorning = '$checklist[0]',
		 monAfternoon = '$checklist[1]', tuesMorning = '$checklist[2]', tuesAfternoon = '$checklist[3]', wedMorning = '$checklist[4]',
		  wedAfternoon = '$checklist[5]', thursMorning = '$checklist[6]', thursAfternoon = '$checklist[7]', friMorning = '$checklist[8]',
		   friAfternoon = '$checklist[9]', satMorning = '$checklist[10]', satAfternoon = '$checklist[11]', sunMorning = '$checklist[12]',
		    sunAfternoon= '$checklist[13]' WHERE umpireID = '$id'");
		$app = new MainController($db);
		$app->getAllUmpires();
		$allUmpires = $app->getUmpire();
		require_once("../include/allUmpires.php"); 
	} 
	catch (Exception $e) 
	{
		echo "Connection error".$e->getMessage();
	}
	
}


?>
