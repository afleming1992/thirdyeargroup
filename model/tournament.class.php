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



        public function __construct($tournamentID,$name,$startDate,$endDate,$registerOpen,$registerClose,$type,$scheduled,$db)
	{
		$this->setTournamentID($tournamentID);
		$this->setStartDate($startDate);
		$this->setEndDate($endDate);
		$this->setRegisterOpen($registerOpen);
		$this->setRegisterClose($registerClose);
		$this->setName($name);
                $this->setType($type);
                $this->setScheduled($scheduled);
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
            $result = $this->db->query("SELECT COUNT(*) AS number FROM wattball_team wt JOIN tournament t ON t.tournamentID = wt.tournamentID WHERE t.type = 'WattBall' 
                AND wt.tournamentID =".$this->tournamentID);
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