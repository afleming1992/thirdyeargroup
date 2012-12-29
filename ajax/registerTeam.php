<?php
	if(isset($_POST['tournamentId']) && isset($_POST['teamName']) && isset($_POST['nwaNumber']) && isset($_POST['contactName']) && isset($_POST['contactNumber']) && isset($_POST['email']) && isset($_POST['players']))
	{
		include_once '../config/config.php';
		include_once '../controller/mainController.class.php';
		include_once '../model/team.class.php';
		include_once '../model/player.class.php';
		
		$db = new PDO("mysql:host=$server;dbname=$database",$user,$password);
		
		$tournamentId = htmlspecialchars($_POST['tournamentId']);
		$teamName = htmlspecialchars($_POST['teamName']);
		$nwaNumber = htmlspecialchars($_POST['nwaNumber']);
		$contactName = htmlspecialchars($_POST['contactName']);
		$contactNumber = htmlspecialchars($_POST['contactNumber']);
		$email = htmlspecialchars($_POST['email']);
		$players = $_POST['players'];
		
		$team = new Team($db);
		$team->setTournamentID($tournamentId);
		$team->setTeamName($teamName);
		$team->setNwaNumber($nwaNumber);
		$team->setContactName($contactName);
		$team->setContactNumber($contactNumber);
		$team->setEmail($email);
		
		$result = $team->addTeamInfo();
		
		
		$query_result = $db->query("SELECT teamID FROM wattball_team WHERE teamName = '".$team->getTeamName()."' AND tournamentID = '".$team->getTournamentId()."' ORDER BY teamID DESC");
		
		$data = $query_result->fetch();
		
		$teamID = $data['teamID'];
		
		$team->setTeamID($teamID);
		
		//Player Input
		$players = explode("\n", $players);
		$number = count($players);
		for($i = 0;$i < $number;$i++)
		{
			trim($players[$i]);
			if($players[$i] != "")
			{
				$player = new Player($db);
				$player->setPlayerName($players[$i]);
				$player->setTeamID($team->getTeamID());
				$result = $player->addPlayerInfo();
			}
		}
	}
?>
