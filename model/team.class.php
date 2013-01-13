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

	/*--- Constructor ---*/
	public function __construct($db, $teamID)
	{
		$this->setDb($db);
                $this->setTeamID($teamID);
		$this->players = array();
	}

	/*--- Method Calls ---*/

	// Add New Team
	
	public function addTeamInfo()
	{
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
		$result = $this->db->query("UPDATE wattball_team SET tournamentID = '".$this->tournamentID."', contactName = '".$this->contactName."', contactNumber = '".$this->contactNumber."', NWANumber = '".$this->nwaNumber."', email = '".$this->email."' WHERE teamID = '".$this->teamID."'");
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

	/* ----- GETTERS AND SETTERS ----- */

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
