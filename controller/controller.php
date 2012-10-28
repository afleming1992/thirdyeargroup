<?php

require_once 'controller/mainController.class.php';
$app = new MainController($db);

if ($_POST['submitButtonLogin'])
{
	$app->login(htmlspecialchars($_POST['username']), htmlspecialchars($_POST['password']));
}
else
	$app->loadHomePage();

?>