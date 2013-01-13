
<?php

class Umpire
{
	private $umpireID,$umpireName,$umpireEmail,$monMorning,$monAfternoon,$tueMorning,$tueAfternoon,$wedMorning,
	$wedAfternoon,$thuMorning,$thuAfternoon,$friMorning,$friAfternoon,$satMorning,$satAfternoon,$sunMorning,$sunAfternoon;
	
	public function __construct($umpireID,$umpireName,$umpireEmail,$s0,$s1,$s2,$s3,$s4,$s5,$s6,$s7,$s8,$s9,$s10,$s11,$s12,$s13)
	{
		$this->setID($umpireID);
		$this->setName($umpireName);
		$this->setEmail($umpireEmail);
		$this->setMonMorning($s0);
		$this->setMonAfternoon($s1);
		$this->setTuesMorning($s2);
		$this->setTuesAfternoon($s3);
		$this->setWedMorning($s4);
		$this->setWedAfternoon($s5);
		$this->setThursMorning($s6);
		$this->setThursAfternoon($s7);
		$this->setFriMorning($s8);
		$this->setFriAfternoon($s9);
		$this->setSatMorning($s10);
		$this->setSatAfternoon($s11);
		$this->setSunMorning($s12);
		$this->setSunAfternoon($s13);
	}
	
	public function is_available($dayOfTheWeek, $morningOrAfternoon) 
	{
		$day = strtolower(mb_substr($dayOfTheWeek, 0, 3));
		$morningOrAfternoon = ucfirst(strtolower($morningOrAfternoon));
		$dayPeriod = $day . $morningOrAfternoon;
		if($this->$dayPeriod == 1)
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
	
	/*-------- GETTERS & SETTERS --------*/

	public function getID()
	{
	    return $this->umpireID;
	}

	public function setID($umpireID)
	{
	    $this->umpireID = $umpireID;
	}

	public function getName()
	{
	    return $this->umpireName;
	}

	public function setName($umpireName)
	{
	    $this->umpireName = $umpireName;
	}

	public function getEmail()
	{
	    return $this->umpireEmail;
	}

	public function setEmail($umpireEmail)
	{
	    $this->umpireEmail = $umpireEmail;
	}
	
	public function getMonMorning(){return $this->monMorning;}
	public function setMonMorning($monMorning){$this->monMorning = $monMorning;}
	
	public function getMonAfternoon(){return $this->monAfternoon;}
	public function setMonAfternoon($monAfternoon){$this->monAfternoon = $monAfternoon;}
	
	public function getTuesMorning(){return $this->tueMorning;}
	public function setTuesMorning($tuesMorning){$this->tueMorning = $tuesMorning;}
	
	public function getTuesAfternoon(){return $this->tueAfternoon;}
	public function setTuesAfternoon($tuesAfternoon){$this->tueAfternoon = $tuesAfternoon;}
	
	public function getWedMorning(){return $this->wedMorning;}
	public function setWedMorning($wedMorning){$this->wedMorning = $wedMorning;}
	
	public function getWedAfternoon(){return $this->wedAfternoon;}
	public function setWedAfternoon($wedAfternoon){$this->wedAfternoon = $wedAfternoon;}
	
	public function getThursMorning(){return $this->thuMorning;}
	public function setThursMorning($thursMorning){$this->thuMorning = $thursMorning;}
	
	public function getThursAfternoon(){return $this->thursAfternoon;}
	public function setThursAfternoon($thursAfternoon){$this->thursAfternoon = $thursAfternoon;}
	
	public function getFriMorning(){return $this->friMorning;}
	public function setFriMorning($friMorning){$this->friMorning = $friMorning;}
	
	public function getFriAfternoon(){return $this->friAfternoon;}
	public function setFriAfternoon($friAfternoon){$this->friAfternoon = $friAfternoon;}
	
	public function getSatMorning(){return $this->satMorning;}
	public function setSatMorning($satMorning){$this->satMorning = $satMorning;}
	
	public function getSatAfternoon(){return $this->satAfternoon;}
	public function setSatAfternoon($satAfternoon){$this->satAfternoon = $satAfternoon;}
	
	public function getSunMorning(){return $this->sunMorning;}
	public function setSunMorning($sunMorning){$this->sunMorning = $sunMorning;}
	
	public function getSunAfternoon(){return $this->sunAfternoon;}
	public function setSunAfternoon($sunAfternoon){$this->sunAfternoon = $sunAfternoon;}
	
}


?>
