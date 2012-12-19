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

public function setContactName($contactNumber)
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
	
?>
