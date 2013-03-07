<?php

class Tournament
{
	private $tournamentID;
	private $name;
	private $startDate;
	private $endDate;
	private $registerOpen;
	private $registerClose;
        private $type;
        private $scheduled;
        private $db;



    public function __construct($tournamentID,$name,$startDate,$endDate,$registerOpen,$registerClose,$db)
	{
		$this->setTournamentID($tournamentID);
		$this->setStartDate($startDate);
		$this->setEndDate($endDate);
		$this->setRegisterOpen($registerOpen);
		$this->setRegisterClose($registerClose);
		$this->setName($name);
		$this->db = $db;
	}
        
        public function getTeams()
        {
           $teams = array();
           $i = 0;
           $result = $this->db->query("SELECT * FROM wattball_team WHERE tournamentID = ".$this->tournamentID." ");
           while($data = $result->fetch())
           {
               $teams[$i] = new Team($this->db,$data['teamID']);
               $teams[$i]->getTeamInfo();
               $i++;
           }
           return $teams;
        }
        
        public function getNumberOfTeam()
        {
            $result = $this->db->query("SELECT COUNT(*) AS number FROM wattball_team wt JOIN tournament t ON t.tournamentID = wt.tournamentID WHERE wt.tournamentID =".$this->tournamentID);
            $data = $result->fetch();
            return $data['number'];
        }
        
        public function getNumberOfUmpire()
        {
            $result = $this->db->query("SELECT COUNT(*) AS number FROM umpire");
            $data = $result->fetch();
            return $data['number'];
        }
        
        public function nextDate($date)
        {
            list($Y,$m,$d)=explode('-',date($date));            
            return Date("Y-m-d", mktime(0,0,0,$m,$d+1,$Y));
        }
        
        public function getAllMatches()
        {
            $matches = array();
            $i = 0;
            $result = $this->db->query("SELECT matchID,DATE_FORMAT(matchDate,'%D %M %Y') as matchDate, matchDate as sqldate, matchTime,pitch,team1,team2,umpire
                                        FROM wattball_matches 
                                        WHERE tournamentID = ".$this->tournamentID."
                                        ORDER BY 3");
            while ($data = $result->fetch())
            {
                $matches[$i] = new Match($data['matchID'], $data['team1'], $data['team2'], $data['matchDate'], $data['matchTime'], $data['pitch'], $data['umpire'], $this->db);
                $i++;
            }
            return $matches;
        }
        
        public function getAllFinishedMatches()
        {
            $matches = array();
            $i = 0;
            
            $result = $this->db->query("SELECT matchID,DATE_FORMAT(matchDate,'%D %M %Y') as matchDate, matchTime,pitch,team1,team2,umpire
                                        FROM wattball_matches WHERE tournamentID = $this->tournamentID AND matchDate <= CURDATE()");
            
            
            while ($data = $result->fetch())
            {
                $m = new Match($data['matchID'], $data['team1'], $data['team2'], $data['matchDate'], $data['matchTime'], $data['pitch'],null, $this->db);
                $t1 = $m->getTeam1Info();
                $t2 = $m->getTeam2Info();
                $matches[$i]['match'] = $m;
                $matches[$i]['team1'] = $t1;
                $matches[$i]['team2'] = $t2;
                $matches[$i]['playersTeam1'] = $t1->getPlayersInfo();
                $matches[$i]['playersTeam2'] = $t2->getPlayersInfo();
                $i++;
            }
            return $matches;
        }
        
        public function is_scheduled() 
        {
            $result = $this->db->query("SELECT COUNT(*) AS nb FROM wattball_matches WHERE tournamentID =".$this->tournamentID);
            
             $data = $result->fetch();
             if($data["nb"] == 0)
               return false;
             else
               return true;
        }
	
	public function getDateSQLFormat($date)
	{
		$d = explode(" ", $date);
		
		$year = $d[2];
		switch ($d[1]) 
		{
			case 'January':
				$month = "01";
			break;
			case 'February':
				$month = "02";
			break;
			case 'March':
				$month = "03";
			break;
			case 'April':
				$month = "04";
			break;
			case 'May':
				$month = "05";
			break;
			case 'June':
				$month = "06";
			break;
			case 'July':
				$month = "07";
			break;
			case 'August':
				$month = "08";
			break;
			case 'September':
				$month = "09";
			break;
			case 'October':
				$month = "10";
			break;
			case 'November':
				$month = "11";
			break;
			case 'December':
				$month = "12";
			break;
			
		}
		
		if(substr($d[0], 0, -2)<10)
		{
			$day = "0"+substr($d[0], 0, -2);
		}
		else
			$day = substr($d[0], 0, -2);
		
		return "$year-$month-$day";
		
	}
	
	public function GetDays()
	{  
	  $day = 86400;
	  $format = "Y-m-d";
	  $startTime = strtotime($this->startDate);
	  $endTime = strtotime($this->endDate);
	  $numDays = round(($endTime - $startTime)/$day)+1;
	  $days = array();
	  
	  for($i = 0;$i<$numDays;$i++)
	  {
		$days[] = date($format,($startTime +($i * $day)));
	  }
	  
	  return $days;
	}
        
        
	
	
	/*-------- GETTERS & SETTERS --------*/

	public function getScheduled()
	{
	    return $this->scheduled;
	}

	public function setScheduled($scheduled)
	{
	    $this->scheduled = $scheduled;
	}
        
        public function getTournamentID()
	{
	    return $this->tournamentID;
	}

	public function setType($type)
	{
	    $this->type = $type;
	}
        
        public function getType()
	{
	    return $this->type;
	}

	public function setTournamentID($tournamentID)
	{
	    $this->tournamentID = $tournamentID;
	}

	public function getName()
	{
	    return $this->name;
	}

	public function setName($name)
	{
	    $this->name = $name;
	}

	public function getStartDate()
	{
	    return $this->startDate;
	}

	public function setStartDate($startDate)
	{
	    $this->startDate = $startDate;
	}

	public function getEndDate()
	{
	    return $this->endDate;
	}

	public function setEndDate($endDate)
	{
	    $this->endDate = $endDate;
	}

	public function getRegisterOpen()
	{
	    return $this->registerOpen;
	}

	public function setRegisterOpen($registerOpen)
	{
	    $this->registerOpen = $registerOpen;
	}

	public function getRegisterClose()
	{
	    return $this->registerClose;
	}

	public function setRegisterClose($registerClose)
	{
	    $this->registerClose = $registerClose;
	}
	
}


?>
