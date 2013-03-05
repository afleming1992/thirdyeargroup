<?php
if(isset($_GET['username']))
{
	include_once '../config/config.php';
	include_once '../controller/mainController.class.php';
	include_once '../model/RealStaff.class.php';
	try 
	{
		$db = new PDO("mysql:host=$server;dbname=$database",$user,$password);
		$username = htmlspecialchars($_GET['username']);
		$count = $db->exec("DELETE FROM staff WHERE username = '$username'");
		if($count < 1)
		{
			//echo "<br/>PDO::errorInfo():<br/>";
			//print_r($db->errorInfo());
			
			$app = new MainController($db);
			$app->getAllStaff();
			$allStaff = $app->getStaff();
			require_once("../include/allStaff.php"); 
			echo "<b>No deletion occured.<br></b>";
			return;
		}
		
		$app = new MainController($db);
		$app->getAllStaff();
		$allStaff = $app->getStaff();
		
		require_once("../include/allStaff.php"); 
		echo "<b>User \"".$username."\" Deleted.</b><br/><br/>";
	} 
	catch (Exception $e) 
	{
		echo "Connection error".$e->getMessage();
	}
	
}

?>
