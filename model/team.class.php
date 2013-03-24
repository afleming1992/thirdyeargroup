<?php

class Team
{
        private $teamID;
        private $teamName;
        private $tournamentID;
        private $contactName;
        private $contactNumber;
        private $nwaNumber;
        private $email;
        private $db;
        
        private $players;
        
        private $won;
        private $lost;
        private $drawn;
        private $goalFor;
        private $goalAgainst;
        private $goalDifference;
        private $matchPoint;
        private $teamranking;
        
        private $matchesDone;
        private $comingMatches;

        
        /*--- Constructor ---*/
	public function __construct($db, $teamID)
	{
		$this->setDb($db);
                $this->setTeamID($teamID);
		$this->players = array();
	}

	// Add New Team
        
	public function addTeamInfo()
	{
            $this->teamName = mysql_escape_string($this->teamName);
            $this->contactName = mysql_escape_string($this->contactName);
		$result = $this->db->query("INSERT INTO wattball_team VALUES ('0','$this->tournamentID','$this->teamName','$this->contactName','$this->contactNumber','$this->nwaNumber','$this->email')");
		if($result != false)
		{
			return true;
		}
		else
		{
			return $result;
		}
	}
	// Update Team
	public function updateTeamInfo()
	{
		$result = $this->db->query("UPDATE wattball_team SET tournamentID = '".$this->tournamentID."', contactName = '".mysql_escape_string($this->contactName)."', contactNumber = '".$this->contactNumber."', NWANumber = '".$this->nwaNumber."', email = '".$this->email."' WHERE teamID = '".$this->teamID."'");
		if($result != false)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	// Get Team Details
	public function getTeamInfo()
	{
		//$result =$this->db->query("SELECT * FROM wattball_team SET teamName='".$this->teamName."'"); OLD VERSION
                $result =$this->db->query("SELECT * FROM wattball_team WHERE teamID = ".$this->teamID);
		if ($result!=false)
		{
			while($data = $result->fetch())
			{
				$this->setTeamName($data['teamName']);
				$this->setTournamentID($data['tournamentID']);
				$this->setContactName($data['contactName']);
				$this->setContactNumber($data['contactNumber']);
				$this->setNwaNumber($data['NWANumber']);
				$this->setEmail($data['email']);
			}
			return true;
		}
		else
			return false;
	}
        
        public function getPlayersInfo()
        {
            $players = array();
            $i = 0;
            $result =$this->db->query("SELECT * FROM wattball_players WHERE teamID = ".$this->teamID);
            
            while($data = $result->fetch())
            {
                $players[$i] = new Player($this->db);
                $players[$i]->setPlayerID($data['playerID']);
                $players[$i]->setPlayerName($data['playerName']);
                $players[$i]->setTeamID($data['teamID']);
                $players[$i]->getNumberOfGoal();
                $i++;
            }
            $this->players = $players;
            return $players;
        }
        
        public function getEvent()
        {
            $request = $this->db->query("SELECT *,DATE_FORMAT(matchDate,'%D %M %Y') as date FROM wattball_matches WHERE matchDate < CURDATE() AND (team1 =".$this->teamID." OR team2 =".$this->teamID.")");
            $data = $request->fetchAll();
            $this->matchesDone = array();
            $i = 0;
            if($data != FALSE)
            {
                foreach($data as $d)
                {
                    $team1 = new Team($this->db, $d['team1']);
                    $team1->getTeamInfo();
                    $team2 = new Team($this->db, $d['team2']);
                    $team2->getTeamInfo();
                    $this->matchesDone[$i] = new Match($d['matchID'], $team1, $team2, $d['date'], $d['matchTime'], $d['pitch'], $d['umpire'], $this->db);
                    $i++;
                }
            }
            
            $request2 = $this->db->query("SELECT *,DATE_FORMAT(matchDate,'%D %M %Y') as date FROM wattball_matches WHERE matchDate > CURDATE() AND (team1 =".$this->teamID." OR team2 =".$this->teamID.")");
            $data2 = $request2->fetchAll();
            $this->comingMatches = array();
            $j = 0;
            if($data2 != FALSE)
            {
                foreach($data2 as $d2)
                {
                    $team1 = new Team($this->db, $d2['team1']);
                    $team1->getTeamInfo();
                    $team2 = new Team($this->db, $d2['team2']);
                    $team2->getTeamInfo();
                    $this->comingMatches[$j] = new Match($d2['matchID'], $team1, $team2, $d2['date'], $d2['matchTime'], $d2['pitch'], $d2['umpire'], $this->db);
                    $j++;
                }
            }
        }


        public function getRanking()
        {
            $request = $this->db->query("SELECT * FROM wattball_ranking WHERE teamID = ".$this->teamID);           
            $data = $request->fetch();
            if($data != FALSE)
            {
                $this->won = $data['won'];
                $this->lost = $data['lost'];
                $this->drawn = $data['drawn'];
                $this->matchPoint = $data['matchPoint'];
                $this->goalFor = $data['goalsFor'];
                $this->goalAgainst = $data['goalsAgainst'];
                $this->goalDifference = $data['goalDifference'];
                $r = new Ranking($this->db);
                $r->ranking();
                $this->teamranking = $r->getRanking($this->teamID);
                return TRUE;
            }
            else
                return FALSE;
        }        

	/* ----- GETTERS AND SETTERS ----- */
        
        public function getTeamranking() {
            return $this->teamranking;
        }

        public function setTeamranking($Teamranking) {
            $this->teamranking = $Teamranking;
        }
        
        public function getPlayers() {
            return $this->players;
        }

        public function setPlayers($players) {
            $this->players = $players;
        }

        public function getWon() {
            return $this->won;
        }

        public function setWon($won) {
            $this->won = $won;
        }

        public function getLost() {
            return $this->lost;
        }

        public function setLost($lost) {
            $this->lost = $lost;
        }

        public function getDrawn() {
            return $this->drawn;
        }

        public function setDrawn($drawn) {
            $this->drawn = $drawn;
        }

        public function getGoalFor() {
            return $this->goalFor;
        }

        public function setGoalFor($goalFor) {
            $this->goalFor = $goalFor;
        }

        public function getGoalAgainst() {
            return $this->goalAgainst;
        }

        public function setGoalAgainst($goalAgainst) {
            $this->goalAgainst = $goalAgainst;
        }

        public function getGoalDifference() {
            return $this->goalDifference;
        }

        public function setGoalDifference($goalDifference) {
            $this->goalDifference = $goalDifference;
        }

        public function getMatchPoint() {
            return $this->matchPoint;
        }

        public function setMatchPoint($matchPoint) {
            $this->matchPoint = $matchPoint;
        }
        
        public function getMatchesDone()
	{
                return $this->matchesDone;
	}

	public function setMatchesDone($matches)
	{
		$this->matchesDone = $matches;
	}
        
        public function getComingMatches()
	{
                return $this->comingMatches;
	}

	public function setComingMatches($matches)
	{
		$this->comingMatches = $matches;
	}
        
	public function getTeamId()
	{
			return $this->teamID;
	}

	public function setTeamID($teamID)
	{
		$this->teamID = $teamID;
	}

	public function getTeamName()
	{
			return $this->teamName;
	}

	public function setTeamName($teamName)
	{
		$this->teamName = $teamName;
	}

	public function getTournamentID()
	{
			return $this->tournamentID;
	}

	public function setTournamentID($tournamentID)
	{
		$this->tournamentID = $tournamentID;
	}

	public function getContactName()
	{
			return $this->contactName;
	}

	public function setContactName($contactName)
	{
		$this->contactName = $contactName;
	}

	public function getContactNumber()
	{
			return $this->contactNumber;
	}

	public function setContactNumber($contactNumber)
	{
		$this->contactNumber = $contactNumber;
	}

	public function getNwaNumber()
	{
			return $this->nwaNumber;
	}

	public function setNwaNumber($nwaNumber)
	{
		$this->nwaNumber = $nwaNumber;
	}

	public function getEmail()
	{
			return $this->email;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function getDb()
	{
		   return $this->db;
	}

	public function setDb($db)
	{
			$this->db = $db;
	}
}
	
?>
