<?php

require_once 'controller/mainController.class.php';

/**
 * Represent the application
 * @var MainController
 */
$app = new MainController($db);

if(isset($_POST['submitButtonLogin']))
{
	$app->login(htmlspecialchars($_POST['username']), htmlspecialchars($_POST['password']));
}
else if(isset($_POST['tournamentId']) && isset($_POST['teamName']) && isset($_POST['nwaNumber']) && isset($_POST['contactName']) && isset($_POST['contactNumber']) && isset($_POST['email']) && isset($_POST['players']))
{
    if($app->processWattballRegistration(htmlspecialchars($_POST['teamName']),htmlspecialchars($_POST['contactName']),htmlspecialchars($_POST['contactNumber']),htmlspecialchars($_POST['nwaNumber']),htmlspecialchars($_POST['email']),htmlspecialchars($_POST['players'])) == false)
    {
        // if there is some errors
        if(isset($_SESSION['error']) && isset($_SESSION['teamNameAlreadyUsed']))
            
        $_SESSION['teamName'] = htmlspecialchars($_POST['teamName']);
        $_SESSION['NWANumber'] = htmlspecialchars($_POST['nwaNumber']);
        $_SESSION['contactName'] = htmlspecialchars($_POST['contactName']);
        $_SESSION['contactNumber'] = htmlspecialchars($_POST['contactNumber']);
        $_SESSION['players'] = htmlspecialchars($_POST['players']);        
        $_SESSION['emailValue'] = htmlspecialchars($_POST['email']);       
        $app->loadPage('wattBallRegistration');
	
        
    }
    else
    {
        $app->saveWattBallRegistration(htmlspecialchars($_POST['tournamentId']),htmlspecialchars($_POST['teamName']),htmlspecialchars($_POST['contactName']),htmlspecialchars($_POST['contactNumber']),htmlspecialchars($_POST['nwaNumber']),htmlspecialchars($_POST['email']),htmlspecialchars($_POST['players']));
        $app->loadPage('wattBallRegistrationSuccess');
    }
	
}
else if(isset($_POST['teamID']) && isset($_POST['changeteamName']) && isset($_POST['changenwaNumber']) && isset($_POST['changecontactName']) && isset($_POST['changecontactNumber']) && isset($_POST['changeemail']))
{
    if($app->processChangeTeamDetails(htmlspecialchars($_POST['changeteamName']),htmlspecialchars($_POST['changecontactName']),htmlspecialchars($_POST['changecontactNumber']),htmlspecialchars($_POST['changenwaNumber']),htmlspecialchars($_POST['changeemail'])) == false)
    {
        // if there is some errors
        if(isset($_SESSION['error']) && isset($_SESSION['teamNameAlreadyUsed']))
            
        $_SESSION['teamName'] = htmlspecialchars($_POST['changeteamName']);
        $_SESSION['NWANumber'] = htmlspecialchars($_POST['changenwaNumber']);
        $_SESSION['contactName'] = htmlspecialchars($_POST['changecontactName']);
        $_SESSION['contactNumber'] = htmlspecialchars($_POST['changecontactNumber']);       
        $_SESSION['emailValue'] = htmlspecialchars($_POST['changeemail']);       
        $app->loadChangeTeamPage(htmlspecialchars($_POST['teamID']));
	
        
    }
    else
    {
        $app->saveTeamChange(htmlspecialchars($_POST['teamID']),htmlspecialchars($_POST['changeteamName']),htmlspecialchars($_POST['changecontactName']),htmlspecialchars($_POST['changecontactNumber']),htmlspecialchars($_POST['changenwaNumber']),htmlspecialchars($_POST['changeemail']));
        $app->loadAdminPage('changeTeamDetailsSucess');
    }
	
}
else if(isset ($_GET['adminPage']))
{
    $section = "";
    $app->loadAdminPage(htmlspecialchars($_GET['adminPage']));
}
else if(isset($_GET['page']))
{
	$app->loadPage(htmlspecialchars($_GET['page']));
}
else if(isset($_GET['result']))
{
    $app->loadResultPage(htmlspecialchars($_GET['result']));
}
else if(isset($_GET['team']))
{
    $app->loadTeamPage(htmlspecialchars($_GET['team']));
}
else if(isset($_GET['player']))
{
    $app->loadPlayersPage(htmlspecialchars($_GET['player']));
}
else if(isset($_GET['changeTeam']))
{
    $app->loadChangeTeamPage(htmlspecialchars($_GET['changeTeam']));
}
else
	$app->loadHomePage();

$db = null;


?>
