<?php
Class Booking
{
	private $bookingId;
	private $transactionId;
	private $firstName;
	private $surname;
	private $email;
	private $address1;
	private $address2;
	private $city;
	private $county;
	private $postcode;
	private $totalCost;
	private $db;
	
	public function __construct($bookingId , $db)
    {
        $this->bookingId = $bookingId; 		
        $this->db = $db;
		$this->tickets = array();
		$this->lastArrayPos = 0;
    }
    
    public function createBooking()
    {
		$query = "INSERT INTO ticket_sales (transactionID,firstName,surname,email,address1,address2,city,county,postcode,totalCost) VALUES ('".$this->transactionId."','".mysql_escape_string($this->firstName)."','".mysql_escape_string($this->surname)."','".$this->email."','".mysql_escape_string($this->address1)."','".mysql_escape_string($this->address2)."','".mysql_escape_string($this->city)."','".mysql_escape_string($this->county)."','".$this->postcode."','".$this->totalCost."')";
		
		$result = $this->db->query("INSERT INTO ticket_sales (transactionID,firstName,surname,email,address1,address2,city,county,postcode,totalCost) VALUES ('".mysql_escape_string($this->transactionId)."','".mysql_escape_string($this->firstName)."','".mysql_escape_string($this->surname)."','".mysql_escape_string($this->email)."','".mysql_escape_string($this->address1)."','".mysql_escape_string($this->address2)."','".mysql_escape_string($this->city)."','".mysql_escape_string($this->county)."','".$this->postcode."','".$this->totalCost."')");
		if($result != false)
		{
			$result = $this->db->query("SELECT LAST_INSERT_ID() AS id");
			$data = $result->fetch();
			$this->bookingId = $data['id'];
			return $this->bookingId;
		}
		else
		{
			return false;
		}
	}
	
	 public function updateBooking()
    {
		$result = $this->db->query("UPDATE ticket_sales SET transactionID = '".$this->transactionId."',name = '".mysql_escape_string($this->name)."',email = '".$this->email."',address1 = '".mysql_escape_string($this->address1)."',address2 = '".mysql_escape_string($this->address2)."',city = '".mysql_escape_string($this->city)."',county = '".mysql_escape_string($this->county)."',postcode = '".$this->postcode."',totalCost = '".$this->totalCost."' WHERE bookingId = '".$this->bookingId."')");
		if($result == true)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function getBooking()
	{
		$result = $this->db->query("SELECT * FROM ticket_sales WHERE bookingId = ".$this->bookingId);
		if($result != false)
		{
			$data = $result->fetch();
			$this->transactionId = $data['transactionID'];
			$this->firstName = $data['firstName'];
			$this->surname = $data['surname'];
			$this->email = $data['email'];
			$this->address1 = $data['address1'];
			$this->address2 = $data['address2'];
			$this->city = $data['city'];
			$this->county = $data['county'];
			$this->postcode = $data['postcode'];
			$this->totalCost = $data['totalCost'];
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Getters and Setters
	public function setBookingId($input)
	{
		$this->bookingId = $input;
	}
	
	public function getBookingId()
	{
		return $this->bookingId;
	}
	
	public function getTransactionId()
	{
		return $this->transactionId;
	}
	
	public function setTransactionId($trans)
	{
		$this->transactionId = $trans;
	}
	
	public function getSurname()
	{
		return $this->surname;
	}
    
    public function setSurname($name)
	{
		$this->surname = $name;
	}
	
	public function getFirstName()
	{
		return $this->firstName;
	}
    
    public function setFirstName($name)
	{
		$this->firstName = $name;
	}
	
	public function getAddress1()
	{
		return $this->address1;
	}
   
	public function setAddress1($input)
	{
		$this->address1 = $input;
	}
	
	public function getAddress2()
	{
		return $this->address2;
	}
   
	public function setAddress2($input)
	{
		$this->address2 = $input;
	}
	
	public function getCity()
	{
		return $this->city;
	}
   
	public function setCity($input)
	{
		$this->city = $input;
	}
	
	public function getCounty()
	{
		return $this->county;
	}
   
	public function setCounty($input)
	{
		$this->county = $input;
	}
	
	public function getPostcode()
	{
		return $this->postcode;
	}
   
	public function setPostcode($input)
	{
		$this->postcode = $input;
	}
	
	public function getTotalCost()
	{
		return $this->totalCost;
	}
	
	public function setTotalCost($input)
	{
		$this->totalCost = $input;
	}
	
	public function getEmail()
	{
		return $this->email;
	}
	
	public function setEmail($input)
	{
		$this->email = $input;
	}
	
	public function getDb()
	{
		return $this->db;
	}
	
	
}
?>
	
