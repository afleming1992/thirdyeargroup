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
	private $staff = array();
	private $allHurdlers = array();
	private $gender;
	
	
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
            else if($pageName == 'addWattBallResults' || $pageName == 'wattBallReScheduling' || $pageName == 'wattBall')
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
                else //there are matches for the current tournament
                {
                    if($pageName == 'addWattBallResults')
                    {
                        $tournament = $this->tournament; 
                        $matches = $tournament[0]->getAllFinishedMatches();
                    }
                    else if($pageName == 'wattBall')
                    {
                        $isTournamentStarted = $this->isTournamentStarted();
                        $isScheduled = $this->tournament[0]->is_scheduled(); 
                        $result = $this->db->query("SELECT * FROM wattball_team ORDER BY teamName");
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
                                $teams[$i]->setEmail($d['email']);
                                $teams[$i]->setContactNumber($d['contactNumber']);
                                $i++;
                            }
                        }
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
			else if($pageName == 'ticketStatus')
			{
				$result = $this->db->query("SELECT * FROM tournament WHERE startDate > CURDATE() OR (startDate < CURDATE() AND endDate > CURDATE()) ORDER BY startDate ASC");
				$rowCount = $result->rowCount();
				if($result == false || $rowCount == '0')
				{
					$this->addBasicView();
                    require_once 'adminView/menu.php';
                    require_once 'adminView/wattBallNoTournament.php';
                    $this->addFooterFile();
                    die();
				}
				$data = $result->fetch();
				$tournament = new Tournament($data['tournamentID'],$data['name'],$data['startDate'],$data['endDate'],$data['registrationOpen'],$data['registrationClose'], $this->db);
				$days = array();
				$days = $tournament->GetDays();
				$tournamentName = $tournament->getName();
				if(isset($_GET['date']))
				{
					$result = $this->db->query("SELECT type,COUNT(ticketId) AS count FROM ticket WHERE dateOfTicket = '".htmlspecialchars($_GET['date'])."' GROUP BY type" );
					if($result != false)
					{
						$adult = 0;
						$concession = 0;
						$complimentary = 0;
						while($data = $result->fetch())
						{
							if(strcmp($data['type'],"adult") == 0)
							{
								$adult = $data['count'];
							}
							else if(strcmp($data['type'],"concession") == 0)
							{
								$concession = $data['count'];
							}
							else
							{
								$complimentary = $data['count'];
							}
						}
					}
					else
					{
						$this->addBasicView();
						require_once 'adminView/menu.php';
						require_once 'adminView/ticketStatus_error.php';
						$this->addFooterFile();
					}
						
						$result = $this->db->query("SELECT * FROM properties WHERE id = '1'");
						if($result != false)
						{
							$data = $result->fetch();
							$capacity = $data['ticketLimit'];
						}
						else
						{
							$this->addBasicView();
							require_once 'adminView/menu.php';
							require_once 'adminView/ticketStatus_error.php';
							$this->addFooterFile();
						}
						
						$result = $this->db->query("SELECT methodOfSale,COUNT(ticketID) AS count FROM ticket WHERE dateOfTicket= '".htmlspecialchars($_GET['date'])."' GROUP BY methodOfSale");
						if($result != false)
						{
							$postal = 0;
							$pickup = 0;
							$ontheday = 0;
							while($data = $result->fetch())
							{
								if(strcmp($data['methodOfSale'],"postal") == 0)
								{
									$postal = $data['count'];
								}
								else if(strcmp($data['methodOfSale'],"ontheday") == 0)
								{
									$ontheday = $data['count'];
								}
								else
								{
									$pickup = $data['count'];
								}
							}
						}
						else
						{
							$this->addBasicView();
							require_once 'adminView/menu.php';
							require_once 'adminView/ticketStatus_error.php';
							$this->addFooterFile();
						}
						$totalTakings = $this->ticketPrice($adult,$concession);
						
				}
			}
			else if($pageName == 'processTicket')
			{
				if($_POST['processTicket'] == 1)
				{
					$adultTickets = $_POST['adult'];
					$concessionTickets = $_POST['concession'];
					
					$check = $this->ticketCheck($_POST['date'],$adultTickets + $concessionTickets);
					if($check)
					{
						for($i = 0;$i < $adultTickets;$i++)
						{
							$ticket = new Ticket('0',$this->db);
							$ticket->setBookingID(null);
							$ticket->setDate($_POST['date']);
							$ticket->setType("adult");
							$ticket->setMethodOfSale("ontheday");
							$ticket->setStatus("COLLECTED");
							$ticket->createTicket();
						}
						
						for($i = 0;$i < $concessionTickets;$i++)
						{
							$ticket = new Ticket('0',$this->db);
							$ticket->setBookingID(null);
							$ticket->setDate($_POST['date']);
							$ticket->setType("concession");
							$ticket->setMethodOfSale("ontheday");
							$ticket->setStatus("COLLECTED");
							$ticket->createTicket();
						}
						
						
					}
				}
				$isTournament = $this->isCurrentTournament();   
				if($this->tournament == null)
				{
					$this->addBasicView();
					require_once 'adminView/menu.php';
					require_once 'adminView/tickets_notournament.php';
					$this->addFooterFile();
					exit();
				}
				$result = $this->db->query("SELECT * FROM properties WHERE id = '1'");
				if($result)
				{
					$data = $result->fetch();
				}
				$dates = array();
				$dates = $this->tournament[0]->GetDays();
				$capacity = array();
				for($i = 0;$i < count($dates);$i++)
				{
					$capacity[$i] = $this->ticketsRemaining($dates[$i]);
				}
				$adultPrice = $data['adultPrice'];
				$concessionPrice = $data['concessionPrice'];
			}
			else if($pageName == 'searchBooking')
			{
				//Check there is a tournament currently open for registration or running
				$this->isCurrentTournament();
				if($this->tournament == null)
				{
					$this->addBasicView();
					require_once 'adminView/menu.php';
					require_once 'adminView/tickets_notournament.php';
					$this->addFooterFile();
					exit();
				}
				$days = array();
				$days = $this->tournament[0]->GetDays();
			}
			else if($pageName == 'bookingList')
			{
				if(isset($_POST['search']))
				{
					$query = "SELECT DISTINCT s.bookingId FROM ticket_sales s,ticket t WHERE s.bookingId = t.bookingId ";
					if(strcmp($_POST['searchby'],"surname") == 0)
					{
						$query = $query."AND s.surname LIKE '".htmlspecialchars($_POST['searchinput'])."%' ";
					}
					else if(strcmp($_POST['searchby'],"postcode") == 0)
					{
						$query = $query."AND s.postcode LIKE '".htmlspecialchars($_POST['searchinput'])."%' ";
					}
					else if(strcmp($_POST['searchby'],"bookingId") == 0)
					{
						$query = $query."AND s.bookingId LIKE '".htmlspecialchars($_POST['searchinput'])."' ";
					}
					
					if(strcmp($_POST['restrictions'],"postal") == 0)
					{
						$query = $query." AND t.methodOfSale = 'postal' ";
					}
					else if(strcmp($_POST['restrictions'],"pickup") == 0)
					{
						$query = $query." AND t.methodOfSale = 'pickup' ";
					}
					
					if(strcmp($_POST['date'],"") != 0)
					{
						$query = $query." AND t.dateOfTicket = '".htmlspecialchars($_POST['date'])."' ";
					}
					
					if(isset($_POST['uncollectedOnly']))
					{
						$query = $query." AND t.status <> 'COLLECTED' AND t.status <> 'POSTED' ";
					}
					$_SESSION['search_query'] = $query;
				}
				else
				{
					if(isset($_SESSION['search_query']))
					{
						$query = $_SESSION['search_query'];
					}
					else
					{
						$this->addBasicView();
						require_once 'adminView/menu.php';
						require_once 'adminView/searchBooking.php';
						$this->addFooterFile();
						exit();
					}	
				}
					$result = $this->db->query($query);
					if($result != false)
					{
						$bookings = array();
						$bookingDates = array();
						$i = 0;
						while($data = $result->fetch())
						{
							$book = new Booking($data['bookingId'],$this->db);
							$done = $book->getBooking();
							$bookings[$i] = $book;
							$dateResult = $this->db->query("SELECT DISTINCT dateOfTicket FROM ticket WHERE bookingID = '".$book->getBookingId()."'");
							$dateResult = $dateResult->fetch();
							$bookingDates[$i] = $dateResult['dateOfTicket'];
							$i++;
						}
						if($i == 0)
						{
							$this->addBasicView();
							require_once 'adminView/menu.php';
							require_once 'adminView/noBookings.php';
							$this->addFooterFile();
							exit();
						}
						$this->addBasicView();
						require_once 'adminView/menu.php';
						require_once 'adminView/bookingList.php';
						$this->addFooterFile();
						exit();
					}
			}
			else if($pageName == 'viewBooking')
			{
				if(isset($_GET['collect']))
				{
					if(strcmp($_GET['collect'],"all") == 0)
					{
						$result1 = $this->db->query("UPDATE ticket SET status = 'COLLECTED' WHERE bookingID = '".$_GET['id']."' AND methodOfSale = 'pickup'");
 						$result2 = $this->db->query("UPDATE ticket SET status = 'POSTED' WHERE bookingID = '".$_GET['id']."' AND methodOfSale = 'postal'");
					}
					else
					{
						$ticket = new Ticket($_GET['collect'],$this->db);
						$check = $ticket->getTicketDetails();
						if($check)
						{
							echo $ticket->getMethodOfSale();
							if(strcmp($ticket->getMethodOfSale(),"postal") == 0)
							{
								$ticket->setStatus("POSTED");
							}
							else
							{
								$ticket->setStatus("COLLECTED");
							}
						}
						$ticket->saveTicketDetails();
					}
				}
				$booking = new Booking(htmlspecialchars($_GET['id']),$this->db);
				$result = $booking->getBooking();
				if($result)
				{
					$tickets = array();
					$i = 0;
					$adultTickets = 0;
					$concessionTickets = 0;
					$complimentaryTickets = 0;
					$dateOfTicket = 0;
					$result = $this->db->query("SELECT ticketID FROM ticket WHERE bookingID = '".$booking->getBookingId()."'");
					if($result != false)
					{
						while($data = $result->fetch())
						{
							$ticket = new Ticket($data['ticketID'],$this->db);
							$check = $ticket->getTicketDetails();
							if($check)
							{
								$tickets[$i] = $ticket;
								if(strcmp($ticket->getType(),"adult") == 0)
								{
									$adultTickets++;
								}
								else if(strcmp($ticket->getType(),"complimentary") == 0)
								{
									$complimentaryTickets++;
								}
								else
								{
									$concessionTickets++;
								}
								$i++;
							}
							
						}
						
					}
					$this->addBasicView();
					require_once 'adminView/menu.php';
					require_once 'adminView/viewBooking.php';
					$this->addFooterFile();
				}
				else
				{
					$this->addBasicView();
					require_once 'adminView/menu.php';
					require_once 'adminView/noBookings.php';
					$this->addFooterFile();
				}
			}
			else if($pageName == 'teamTickets')
			{
				$this->isCurrentTournament();
				if($this->tournament == null)
				{
					$this->addBasicView();
                    require_once 'adminView/menu.php';
                    require_once 'adminView/wattBallNoTournament.php';
                    $this->addFooterFile();
                    die();
				}
				if(isset($_POST['teamTickets']))
				{
					$team = new Team($this->db,$_POST['team']);
					$check = $team->getTeamInfo();
					if($check)
					{
						if($team->getTicketsAllocated() == 0)
						{
							$properties = $this->db->query("SELECT * FROM properties");
							$properties = $properties->fetch();
							$result = $this->db->query("SELECT DISTINCT matchDate FROM wattball_matches WHERE team1='".$team->getTeamId()."' OR team2='".$team->getTeamId()."' AND tournamentID = '".$this->tournament[0]->getTournamentId()."'");
							if($result != false)
							{
								while($data = $result->fetch())
								{
									$booking = new Booking('0',$this->db);
									$booking->setSurname($team->getTeamName());
									$booking->setEmail($team->getEmail());
									$booking->createBooking();
									for($j = 0;$j < $properties['ticketsPerTeam'];$j++)
									{
										$ticket = new Ticket('0',$this->db);
										$ticket->setBookingId($booking->getBookingId());
										$ticket->setDate($data['matchDate']);
										$ticket->setType("complimentary");
										$ticket->setMethodOfSale("pickup");
										$ticket->createTicket();
									}
								}
								$team->setTicketsAllocated('1');
								if($team->updateTeamInfo())
								{
									$ticketsAllocated = true;
								}
								else
								{
									$error = "Error, Team Update Failed";
								}
							}
						}
						else
						{
							$error = "This Teams Tickets have already been allocated";
						}
					}
					else
					{
						$error = "Tickets have not been allocated as this Team does not Exist";
					}
				}
				
				$query = "SELECT teamId FROM wattball_team WHERE tournamentId = ".$this->tournament[0]->getTournamentId()." AND ticketsAllocated <> 1";
				$result = $this->db->query($query);
				if($result != false)
				{
					if($result->rowCount() > 0)
					{
						$teams = array();
						$i = 0;
						while($data = $result->fetch())
						{
							$team = new Team($this->db,$data['teamId']);
							$team->getTeamInfo();
							$teams[$i] = $team;
							$i++;
						}
						$this->addBasicView();
						require_once 'adminView/menu.php';
						require_once 'adminView/teamTickets.php';
						$this->addFooterFile();
						die();
					}
					else
					{
						$this->addBasicView();
						require_once 'adminView/menu.php';
						require_once 'adminView/allTicketsAllocated.php';
						$this->addFooterFile();
						die();
					}		
				}
				else
				{
					$this->addBasicView();
                    require_once 'adminView/menu.php';
                    require_once 'adminView/allTicketsAllocated.php';
                    $this->addFooterFile();
                    die();
				}
				
					
			}
            else if($pageName == 'staffManagement')
            {
				$this->getAllStaff();
			}
			else if($pageName == 'maleHurdles')
			{
				$this->gender = "Male";
				$this->getAllHurdlers("M");
				$this->addBasicView();
				require_once 'adminView/menu.php';
				require_once 'adminView/hurdles.php';
				$this->addFooterFile();
				return;
			}
			else if($pageName == 'femaleHurdles')
			{
				$this->gender = "Female";
				$this->getAllHurdlers("F");
				$this->addBasicView();
				require_once 'adminView/menu.php';
				require_once 'adminView/hurdles.php';
				$this->addFooterFile();
				return;
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
                    
                    $result = $this->db->query("SELECT * FROM wattball_matches");
                    $numberOfRows2 = $result->fetchColumn();
                    
                    if($numberOfRows < 1 || $numberOfRows2 > 0) //No tournament: Load a page said there are no tournament
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
                                                    ORDER BY 5 DESC");
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
                     if($pageName == "menHurdlesRegistration")
                     {
                        $result = $this->db->query("SELECT COUNT(*) FROM tournament WHERE registrationOpen <= CURDATE() AND registrationClose >= CURDATE() ORDER BY tournamentID DESC");
                        $numberOfRows = $result->fetchColumn();
                        if($numberOfRows < 1) //No tournament: Load a page said there are no tournament
                        {
                            $this->addBasicView();	
                            require_once 'view/login.php';
                            require_once 'view/menHurdleNav.php';
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
                            require_once 'view/menHurdleNav.php';
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
            else if($pageName == "femaleHurdlesRegistration")
            {
                $_SESSION['section'] = "femalehurdles";
				$result = $this->db->query("SELECT COUNT(*) FROM tournament WHERE registrationOpen <= CURDATE() AND registrationClose >= CURDATE() ORDER BY tournamentID DESC");
                        $numberOfRows = $result->fetchColumn();
                        if($numberOfRows < 1) //No tournament: Load a page said there are no tournament
                        {
                            $this->addBasicView();	
                            require_once 'view/login.php';
                            require_once 'view/femaleHurdleNav.php';
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
                            require_once 'view/femaleHurdleNav.php';
                            require_once 'view/'.$pageName.'.php';
                            require_once 'view/login.php';
                            $this->addFooterFile();
                            if(isset($_SESSION['error']))
                            {

                            }
                            die();
						}
				
                    //Processing of the Form in here
                    $this->addBasicView();
                    require_once 'view/femaleHurdleNav.php';
                    require_once 'view/'.$pageName.'.php';
                    require_once 'view/login.php';
                    $this->addFooterFile();
                die();
					
            }
            else if($pageName == "tickets" || $pageName == "ticketPurchase" || $pageName == "ticketCardDetails" || $pageName == "ticketingConfirmation")
            {
                    $_SESSION['section'] = "tickets";
                    if(strcmp($pageName,"ticketingConfirmation") == 0)
                    {
                            if(!isset($_POST['continunity']))
                            {
                                    $pageName = "tickets";
                            }
                            else
                            {
                                    if(!isset($_SESSION['booking']))
                                    {
                                            $ticketsRequired = $_POST['adult'] + $_POST['concession'];
                                            if($this->ticketCheck($_POST['ticketDate'],$ticketsRequired))
                                            {
                                                    $transaction = new Transaction('0',$this->db);
                                                    $transaction->setNameOnCard(htmlspecialchars($_POST['nameOnCard']));
                                                    $transaction->setCardNumber(htmlspecialchars($_POST['cardNo']));
                                                    $transaction->setCSCNumber(htmlspecialchars($_POST['csc']));
                                                    $transaction->setCardType(htmlspecialchars($_POST['cardType']));
                                                    $validuntil = htmlspecialchars($_POST['year'])."-".htmlspecialchars($_POST['month'])."-01";
                                                    $transaction->setValidUntil($validuntil);
                                                    $id = $transaction->createTransaction();
                                                    if($id == false)
                                                    {
                                                            print("Payment Failed");
                                                            exit();
                                                    }
                                                            $transaction->setTransactionID($id);

                                                            $booking = new Booking('0',$this->db);
                                                            $booking->setTransactionId($transaction->getTransactionID());
                                                            $booking->setFirstName(htmlspecialchars($_POST['firstname']));
                                                            $booking->setSurname(htmlspecialchars($_POST['surname']));
                                                            $booking->setAddress1(htmlspecialchars($_POST['address1']));
                                                            $booking->setAddress2(htmlspecialchars($_POST['address2']));
                                                            $booking->setEmail(htmlspecialchars($_POST['email']));
                                                            $booking->setCity(htmlspecialchars($_POST['city']));
                                                            $booking->setCounty(htmlspecialchars($_POST['county']));
                                                            $booking->setPostcode(htmlspecialchars($_POST['postcode']));
                                                            $booking->setTotalCost($this->ticketPrice($_POST['adult'],$_POST['concession']));
                                                            $transactionCost = $this->ticketPrice($_POST['adult'],$_POST['concession']);
                                                            $id = $booking->createBooking();
                                                            if($id == false)
                                                            {
                                                                    print("Booking Failed");
                                                                    exit();
                                                            }
                                                            $booking->setBookingId($id);
                                                            for($i = 0;$i < $_POST['adult'];$i++)
                                                            {
                                                                    $ticket = new Ticket('0',$this->db);
                                                                    $ticket->setBookingID($booking->getBookingId());
                                                                    $ticket->setDate($_POST['ticketDate']);
                                                                    $ticket->setType("adult");
                                                                    if(strcmp($_POST['collection'],"postal") == 0)
                                                                    {
                                                                            $ticket->setMethodOfSale("postal");
                                                                            $ticket->setStatus("NOT POSTED");
                                                                    }
                                                                    else
                                                                    {
                                                                            $ticket->setMethodOfSale("pickup");
                                                                            $ticket->setStatus("NOT COLLECTED");
                                                                    }
                                                                    $ticket->createTicket();
                                                            }

                                                            for($i = 0;$i < $_POST['concession'];$i++)
                                                            {
                                                                    $ticket = new Ticket('0',$this->db);
                                                                    $ticket->setBookingID($booking->getBookingId());
                                                                    $ticket->setDate($_POST['ticketDate']);
                                                                    $ticket->setType("concession");
                                                                    if(strcmp($_POST['collection'],"postal") == 0)
                                                                    {
                                                                            $ticket->setMethodOfSale("postal");
                                                                            $ticket->setStatus("NOT POSTED");
                                                                    }
                                                                    else
                                                                    {
                                                                            $ticket->setMethodOfSale("pickup");
                                                                            $ticket->setStatus("NOT COLLECTED");
                                                                    }
                                                                    $ticket->createTicket();
                                                            }
													$_SESSION['name'] = $booking->getFirstName()." ".$booking->getSurname();
													$_SESSION['email'] = $booking->getEmail();
													$_SESSION['date'] = $_POST['ticketDate'];
													$_SESSION['bookingId'] = $booking->getBookingId();
													$_SESSION['subject'] = "Ticket Booking Confirmation";
													$_SESSION['body'] = "Hi ".$_SESSION['name'].",<br /><br />This is to confirm that you have successfully booked for entry into the Riccarton Sports Centre on <span style='font-size:large'>".date('d-M-Y',strtotime($_SESSION['date']))."</span><br /><br />For your Information, your Booking ID is <span style='color:#FF0000'>".$booking->getBookingId()."</span><br /><br />";
													if($ticket->getMethodOfSale() == 'postal')
													{
														$_SESSION['body'] = $_SESSION['body']."Your tickets will be posted out to you around 5 days before the tournament starts!";
													}
													else
													{
														$_SESSION['body'] = $_SESSION['body']."Your tickets will be available for collection from the Sports Centre. Please bring this email to confirm that you are the owner of the booking";
													}
													require_once("include/email/sendEmail.php");
                                                    $_SESSION['booking'] = 1;
                                                    $this->addBasicView();
                                                    require_once 'view/ticketConfirmation.php';
                                                    require_once 'view/login.php';
                                                    $this->addFooterFile();
                                                    exit();
                                            }
                                            else
                                            {
                                                    $this->addBasicView();
                                                    require_once 'view/ticket_capacityCardDetails.php';
                                                    require_once 'view/login.php';
                                                    $this->addFooterFile();
                                                    exit();
                                            }
                                    }
                                    else
                                    {
                                                    $transactionCost = $this->ticketPrice($_POST['adult'],$_POST['concession']);
                                                    $this->addBasicView();
                                                    require_once 'view/ticketConfirmation.php';
                                                    require_once 'view/login.php';
                                                    $this->addFooterFile();
                                                    exit();
                                    }

                            }
                    }
            }	
            if(strcmp($pageName,"ticketCardDetails") == 0)
            {
                    if(!isset($_POST['continunity']))
                    {
                            $pageName = "tickets";
                    }
                    else
                    {
                            $ticketsRequired = $_POST['adult'] + $_POST['concession'];
                            if($this->ticketCheck($_POST['ticketDate'],$ticketsRequired))
                            {
                                    //Work out cost of tickets
                                    $transactionCost = $this->ticketPrice($_POST['adult'],$_POST['concession']);

                            }
                            else
                            {
                                    $this->addBasicView();
                                    require_once 'view/ticket_capacityCardDetails.php';
                                    require_once 'view/login.php';
                                    $this->addFooterFile();
                                    exit();
                            }
                    }
            }
            if($pageName == "ticketPurchase")
            {
                        if(isset($_GET['date']))
                        {
                                $result = $this->db->query("SELECT * FROM tournament WHERE startDate <= '".htmlspecialchars($_GET['date'])."' AND endDate >= '".htmlspecialchars($_GET['date'])."'");
                                $rowCount = $result->rowCount();
                                if($rowCount < 1)
                                {
                                        $pageName = "tickets";
                                }
                                else
                                {
                                        if($this->ticketCheck($_GET['date'],0))
                                        {
                                                //Grab Prices of Tickets
                                                $result = $this->db->query("SELECT * FROM properties");
                                                $result = $result->fetch();
                                                $adult_price = $result['adultPrice'];
                                                $concession_price = $result['concessionPrice'];
                                                //Let the Customer know how many tickets are left
                                                $ticketTotal = $this->ticketsRemaining($_GET['date']);
                                        }
                                        else
                                        {
                                                $this->addBasicView();
                                                require_once 'view/ticket_capacityReached.php';
                                                require_once 'view/login.php';
                                                $this->addFooterFile();
                                                exit();
                                        }
                                }
                        }
                        else
                        {
                                $pageName = "tickets";
                        }
            }
            if(strcmp($pageName,"tickets") == 0)
			{
               unset($_SESSION['booking']);
               $result = $this->db->query("SELECT * FROM tournament WHERE startDate > CURDATE() OR (startDate < CURDATE() AND endDate > CURDATE()) ORDER BY startDate ASC");
						$rowCount = $result->rowCount();
						if($result == false || $rowCount == 0)
                        {
                                $this->addBasicView();
                                require_once 'view/tickets_notournament.php';
                                require_once 'view/login.php';
                                $this->addFooterFile();
                                die();
                        }
                        $data = $result->fetch();
                        $tournament = new Tournament($data['tournamentID'],$data['name'],$data['startDate'],$data['endDate'],$data['registrationOpen'],$data['registrationClose'], $this->db);
                        $days = array();
                        $days = $tournament->GetDays();
                        $tournamentName = $tournament->getName();

                        $capacityResult = $this->db->query("SELECT * FROM properties");
                        $capacityResult = $capacityResult->fetch();
                        $capacity = $capacityResult['ticketLimit'];

                        $this->addBasicView();
                        require_once 'view/'.$pageName.'.php';
                        require_once 'view/login.php';
                        $this->addFooterFile();
                        die();
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
            $umpire = new Umpire($data['umpireID'], $data['umpireName'], $data['umpireEmail'], null, null, null, null, null, null, null, null, null, null, null, null, null, null, $this->db);
            $time = $data['matchTime'];
            $pitch = $data['pitch'];
            $matchResults->getTeamsInfo();
            $matchResults->getGoals();
            $matchResults->setMatchDate($data['date']);
            
            $report = $data['matchReport'];
            
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
        
        public function loadChangeTeamPage($teamID)
        {
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
            $pageName = "wattBall";    
            
            $team = new Team($this->db, $teamID);
            $team->getTeamInfo();
            $team->getPlayersInfo();
            
            $this->addBasicView();
            require_once 'adminView/menu.php';
            require_once 'adminView/changeTeam.php';
            $this->addFooterFile();
        }
        
        
        public function loadChangeTeamPlayersPage($teamID)
        {
            $_SESSION['section'] = "admin";
            $pageName = "wattBall"; 
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
            
            $request = $this->db->query("SELECT * FROM wattball_players WHERE teamID = $teamID ORDER BY playerName");
            $players = array();
            $i = 0;
            while ($data = $request->fetch())
            {
                $players[$i] = new Player($this->db);
                $players[$i]->setPlayerID($data['playerID']);
                $players[$i]->setPlayerName($data['playerName']);
                $i++;
            }
            
            $this->addBasicView();
            require_once 'adminView/menu.php';
            require_once 'adminView/changeTeamPlayers.php';
            $this->addFooterFile();
        }
        
        /**
         * Load the page with the next matches of a team
         * @param int $teamID
         */
        public function loadNextMatchesPage($teamID){
            
            $_SESSION['section'] = "wattBall";
            $pageName = "teams";
            $team = new Team($this->db, $teamID);
            $team->getTeamInfo();
            $team->getEvent();
            $matchesDone = $team->getMatchesDone();
            $matchesResults = array();
            $comingMatches = $team->getComingMatches();
            
            for($i=0;$i<count($matchesDone);$i++){
                $result = $this->db->query("SELECT * FROM wattball_results WHERE matchID = ".$matchesDone[$i]->getID());
                $data = $result->fetch();
                if($data != FALSE)
                {
                   $matchesResults[$i] = new Result($data['resultID'], new Team($this->db , $data['team1']) , new Team($this->db , $data['team2']) , $data['team1Score'] , $data['team2Score'] , $this->db);
                   $matchesResults[$i]->getGoals();
                }
            }
            
            $this->addBasicView();
            require_once 'view/wattBallNav.php';
            require_once 'view/nextMatches.php';
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
			$data['thursMorning'],$data['thursAfternoon'],$data['friMorning'],$data['friAfternoon'],$data['satMorning'],$data['satAfternoon'],$data['sunMorning'],$data['sunAfternoon'],$this->db);
			$i++;                                 
		}
	}
	
	/**
	 * search in the database all staff and put in an array
	 */
	public function getAllStaff()
	{
		$result = $this->db->query("SELECT `username`, `name`, `email`, `manager` FROM staff");
		$i = 0;
		while($data = $result->fetch())
		{
			$this->staff[$i] = new RealStaff($data['username'],$data['name'],$data['manager'],$data['email'], $this->db);
			$i++;                                 
		}
	}
	
	public function getAllHurdlers($gender)
	{
		$result = $this->db->query("SELECT * FROM hurdles_competitors WHERE hurdlerGender='$gender'");
		$i = 0;
		while($data = $result->fetch())
		{
			$hurdler = new Hurdles($this->db, $data['hurdlerID']);
			$hurdler->setHurdlerInfo($this->tournamentId, $data['hurdlerName'], $data['hurdlerLastName'], $data['dateOfBirth'], $data['houseNumber'], $data['streetName'], $data['city'], $data['postcode'], $data['email'], $data['contactNumber'], $data['hurdlerPerformance']);
			$this->allHurdlers[$i] = $hurdler;
			$i++;                                 
		}
	}
        
        /**
         * Find if there is a tournament now
         */
        public function isCurrentTournament($dateFormat = NULL)
        {
            //* Check if there is a current tournament
            if($dateFormat == NULL)
            {
                $result = $this->db->query("SELECT tournamentID, name, DATE_FORMAT(startDate,'%D %M %Y') AS startDate, DATE_FORMAT(endDate,'%D %M %Y') AS endDate,
				 DATE_FORMAT(registrationOpen,'%D %M %Y') AS registrationOpen, DATE_FORMAT(registrationClose,'%D %M %Y') AS registrationClose 
                                 FROM tournament WHERE registrationOpen < CURDATE() AND  endDate > CURDATE() ORDER BY startDate DESC");
            }
            else
            {
                 $result = $this->db->query("SELECT * 
                                 FROM tournament WHERE registrationOpen < CURDATE() AND  endDate > CURDATE() ORDER BY startDate DESC");
            }
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
        
        
        public function isTournamentStarted()
        {            
            if($this->isCurrentTournament(true))
            {
                $today = new DateTime(date("Y-m-d"));
                list($Y,$m,$d)=explode('-',  $this->tournament[0]->getStartDate());
                $startDate = new DateTime(Date("Y-m-d", mktime(0,0,0,$m,$d,$Y)));
                
                $today->format('Ymd');
                $startDate->format('Ymd');
                
                if($today < $startDate)
                    return false;
                else
                    return true;
            }
            
            return false;
        }
        
        
        public function findClosestTournament()
	{
		//* Check if there is a current tournament
		$result = $this->db->query("SELECT tournamentID, name, DATE_FORMAT(startDate,'%D %M %Y') AS startDate, DATE_FORMAT(endDate,'%D %M %Y') AS endDate,
				 DATE_FORMAT(registrationOpen,'%D %M %Y') AS registrationOpen, DATE_FORMAT(registrationClose,'%D %M %Y') AS registrationClose 
                                 FROM tournament WHERE registrationOpen < CURDATE() AND  endDate > CURDATE() ORDER BY startDate DESC");
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
        
        public function processChangeTeamDetails($teamName,$contactName,$contactNumber,$nwaNumber,$email)
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
                
                if(strlen($contactName) == 0)
                    $_SESSION['contactNameError'] = 1;
                
                if (!(preg_match("/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/", $email))) 
                {
                        $_SESSION['EmailError'] = 1;
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
            $teamName = mysql_real_escape_string($teamName);
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
        
        /**
         * Save the change of a team
         * @param int $teamID
         * @param String $teamName
         * @param String $contactName
         * @param String $contactNumber
         * @param String $nwaNumber
         * @param String $email
         * @param String $players
         */
        public function saveTeamChange($teamID,$teamName,$contactName,$contactNumber,$nwaNumber,$email)
        {
            $team = new Team($this->db, $teamID);
            $team->setTeamName($teamName);
            $team->setNwaNumber($nwaNumber);
            $team->setContactName($contactName);
            $team->setContactNumber($contactNumber);
            $team->setEmail($email);
            
            $request = $this->db->query("SELECT tournamentID FROM wattball_team WHERE teamID = $teamID");
            $data = $request->fetch();
            $team->setTournamentID($data['tournamentID']);
            $team->updateTeamInfo();
            
            
        }


		public function ticketCheck($date,$additional)
        {
			$result = $this->db->query("SELECT count(ticketID) AS total FROM ticket WHERE dateofTicket = '".htmlspecialchars($date)."'");
			$array = $result->fetch();
			$total = $array['total'] + $additional;
			$result = $this->db->query("SELECT * FROM properties");
			$result = $result->fetch();
			$capacity = $result['ticketLimit'];
			if($total < $capacity)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
		public function ticketsRemaining($date)
        {
			$result = $this->db->query("SELECT count(ticketID) AS total FROM ticket WHERE dateofTicket = '".$date."'");
			if($result != false)
			{
				$array = $result->fetch();
				$total = $array['total'];
				$result = $this->db->query("SELECT * FROM properties");
				$result = $result->fetch();
				$capacity = $result['ticketLimit'];
				$capacity = intval($result['ticketLimit']) - $total;
				return $capacity;
			}
		}
        
        public function ticketPrice($adult,$concession)
        {
			$result = $this->db->query("SELECT * FROM properties");
			$prices = $result->fetch();
			$ticketPrice = ($adult * $prices['adultPrice']) + ($concession * $prices['concessionPrice']);
			return $ticketPrice;
		}
		
		 public function processHurdleRegistration($firstname,$lastname,$gender,$dob,$houseno,$streetname,$city,$postcode,$emailcheck,$emcontact,$minutes,$seconds,$milliseconds,$tournamentId)
        {
        	$hurdleObject = new hurdles($this->db,null);
			$hurdleObject->setTournamentId($tournamentId);
        	$hurdleObject-> setFirstName($firstname);
        	$hurdleObject-> setLastName($lastname);
        	$hurdleObject-> setGender($gender);
        	$hurdleObject-> setDob($dob);
        	$hurdleObject-> setHouseNo($houseno);
        	$hurdleObject-> setStreetName($streetname);
        	$hurdleObject-> setCity($city);
        	$hurdleObject-> setPostCode($postcode);
        	$hurdleObject-> setEmail($emailcheck);
        	$hurdleObject-> setEmergencyContact($emcontact);
        	$milliseconds = $this->toMilliSeconds($minutes,$seconds,$milliseconds);
        	$hurdleObject-> setPerformanceTime($milliseconds);
        	
        	if($hurdleObject-> addTeamInfo())
       			return true;
       		else
       			return false;
         
        }
	
		public function toMilliSeconds($minutes,$seconds,$milliseconds) 
		{
			$total = 0;
			$total = $minutes * 60;
			$total = $total + $seconds;
			$total = $total * 1000;
			$total = $total + $milliseconds;
			return $total;
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
	
	public function getStaff()
	{
	    return $this->staff;
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
