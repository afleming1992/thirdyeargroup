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
	 * @var PDO
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
                        $this->getAllTournament();
                        $allTournament = $this->tournament;
			$this->addBasicView();
                        require_once 'adminView/menu.php';
			require_once 'adminView/home.php';
			$this->addFooterFile();					
		}
		else
		{
			$this->addBasicView();
			require_once 'view/loginFalse.php.php';
			require_once 'view/home.php';
			$this->addFooterFile();		
		}
	}
        
        /**
         * Add all the necessary views files
         */
        public function addBasicView()
        {
            require_once 'view/header.php';
            require_once 'view/banner.php';
            require_once 'view/navBar.php';
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
            else if($pageName=='tournamentManagement')
            {
                $this->getAllTournament();
                $allTournament = $this->tournament;
            }
            else if($pageName == 'wattBallScheduling')
            {
                $this->getWattBallTournament();
                $allTournament = $this->tournament;
                $numberOfTeam = $allTournament[0]->getNumberOfTeam();
                $numberOfUmpire = $allTournament[0]->getNumberOfUmpire(); 
                if(count($allTournament) == 0)
                {
                    $this->addBasicView();
                    require_once 'adminView/menu.php';
                    require_once 'adminView/noTournament.php';
                    $this->addFooterFile();
                    die();
                }                
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
		if($pageName=='homeStaff')
		{
			$staff = new Staff($_SESSION['username'], null, $this->db);
			$staff->getStaffInfo();
			$this->getAllTournament();
		}
                else if($pageName == 'wattBallRegistration') //before load this page: check if there are tournament
                {
                    $result = $this->db->query("SELECT COUNT(*) FROM tournament WHERE registrationOpen <= CURDATE() AND registrationClose >= CURDATE() ORDER BY tournamentID DESC");
                    $numberOfRows = $result->fetchColumn();
                    if($numberOfRows < 1) //No tournament: Load a page said there are no tournament
                    {
                        $this->addBasicView();		
                        require_once 'view/login.php';
                        require_once 'view/wattBallRegistration_noTournament.php';
                        require_once 'view/footer.php';
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
                        
                    }
                }
		$this->addBasicView();		
		require_once 'view/login.php';
		require_once 'view/'.$pageName.'.php';
		require_once 'view/footer.php';
	}
	
	/**
	 * search in the database all tournament and put in an array
	 */
	public function getAllTournament()
	{
		$result = $this->db->query("SELECT tournamentID, name, DATE_FORMAT(startDate,'%D %M %Y') AS startDate, DATE_FORMAT(endDate,'%D %M %Y') AS endDate,
				 DATE_FORMAT(registrationOpen,'%D %M %Y') AS registrationOpen, DATE_FORMAT(registrationClose,'%D %M %Y') AS registrationClose, type, scheduled FROM tournament");
		$i = 0;
		while($data = $result->fetch())
		{
			$this->tournament[$i] = new Tournament($data['tournamentID'],$data['name'],$data['startDate'],$data['endDate'],$data['registrationOpen'],$data['registrationClose'], $data['type'], $data['scheduled'], $this->db);
			$i++;
		}
	}
        
        /**
	 * search in the database all tournament and put in an array
	 */
	public function getWattBallTournament()
	{
		$result = $this->db->query("SELECT tournamentID, name, DATE_FORMAT(startDate,'%D %M %Y') AS startDate, DATE_FORMAT(endDate,'%D %M %Y') AS endDate,
				 DATE_FORMAT(registrationOpen,'%D %M %Y') AS registrationOpen, DATE_FORMAT(registrationClose,'%D %M %Y') AS registrationClose, type, scheduled FROM tournament WHERE type = 'WattBall'");
		$i = 0;
		while($data = $result->fetch())
		{
			$this->tournament[$i] = new Tournament($data['tournamentID'],$data['name'],$data['startDate'],$data['endDate'],$data['registrationOpen'],$data['registrationClose'], $data['type'], $data['scheduled'], $this->db);
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
        
        public function findClosestTournament()
	{
		//* Check if there is a current tournament
		$result = $this->db->query("SELECT tournamentID FROM tournament WHERE startDate < CURDATE() AND  endDate > CURDATE() ORDER BY startDate DESC");
		if($data = $result->fetch())
		{
			return $data['tournamentID'];
		}
		else
		{
			$result = $this->db->query("SELECT tournamentID FROM tournament WHERE CURDATE() < starDate ORDER BY startDate DESC");
			if($data = $result->fetch())
			{
				return $data['tournamentID'];
			}
			else
			{
				return -1;
			}
		}
	}
        
        /**
	 * Method below processes the Wattball Team Registration
	 */
	
	public function processWattballRegistration($tournamentId,$teamName,$contactName,$contactNumber,$nwaNumber,$email,$players)
	{
		
		//This checks that the NWA Number is the correct Length
		if(strlen($nwaNumber) > 7 || strlen($nwaNumber) < 7)
		{
			$_SESSION['('] = 1;
		}
		
		//Checks the Contact Number is 11 in Length
		if(strlen($contactNumber) != 11)
		{
			$_SESSION['contactNumberError'] = 1;
		}
		
		//This Checks that the first six digits are Numerical and the last is a Letter
		if(isset($_SESSION['nwaLengthError']))
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
		
		
		//Divide our Players Outpuit
		$players = explode("\n", $players);
		$number = count($players);
		//If there is not enough players in a team, we give a validation error.
		if($number < 11)
		{
			$_SESSION['NotEnoughPlayers'] = 1;
		}
		
		if(isset($_SESSION['nwaLengthError']) || isset($_SESSION['nwaValidationError']) || isset($_SESSION['NotEnoughPlayers']) || isset($_SESSION['contactNumberError']))
		{
			$_SESSION['error'] = 1;
		}
		
		if(!isset($_SESSION['error']))
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
				print("<b>An Database Error has occured. Please inform an Adminstrator immediately and try again later</b>");
			}
			
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
			$_SESSION['completed'] = 1;
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
