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
		$result = $this->db->query("INSERT INTO ticket_sales (transactionID,firstName,surname,email,address1,address2,city,county,postcode) VALUES ('".$this->transactionId."','".$this->firstName."','".$this->surname."','".$this->email."','".$this->address1."','".$this->address2."','".$this->city."','".$this->county."','".$this->postcode."')");
		if($result == true)
		{
			$result = $this->db->query("select last_insert_id() as lastId");
			$lastId = $result->fetch();
			return $lastId['lastId'];
		}
		else
		{
			return false;
		}
	}
	
	 public function updateBooking()
    {
		$result = $this->db->query("UPDATE ticket_sales SET transactionID = '".$this->transactionId."',name = '".$this->name."',email = '".$this->email."',address1 = '".$this->address1."',address2 = '".$this->address2."',city = '".$this->city."',county = '".$this->county."',postcode = '".$this->postcode."' WHERE bookingId = '".$this->bookingId."')");
		if($result == true)
		{
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
		return $this->name;
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
	
