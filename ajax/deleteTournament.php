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
                $app->getAllTournament();
                $allTournament = $app->getTournament();
                require_once '../include/allTournament.php';		
        } 
        catch (Exception $e) 
        {
                echo "Connection error".$e->getMessage();
        }
}

?>