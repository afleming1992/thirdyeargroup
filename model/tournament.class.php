<?php

class Tournament
{
	private $tournamentID;
	private $name;
	private $startDate;
	private $endDate;
	private $registerOpen;
	private $registerClose;
	
	
	public function __construct($tournamentID,$name,$startDate,$endDate,$registerOpen,$registerClose)
	{
		$this->setTournamentID($tournamentID);
		$this->setStartDate($startDate);
		$this->setEndDate($endDate);
		$this->setRegisterOpen($registerOpen);
		$this->setRegisterClose($registerClose);
		$this->setName($name);
	}
	
	
	
	/*-------- GETTERS & SETTERS --------*/

	public function getTournamentID()
	{
	    return $this->tournamentID;
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