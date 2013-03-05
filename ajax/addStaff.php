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
		$staffPassword = randomString(6);
		$hashPassword = sha1($staffPassword);
		
		$count = $db->exec("INSERT INTO staff(name,username,password,manager,email) VALUES('$name','$username','$hashPassword','$manager','$email')");
		if($count < 1)
		{
			//echo "<br/>PDO::errorInfo():<br/>";
			//print_r($db->errorInfo());
			
			$app = new MainController($db);
			$app->getAllStaff();
			$allStaff = $app->getStaff();
			require_once("../include/allStaff.php"); 
			echo "<b>Nothing was added.<br></b>";
			return;
		}
		
		$app = new MainController($db);
		$app->getAllStaff();
		$allStaff = $app->getStaff();
		
		$_SESSION['name'] = $name;
		$_SESSION['email'] = $email;
		$_SESSION['password'] = $staffPassword;
		$_SESSION['subject'] = "Riccarton Sports Centre Admin Login";
		$_SESSION['body'] = "Your initial login details for the Riccarton Sports Centre Admin Pages:<br><br>Username: ".$username.
			"<br>Password: ".$staffPassword."<br><br>It is recommended that you change your password when you first login.";
			
		require_once("../include/email/sendEmail.php");
		require_once("../include/allStaff.php"); 
		echo "<b>User \"".$username."\" Added. Login credentials sent to \"".$email."\".</b><br/><br/>";
	} 
	catch (Exception $e) 
	{
		echo "Connection error".$e->getMessage();
	}
	
}

function randomString($length) 
{
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	return substr(str_shuffle($chars),0,$length);
}

?>
