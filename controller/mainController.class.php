<?php

/**
 * Use to load view
 * @author Yohann
 *
 */
class MainController
{
	/**
	 * Object PDO for database connection, query ...
	 * @var Database
	 */
	private $db;
	
	/**
	 * Use to keep all tournament
	 *  @var Array: contains object Tournament
	 */
	private $tournament = array();
	private $umpire = array();
	
	
	public function __construct($db)
	{
		$this->setDb($db);
	}
	
	/**
	 * Load view for home page
	 */
	public function loadHomePage()
	{
            
            $result = $this->db->query("SELECT * FROM wattball_results r
                                        JOIN wattball_matches m ON r.matchID = m.matchID
                                        ORDER BY matchDate DESC LIMIT 1");
            
            $data = $result->fetch();
            if($data != FALSE)
            {
                $matchResult = new Result($data['resultID'], new Team($this->db , $data['team1']) , new Team($this->db , $data['team2']) , $data['team1Score'] , $data['team2Score'] , $this->db);
                $matchResult->getTeamsInfo();
                $matchResult->getGoals();
            }            
            
            $_SESSION['section'] = "home";
            $this->addBasicView();
            require_once 'view/login.php';
            require_once 'view/home.php';
            $this->addFooterFile();
	}
	
	/**
	 * load view for staff if username/password ar correct or load home page with error message if username/password are wrong
	 * @param String $username
	 * @param String $password
	 */
	public function login($username, $password)
	{
		$staff = new Staff($username, sha1($password), $this->db);
		
		if($staff->checkPassword())
		{
			$_SESSION['login'] = true;
			$_SESSION['username'] = $username;		
			$_SESSION['login-popup'] = true;
                        $_SESSION['section'] = "admin";
                        $pageName = "home";
			$this->addBasicView();
                        require_once 'adminView/menu.php';
			require_once 'adminView/home.php';
			$this->addFooterFile();					
		}
		else
		{
			$this->loadPage("loginFalse");	
		}
	}
        
        /**
         * Add all the necessary views files
         */
        public function addBasicView()
        {
            require_once 'view/header.php';
            require_once 'view/banner.php';
            require_once 'view/navbar.php';
        }
        
        public function addFooterFile()
        {
            require_once 'view/footer.php';
        }


        /**
         * Load a page if someone try to access to an admin page without sign in
         */
        public function addLogin()
        {
            $this->addBasicView();
            require_once 'view/login.php';
            require_once 'view/accessToAdminPagesError.php';
            $this->addFooterFile();
        }
        
        /**
         * Load an admin page
         * @param String $pageName
         */
        public function loadAdminPage($pageName)
        {
            //Test login
            $_SESSION['section'] = "admin";
            if(!isset($_SESSION['login']))
            {
                addLogin();
                die();
            }
            else if(isset($_SESSION['login']) && $_SESSION['login']==FALSE)
            {
                addLogin();
                die();
            }
            
            
            $staff = new Staff($_SESSION['username'], null, $this->db);
            $staff->getStaffInfo();
            
            if($pageName=='umpireManagement')
                $this->getAllUmpires();
            else if($pageName == 'tournamentManagement')
            {
                $this->getAllTournament();
                $allTournament = $this->tournament;
            }
            else if($pageName == 'addWattBallResults' || $pageName == 'wattBallReScheduling')
            {
                $isTournament = $this->isCurrentTournament();              
                if($this->tournament == null) // if there is no tournament
                {
                    $this->addBasicView();
                    require_once 'adminView/menu.php';
                    require_once 'adminView/wattBallNoTournament.php';
                    $this->addFooterFile();
                    die();
                }
                else if($this->tournament != null && count($this->tournament[0]->getAllFinishedMatches()) == 0) // if there is a curent tournament but no matches
                {
                    $this->addBasicView();
                    require_once 'adminView/menu.php';
                    require_once 'adminView/wattBallNoTournament.php';
                    $this->addFooterFile();
                    die();
                }
                else //there are matches for the current tournament
                {
                    if($pageName == 'addWattBallResults')
                    {
                        $tournament = $this->tournament; 
                        $matches = $tournament[0]->getAllFinishedMatches();
                    }
                    else 
                    {
                        $this->getWattBallTournament();
                        $allTournament = $this->tournament;
                        $matches = $allTournament[0]->getAllMatches();
                        $teams1 = array();
                        $teams2 = array();
                        $i = 0;
                        foreach ($matches as $m) 
                        {
                           $teams1[$i] = $m->getTeam1Info();
                           $teams2[$i] = $m->getTeam2Info();
                           $i++;
                        }
                    }
                    
                }
                    
            } 
            else if($pageName == 'wattBallScheduling')
            {
                $this->getAllTournament();
                $allTournament = $this->tournament;
                
                if(count($allTournament) == 0)
                {
                    $this->addBasicView();
                    require_once 'adminView/menu.php';
                    require_once 'adminView/noTournament.php';
                    $this->addFooterFile();
                    die();
                } 
                $numberOfTeam = $allTournament[0]->getNumberOfTeam();
                $numberOfUmpire = $allTournament[0]->getNumberOfUmpire();                
                $is_scheduled = $allTournament[0]->is_scheduled();
            }            
            
            $this->addBasicView();
            require_once 'adminView/menu.php';
            require_once 'adminView/'.$pageName.'.php';
            $this->addFooterFile();
            
        }
	
	/**
         * Load a page
         * @param String $pageName
         */
	public function loadPage($pageName) 
	{ 
		if($pageName == 'wattBallRegistration') //before load this page: check if there are tournament
                {
                    $_SESSION['section'] = "wattball"; //Sets the Nav Bar to the Correct Location
                    $result = $this->db->query("SELECT COUNT(*) FROM tournament WHERE registrationOpen <= CURDATE() AND registrationClose >= CURDATE() ORDER BY tournamentID DESC");
                    $numberOfRows = $result->fetchColumn();
                    if($numberOfRows < 1) //No tournament: Load a page said there are no tournament
                    {
                        $this->addBasicView();		
                        require_once 'view/login.php';
                        require_once 'view/wattBallNav.php';
                        require_once 'view/wattBallRegistration_noTournament.php';
                        $this->addFooterFile();
                        die();
                    }
                    else // tournament: Load the information about the tournament
                    {
                        $result = $this->db->query("SELECT `tournamentID`, `name`, `startDate`, `endDate` FROM tournament WHERE registrationOpen <= CURDATE() AND registrationClose >= CURDATE() ORDER BY tournamentID DESC");
                        if($result != false)
                        {
                            $tournament = array();
                            $i = 0;
                            while($data = $result->fetch())
                            {
                                $tournament[$i]['tournamentID'] = $data['tournamentID'];
                                $tournament[$i]['name'] = $data['name'];
                                $tournament[$i]['startDate'] = $data['startDate'];
                                $tournament[$i]['endDate'] = $data['endDate'];
                                $i++;                                   
                            }
                        }
                        if(isset($_SESSION['error']))
                        {
                            $email = $_SESSION['emailValue'];
                            $teamName = $_SESSION['teamName'];
                            $NWANumber = $_SESSION['NWANumber'];
                            $contactName = $_SESSION['contactName'];
                            $contactNumber = $_SESSION['contactNumber'];
                            $players = $_SESSION['players'];                            
                        }
                        $this->addBasicView();
                        require_once 'view/wattBallNav.php';
                        require_once 'view/'.$pageName.'.php';
                        require_once 'view/login.php';
                        $this->addFooterFile();
                        if(isset($_SESSION['error']))
                        {
                            unset($_SESSION['nwaValidationError']);
                            unset($_SESSION['contactNumberError']);
                            unset($_SESSION['contactNameError']);
                            unset($_SESSION['NotEnoughPlayers']);
                            unset($_SESSION['error']);
                            unset($_SESSION['EmailError']);
                            unset($_SESSION['teamNameAlreadyUsed']);
                            unset($_SESSION['teamNameError']);
                            unset($_SESSION['teamName']);
                            unset($_SESSION['teamNameError']);
                            unset($_SESSION['NWANumber']);
                            unset($_SESSION['contactName']);
                            unset($_SESSION['contactNumber']);
                            unset($_SESSION['players']);
                            unset($_SESSION['emailValue']);
                        }
                        die();
                        
                    }
                }
                else if($pageName == "wattBall" || $pageName == "wattBallScheduling" || $pageName == "wattBallRegistrationSuccess" || $pageName == "teams" || $pageName == "ranking" || $pageName == "players")
                {
                    $_SESSION['section'] = "wattball";
                    if($pageName == "wattBallScheduling")
                    {
                        $this->getWattBallTournament();
                        $allTournament = $this->tournament;
                        if(count($allTournament) == 0)
                        {
                            $this->addBasicView();
                            require_once 'view/wattBallNav.php';
                            require_once 'view/wattBallRegistration_noTournament.php';
                            $this->addFooterFile();
                            die();
                        }
                        $matches = $allTournament[0]->getAllMatches();
                        $teams1 = array();
                        $teams2 = array();
                        $i = 0;
                        foreach ($matches as $m) 
                        {
                           $teams1[$i] = $m->getTeam1Info();
                           $teams2[$i] = $m->getTeam2Info();
                           $i++;
                        }
                    }
                    else if($pageName == "wattBall")
                    {
                        $result = $this->db->query("SELECT *,DATE_FORMAT(m.matchDate,'%D %M %Y') AS date FROM wattball_results r
                                                    JOIN wattball_matches m ON r.matchID = m.matchID
                                                    ORDER BY m.matchDate DESC");
            
                        $data = $result->fetchAll();
                        $matchesResults = array();
                        $i = 0;
                        if($data != FALSE)
                        {
                            foreach ($data as $d) 
                            {
                                $matchesResults[$i] = new Result($d['resultID'], new Team($this->db , $d['team1']) , new Team($this->db , $d['team2']) , $d['team1Score'] , $d['team2Score'] , $this->db);
                                $matchesResults[$i]->getTeamsInfo();
                                $matchesResults[$i]->getGoals();
                                $matchesResults[$i]->setMatchDate($d['date']);
                                $i++;
                            }
                        }
                    }
                    else if($pageName == "teams")
                    {
                        $result = $this->db->query("SELECT * FROM wattball_team");
                        $data = $result->fetchAll();
                        $teams = array();
                        $i = 0;
                        if($data != false)
                        {
                            foreach ($data as $d)
                            {
                                $teams[$i] = new Team($this->db, $d['teamID']);
                                $teams[$i]->setContactName($d['contactName']);
                                $teams[$i]->setTeamName($d['teamName']);
                                $teams[$i]->setNwaNumber($d['NWANumber']);
                                $i++;
                            }
                        }
                    }          
                    else if($pageName == "ranking")
                    {
                        $_SESSION['section'] = "wattball";
                        $ranking = new Ranking($this->db);
                        $ranking->ranking();
                        $teams = $ranking->getTeams();
                        
                        $request = $this->db->query("SELECT p.playerName, p.teamID, p.playerID, t.teamName, p.numberOfGoals FROM wattball_players p
                                                    JOIN wattball_team t ON t.teamID = p.teamID 
                                                    ORDER BY 4");
                        $players = array();
                        $teamsName = array();
                        $i=0;
                        while($data = $request->fetch())
                        {
                            $players[$i] = new Player(null);
                            $players[$i]->setPlayerID($data['playerID']);
                            $players[$i]->setPlayerName($data['playerName']);
                            $players[$i]->setTeamID($data['teamID']);
                            $players[$i]->setGoal($data['numberOfGoals']);
                            $teamsName[$i] = $data['teamName'];
                            $i++;
                        }
                    }
                    else if($pageName == "players")
                    {
                        $_SESSION['section'] = "wattball";
                        $players = array();
                        $teamsName = array();
                        $i = 0;
                        $request = $this->db->query("SELECT p.playerName, p.teamID, p.playerID, t.teamName FROM wattball_players p
                                                    JOIN wattball_team t ON t.teamID = p.teamID 
                                                    ORDER BY playerName");
                        while($data = $request->fetch())
                        {
                            $players[$i] = new Player(null);
                            $players[$i]->setPlayerID($data['playerID']);
                            $players[$i]->setPlayerName($data['playerName']);
                            $players[$i]->setTeamID($data['teamID']);
                            $teamsName[$i] = $data['teamName'];
                            $i++;
                        }
                    }
                    
                    $this->addBasicView();
                    require_once 'view/wattBallNav.php';
                    require_once 'view/'.$pageName.'.php';
                    require_once 'view/login.php';
                    $this->addFooterFile();
                    die();
               }
              else if($pageName == "aboutUs")
              {
                    $_SESSION['section'] = "aboutus";
              }
             else if($pageName == "menHurdles" || $pageName == "menHurdlesRegistration" || $pageName == "menHurdlesSchedule")
             {
                     $_SESSION['section'] = "menhurdles";
                     if($pageName == "menHurdleRegistration")
                     {
                        $result = $this->db->query("SELECT COUNT(*) FROM tournament WHERE registrationOpen <= CURDATE() AND registrationClose >= CURDATE() ORDER BY tournamentID DESC");
                        $numberOfRows = $result->fetchColumn();
                        if($numberOfRows < 1) //No tournament: Load a page said there are no tournament
                        {
                            $this->addBasicView();	
                            require_once 'view/login.php';
                            require_once 'view/menHurdlesNav.php';
                            require_once 'view/menHurdlesRegistration_noTournament.php';
                            $this->addFooterFile();
                            die();
                        }
                        else // tournament: Load the information about the tournament
                        {
                            $result = $this->db->query("SELECT `tournamentID`, `name`, `startDate`, `endDate` FROM tournament WHERE registrationOpen <= CURDATE() AND registrationClose >= CURDATE() ORDER BY tournamentID DESC");
                            if($result != false)
                            {
                                $tournament = array();
                                $i = 0;
                                while($data = $result->fetch())
                                {
                                    $tournament[$i]['tournamentID'] = $data['tournamentID'];
                                    $tournament[$i]['name'] = $data['name'];
                                    $tournament[$i]['startDate'] = $data['startDate'];
                                    $tournament[$i]['endDate'] = $data['endDate'];
                                    $i++;                                   
                                }
                            }
                            $this->addBasicView();
                            require_once 'view/menHurdlesNav.php';
                            require_once 'view/'.$pageName.'.php';
                            require_once 'view/login.php';
                            $this->addFooterFile();
                            if(isset($_SESSION['error']))
                            {

                            }
                            die();

                           }
                        }
				
                    //Processing of the Form in here
                    $this->addBasicView();
                    require_once 'view/menHurdleNav.php';
                    require_once 'view/'.$pageName.'.php';
                    require_once 'view/login.php';
                    $this->addFooterFile();
                    die();
            }
            else if($pageName == "femaleHurdles")
            {
                    $_SESSION['section'] = "femalehurdles";
            }
            else if($pageName == "tickets")
            {
                    $_SESSION['section'] = "tickets";
            }            
                       
            $this->addBasicView();
            require_once 'view/'.$pageName.'.php';
            require_once 'view/login.php';
            $this->addFooterFile();
	}
        
        public function loadResultPage($id)
        {
            $_SESSION['section'] = "wattball";
            $result = $this->db->query("SELECT *,DATE_FORMAT(m.matchDate,'%D %M %Y') AS date FROM wattball_results r
                                        JOIN wattball_matches m ON r.matchID = m.matchID
                                        JOIN umpire u ON m.umpire = u.umpireID
                                        WHERE resultID = $id");            
            $data = $result->fetch();
            $matchResults = new Result($data['resultID'], new Team($this->db , $data['team1']) , new Team($this->db , $data['team2']) , $data['team1Score'] , $data['team2Score'] , $this->db);
            $umpire = new Umpire($data['umpireID'], $data['umpireName'], $data['umpireEmail'], null, null, null, null, null, null, null, null, null, null, null, null, null, null);
            $time = $data['matchTime'];
            $pitch = $data['pitch'];
            $matchResults->getTeamsInfo();
            $matchResults->getGoals();
            $matchResults->setMatchDate($data['date']);
            
            $pageName = 'wattBall';
            $this->addBasicView();
            require_once 'view/wattBallNav.php';
            require_once 'view/result.php';
            require_once 'view/login.php';
            $this->addFooterFile();
        }
        
        public function loadTeamPage($teamID)
        {
            $_SESSION['section'] = "wattball";
            $pageName = "teams";
            $team = new Team($this->db, $teamID);
            $team->getTeamInfo();
            $team->getEvent();
            $players = $team->getPlayersInfo();            
            $isRanking = $team->getRanking();
            
            $this->addBasicView();
            require_once 'view/wattBallNav.php';
            require_once 'view/teamDetails.php';
            require_once 'view/login.php';
            $this->addFooterFile();
        }
        
        public function loadPlayersPage($playerID)
        {
             $_SESSION['section'] = "wattball";
             $pageName = "players";
             
             $player = new Player($this->db);
             $player->setPlayerID($playerID);
             $player->getPlayerInfo();
             $request = $this->db->query("SELECT teamName FROM wattball_team WHERE teamID = ".$player->getTeamID());
             $data = $request->fetch();
             $teamName = $data['teamName'];
             
            $this->addBasicView();
            require_once 'view/wattBallNav.php';
            require_once 'view/playerDetails.php';
            require_once 'view/login.php';
            $this->addFooterFile();
             
        }
	
	/**
	 * search in the database all tournament and put in an array
	 */
	public function getAllTournament()
	{
		$result = $this->db->query("SELECT tournamentID, name, DATE_FORMAT(startDate,'%D %M %Y') AS startDate, DATE_FORMAT(endDate,'%D %M %Y') AS endDate,
				 DATE_FORMAT(registrationOpen,'%D %M %Y') AS registrationOpen, DATE_FORMAT(registrationClose,'%D %M %Y') AS registrationClose FROM tournament");
		$i = 0;
		while($data = $result->fetch())
		{
			$this->tournament[$i] = new Tournament($data['tournamentID'],$data['name'],$data['startDate'],$data['endDate'],$data['registrationOpen'],$data['registrationClose'], $this->db);
			$i++;
		}
	}
        
        /**
	 * search in the database all tournament and put in an array
         * @deprecated
	 */
	public function getWattBallTournament()
	{
		$result = $this->db->query("SELECT tournamentID, name, DATE_FORMAT(startDate,'%D %M %Y') AS startDate, DATE_FORMAT(endDate,'%D %M %Y') AS endDate,
				 DATE_FORMAT(registrationOpen,'%D %M %Y') AS registrationOpen, DATE_FORMAT(registrationClose,'%D %M %Y') AS registrationClose FROM tournament");
		$i = 0;
		while($data = $result->fetch())
		{
			$this->tournament[$i] = new Tournament($data['tournamentID'],$data['name'],$data['startDate'],$data['endDate'],$data['registrationOpen'],$data['registrationClose'], $this->db);
			$i++;
		}
	}
	
	/**
	 * search in the database all umpires and put in an array
	 */
	public function getAllUmpires()
	{
		$result = $this->db->query("SELECT `umpireID`, `umpireName`, `umpireEmail`, `monMorning`,monAfternoon,tuesMorning,tuesAfternoon,wedMorning,wedAfternoon,thursMorning,thursAfternoon,friMorning,friAfternoon,satMorning,satAfternoon,sunMorning,sunAfternoon FROM umpire");
		$i = 0;
		while($data = $result->fetch())
		{
			$this->umpire[$i] = new Umpire($data['umpireID'],$data['umpireName'],$data['umpireEmail'],$data['monMorning'],$data['monAfternoon'],$data['tuesMorning'],$data['tuesAfternoon'],$data['wedMorning'],$data['wedAfternoon'],
			$data['thursMorning'],$data['thursAfternoon'],$data['friMorning'],$data['friAfternoon'],$data['satMorning'],$data['satAfternoon'],$data['sunMorning'],$data['sunAfternoon']);
			$i++;                                 
		}
	}
        
        /**
         * Find if there is a tournament now
         */
        public function isCurrentTournament()
        {
            //* Check if there is a current tournament
		$result = $this->db->query("SELECT tournamentID, name, DATE_FORMAT(startDate,'%D %M %Y') AS startDate, DATE_FORMAT(endDate,'%D %M %Y') AS endDate,
				 DATE_FORMAT(registrationOpen,'%D %M %Y') AS registrationOpen, DATE_FORMAT(registrationClose,'%D %M %Y') AS registrationClose 
                                 FROM tournament WHERE startDate < CURDATE() AND  endDate > CURDATE() ORDER BY startDate DESC");
		if($result != false)
		{
                    $i = 0;
                    while($data = $result->fetch())
                    {
                            $this->tournament[$i] = new Tournament($data['tournamentID'],$data['name'],$data['startDate'],$data['endDate'],$data['registrationOpen'],$data['registrationClose'], $this->db);
                            $i++;
                    }
                    return true;
		}
                else
                {
                    $this->tournament = null;
                    return false;
                }
        }
        
        
        public function findClosestTournament()
	{
		//* Check if there is a current tournament
		$result = $this->db->query("SELECT tournamentID, name, DATE_FORMAT(startDate,'%D %M %Y') AS startDate, DATE_FORMAT(endDate,'%D %M %Y') AS endDate,
				 DATE_FORMAT(registrationOpen,'%D %M %Y') AS registrationOpen, DATE_FORMAT(registrationClose,'%D %M %Y') AS registrationClose 
                                 FROM tournament WHERE startDate < CURDATE() AND  endDate > CURDATE() ORDER BY startDate DESC");
		if($data == $result->fetch())
		{
                    $i = 0;
                    while($data = $result->fetch())
                    {
                            $this->tournament[$i] = new Tournament($data['tournamentID'],$data['name'],$data['startDate'],$data['endDate'],$data['registrationOpen'],$data['registrationClose'], $this->db);
                            $i++;
                    }
		}
		else
		{
			$result = $this->db->query("SELECT tournamentID, name, DATE_FORMAT(startDate,'%D %M %Y') AS startDate, DATE_FORMAT(endDate,'%D %M %Y') AS endDate,
				 DATE_FORMAT(registrationOpen,'%D %M %Y') AS registrationOpen, DATE_FORMAT(registrationClose,'%D %M %Y') AS registrationClose 
                                 FROM tournament WHERE CURDATE() < starDate ORDER BY startDate DESC");
			if($data == $result->fetch())
			{
                            $i = 0;
                            while($data = $result->fetch())
                            {
                                    $this->tournament[$i] = new Tournament($data['tournamentID'],$data['name'],$data['startDate'],$data['endDate'],$data['registrationOpen'],$data['registrationClose'], $this->db);
                                    $i++;
                            }
			}
			else
			{
				$this->tournament = null;
			}
		}
	}
        
        /**
	 * Method below processes the Wattball Team Registration
	 */
	
	public function processWattballRegistration($teamName,$contactName,$contactNumber,$nwaNumber,$email,$players)
	{
		$nwaLengthError = 0;
		//This checks that the NWA Number is the correct Length
		if(strlen($nwaNumber) != 7)
		{
			$nwaLengthError = 1;
		}
		
		//Checks the Contact Number is 11 in Length
		if(strlen($contactNumber) != 11)
		{
			$_SESSION['contactNumberError'] = 1;
		}
		
		//This Checks that the first six digits are Numerical and the last is a Letter
		if($nwaLengthError == 1)
		{
			//Checks if the first 6 digits are numeric
			for($i = 0;$i < 6;$i++)
			{
				$thispart = substr($nwaNumber,$i,1);
				$test = is_numeric($thispart);
				if($test != 1)
				{
					$_SESSION['nwaValidationError'] = 1;
				}
			}
			//Checks the last is a letter
				$letter = substr($nwaNumber,6,1);
				if (!(preg_match("/^[a-zA-Z]$/", $letter))) 
				{
					$_SESSION['nwaValidationError'] = 1;
				}
			
		}
                
                if(strlen($teamName) == 0)
                    $_SESSION['teamNameError'] = 1;
                
                if($this->checkTeamName($teamName) == true)
                    $_SESSION['teamNameAlreadyUsed'] = 1;
                
                if(strlen($contactName) == 0)
                    $_SESSION['contactNameError'] = 1;
                
                if (!(preg_match("/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/", $email))) 
                {
                        $_SESSION['EmailError'] = 1;
                }		
		
		//Divide our Players Outpuit
		$players = explode("\n", $players);
		$number = count($players);
		//If there is not enough players in a team, we give a validation error.
		if($number < 11)
		{
			$_SESSION['NotEnoughPlayers'] = 1;
		}
		
		if(isset($_SESSION['nwaLengthError']) || isset($_SESSION['nwaValidationError']) || isset($_SESSION['NotEnoughPlayers']) || isset($_SESSION['contactNumberError']) || isset($_SESSION['teamNameError']) || isset($_SESSION['teamNameAlreadyUsed']) || isset($_SESSION['contactName']) || isset($_SESSION['EmailError']))
		{
			$_SESSION['error'] = 1;
		}
		
		if(!isset($_SESSION['error']))
                    return true;
                else
                    return  false;
		
	}
        
        public function checkTeamName($teamName)
        {
            $result = $this->db->query("SELECT * FROM wattball_team WHERE teamName = '$teamName'");
            $data = $result->fetch();
            if(count($data) == 1)
                return false; //Team name Not found
            else
                return true; //Team Name found
        }
        
        public function saveWattBallRegistration($tournamentId,$teamName,$contactName,$contactNumber,$nwaNumber,$email,$players)
        {
            $team = new Team($this->db, null);
            $team->setTournamentID($tournamentId);
            $team->setTeamName($teamName);
            $team->setNwaNumber($nwaNumber);
            $team->setContactName($contactName);
            $team->setContactNumber($contactNumber);
            $team->setEmail($email);

            $result = $team->addTeamInfo();

            try{
                    $query_result = $this->db->query("SELECT teamID FROM wattball_team WHERE teamName = '".$team->getTeamName()."' AND tournamentID = '".$team->getTournamentId()."' ORDER BY teamID DESC");
            }
            catch(PDOException $ex)
            {
                    print("<b>A Database Error has occured. Please inform an Adminstrator immediately and try again later</b>");
            }
            $players = explode("\n", $players);
            $number = count($players);

            $data = $query_result->fetch(PDO::FETCH_ASSOC);

            $teamID = $data['teamID'];

            $team->setTeamID($teamID);

            //Player Input
            for($i = 0;$i < $number;$i++)
            {
                    trim($players[$i]);
                    if($players[$i] != "")
                    {
                            $player = new Player($this->db);
                            $player->setPlayerName($players[$i]);
                            $player->setTeamID($team->getTeamID());
                            $result = $player->addPlayerInfo();

                    }
            }
        }

        /*-------- GETTERS & SETTERS --------*/
        
        public function getUmpire()
	{
	    return $this->umpire;
	}

	public function setUmpire($umpire)
	{
	    $this->umpire = $umpire;
	}

	
	public function getDb()
	{
	    return $this->db;
	}

	public function setDb($db)
	{
		if($db != null)
	   		$this->db = $db;
		else 
			die("Connection Error");
	}

	public function getTournament()
	{
	    return $this->tournament;
	}

	public function setTournament($tournament)
	{
	    $this->tournament = $tournament;
	}
}

?>
