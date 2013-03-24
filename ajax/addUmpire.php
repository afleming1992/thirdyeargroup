<?php

if(isset($_GET['umpireName']) && isset($_GET['umpireEmail'])&& isset($_GET['checklist']))
{
	include_once '../config/config.php';
	include_once '../controller/mainController.class.php';
	include_once '../model/Umpire.class.php';
	try 
	{
		$db = new PDO("mysql:host=$server;dbname=$database",$user,$password);
		$umpireName = mysql_real_escape_string(htmlspecialchars($_GET['umpireName']));
		$umpireEmail = mysql_real_escape_string(htmlspecialchars($_GET['umpireEmail']));
		$checklist = ($_GET['checklist']);
		$db->exec("INSERT INTO umpire(umpireName,umpireEmail,monMorning,monAfternoon,tuesMorning,tuesAfternoon,wedMorning,wedAfternoon,thursMorning,thursAfternoon,friMorning,friAfternoon,satMorning,
		satAfternoon,sunMorning,sunAfternoon) VALUES('$umpireName','$umpireEmail','$checklist[0]','$checklist[1]','$checklist[2]','$checklist[3]','$checklist[4]','$checklist[5]','$checklist[6]',
		'$checklist[7]','$checklist[8]','$checklist[9]','$checklist[10]','$checklist[11]','$checklist[12]','$checklist[13]')");
		
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
