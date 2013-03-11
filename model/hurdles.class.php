<?php

class Hurdles
{
	private $hurdlerId;
	private $firstName;
	private $lastName;
	private $gender;
	private $dob;
	private $houseNo;
	private $streetName;
	private $city;
	private $postCode;
	private $email;
	private $emContact;
	private $minutes;
	private $seconds;
	private $milliseconds;
	private $db;

	public function __construct($db, $hurdlerId)
	{
		$this->setDb($db);
            $this->sethurdlerId($hurdlerId);
	}
	
	
	public function addTeamInfo()
	{
		$result = $this->db->query("INSERT INTO hurdles_competitors (hurdlerName,hurdlerlastName,hurdlerGender,dateOfBirth,houseNumber,streetName,city,postcode,email,contactNumber,hurdlerPerformance) VALUES ('".$this->firstName."','".$this->lastName."','".$this->gender."','".$this->dob."','".$this->houseNo."','".$this->streetName."','".$this->city."','".$this->postCode."','".$this->email."','".$this->emContact."','".$this->performanceTime."')");
		if($result != false){
			return true; 
		} else {
			return false;
		}
	}
	
	
	/* ----- GETTERS AND SETTERS ----- */
	
	public function getHurdlerId()
	{
			return $this->firstName;
	}
	
	public function setHurdlerId($hurdlerId)
	{
		$this->hurdlerId = $hurdlerId;
	}

	public function setFirstName($firstName)
	{
		$this->firstName = $firstName;
	}
	
	public function getFirstName()
	{
			return $this->firstName;
	}

	public function getLastName()
	{
			return $this->lastName;
	}

	public function setLastName($lastName)
	{
		$this->lastName = $lastName;
	}
	
	public function getGender()
	{
			return $this->gender;
	}

	public function setGender($gender)
	{
		$this->gender = $gender;
	}

	public function getDob()
	{
			return $this->dob;
	}

	public function setDob($dob)
	{
		$this->dob = $dob;
	}

	public function getHouseNo()
	{
			return $this->houseNo;
	}

	public function setHouseNo($houseNo)
	{
		$this->houseNo = $houseNo;
	}

	public function getStreetName()
	{
			return $this->streetName;
	}

	public function setStreetName($streetName)
	{
		$this->streetName = $streetName;
	}

	public function getCity()
	{
			return $this->city;
	}

	public function setCity($city)
	{
		$this->city = $city;
	}

	public function getPostCode()
	{
			return $this->postCode;
	}

	public function setPostCode($postCode)
	{
		$this->postCode = $postCode;
	}
	
	public function getEmail()
	{
			return $this->email;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}
	
	public function getEmergencyContact()
	{
			return $this->emContact;
	}

	public function setEmergencyContact($emContact)
	{
		$this->emContact = $emContact;
	}
	
	public function getMinutes()
	{
			return $this->minutes;
	}

	public function setMinutes($minutes)
	{
		$this->minutes = $minutes;
	}
	
	public function getSeconds()
	{
			return $this->seconds;
	}

	public function setSeconds($seconds)
	{
		$this->seconds = $seconds;
	}
	
	public function getMilliSeconds()
	{
			return $this->milliseconds;
	}

	public function setMilliSeconds($milliseconds)
	{
		$this->milliseconds = $milliseconds;
	}
	
	public function getPerformanceTime()
	{
			return $this->performanceTime;
	}

	public function setPerformanceTime($performanceTime)
	{
		$this->performanceTime = $performanceTime;
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