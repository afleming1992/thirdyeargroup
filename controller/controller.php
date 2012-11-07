<?php

require_once 'controller/mainController.class.php';

/**
 * Represent the application
 * @var MainController
 */
$app = new MainController($db);


if(isset($_POST['submitButtonLogin']))
{
	$app->getAllTournament();
	$app->login(htmlspecialchars($_POST['username']), htmlspecialchars($_POST['password']));
}	
else if(isset($_GET['page']))
{
	$app->loadPage(htmlspecialchars($_GET['page']));
}
else
	$app->loadHomePage();

$db = null;


?>