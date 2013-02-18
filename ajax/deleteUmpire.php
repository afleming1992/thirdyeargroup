<?php

if(isset($_GET['id']))
{
	include_once '../config/config.php';
	include_once '../controller/mainController.class.php';
	include_once '../model/Umpire.class.php';
	try
	{
		$db = new PDO("mysql:host=$server;dbname=$database",$user,$password);
		$id = htmlspecialchars($_GET['id']);
		$db->exec("DELETE FROM umpire WHERE umpireID=$id");
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
