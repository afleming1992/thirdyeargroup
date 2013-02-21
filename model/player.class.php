<?php
	
	class Player
	{
		private $playerID;
		private $teamID;
		private $playerName;
		private $db;
                private $numberOfGoal;
		
		/** --- CONSTRUCTORS --- **/
		
		public function __construct($db)
		{
			$this->db = $db;
		}
		
		/** -- METHODS -- **/
		
		public function addPlayerInfo()
		{
			$result = $this->db->exec("INSERT INTO wattball_players (teamID,playerName) VALUES ('".$this->teamID."','".$this->playerName."')");
			if($result != false)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
		public function getPlayerInfo()
		{
			$result=$this->db->query("SELECT * FROM wattball_players WHERE playerID='".$this->playerID."'");
			if ($result!=false)
			{
				while($data = $result->fetch())
				{
					$this->setTeamID($data['teamID']);
					$this->setPlayerName($data['playerName']);
				}
				return true;
			}
			else
				return false;
		}
		
		public function updatePlayerInfo()
		{
			$result = $this->db->query("UPDATE wattball_players SET teamID = '".$this->teamID."', playerName = '".$this->playerName."' WHERE playerID = '".$this->playerID."'");
			if($result != false)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
                
                public function getNumberOfGoal()
                {
                    $result = $this->db->query("SELECT COUNT(*) AS nb FROM wattball_goals WHERE playerID =".$this->playerID);
                    $data = $result->fetch();
                    $this->numberOfGoal = $data['nb'];
                }


                public function saveGoals($matchID,$minute)
                {
                    $this->db->exec("INSERT INTO wattball_goals(matchID,minute,playerID) VALUES($matchID,$minute,".$this->playerID.")");
                }
                
		/** --- GETTERS AND SETTERS --- **/
                
                public function getGoal()
		{
			return $this->numberOfGoal;
		}
		
		public function setGoal($number)
		{
			$this->numberOfGoal = $number;
		}
		
		public function getPlayerID()
		{
			return $this->playerID;
		}
		
		public function setPlayerID($playerID)
		{
			$this->playerID = $playerID;
		}
		
		public function getTeamID()
		{
			return $this->teamID;
		}
		
		public function setTeamID($teamID)
		{
			$this->teamID = $teamID;
		}
			
		public function getPlayerName()
		{
			return $this->playerName;
		}
		
		public function setPlayerName($playerName)
		{
			$this->playerName = $playerName;
		}
        }			
?>
