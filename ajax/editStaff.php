<?php

if(isset($_GET['name']) && isset($_GET['username']) && isset($_GET['email']) && isset($_GET['manager']))
{
	include_once '../config/config.php';
	include_once '../controller/mainController.class.php';
	include_once '../model/RealStaff.class.php';
	try 
	{
		$db = new PDO("mysql:host=$server;dbname=$database",$user,$password);
		$name = htmlspecialchars($_GET['name']);
		$username = htmlspecialchars($_GET['username']);
		$email = htmlspecialchars($_GET['email']);
		$manager = $_GET['manager'];
		
		$count = $db->exec("UPDATE staff SET name = '$name',manager = '$manager',email = '$email' WHERE username = '$username'");
		if($count < 1)
		{
			//echo "<br/>PDO::errorInfo():<br/>";
			//print_r($db->errorInfo());
			
			$app = new MainController($db);
			$app->getAllStaff();
			$allStaff = $app->getStaff();
			require_once("../include/allStaff.php"); 
			echo "<b>No Change was made.<br></b>";
			return;
		}
		
		$app = new MainController($db);
		$app->getAllStaff();
		$allStaff = $app->getStaff();
		
		require_once("../include/allStaff.php"); 
		echo "<b>User \"".$username."\" Edited.</b><br/><br/>";
	} 
	catch (Exception $e) 
	{
		echo "Connection error".$e->getMessage();
	}
	
}

?>
