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
else if(isset($_POST['tournamentId']) && isset($_POST['teamName']) && isset($_POST['nwaNumber']) && isset($_POST['contactName']) && isset($_POST['contactNumber']) && isset($_POST['email']) && isset($_POST['players']))
{
	//Process WattballRegistration
	$app->processWattballRegistration(htmlspecialchars($_POST['tournamentId']),htmlspecialchars($_POST['teamName']),htmlspecialchars($_POST['contactName']),htmlspecialchars($_POST['contactNumber']),htmlspecialchars($_POST['nwaNumber']),htmlspecialchars($_POST['email']),$_POST['players']);
	$app->loadPage('wattBallRegistration');
	unset($_SESSION['completed']);
	unset($_SESSION['nwaValidationError']);
	unset($_SESSION['nwaLengthError']);
	unset($_SESSION['contactNumberError']);
	unset($_SESSION['NotEnoughPlayers']);
}
else if(isset($_GET['page']))
{
	$app->loadPage(htmlspecialchars($_GET['page']));
}
else
	$app->loadHomePage();

$db = null;


?>
