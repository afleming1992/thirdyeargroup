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
		$query = $db->exec("DELETE FROM umpire WHERE umpireID=$id");
		if(!$query)
		{
			echo "<p class='text-error'>ERROR: Umpire is involved in tournament and cannot be deleted. </p>";
		}
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
