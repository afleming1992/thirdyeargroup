<?php
Class Booking
{
	private $bookingId;
	private $transactionId;
	private $name;
	private $email;
	private $address1;
	private $address2;
	private $city;
	private $county;
	private $postcode;
	private $tickets; //Array to store all ticket objects under this booking
	private $db;
	
	public function __construct($bookingId , $db)
    {
        $this->bookingId = $bookingId;     
        $this->db = $db;
    }
    
    public function createBooking();
    {
		$result = $this->db->query("INSERT INTO ticket_sales (transactionID,name,email,address1,address2,city,county,postcode) VALUES ('".$this->transactionId."','".$this->name."','".$this->email."','".$this->address1"','".$this->address2."','".$this->city."','".$this->county,"','".$this->postcode."')");
		if($result == true)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	 public function updateBooking();
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
	
	public function getTransactionId();
	{
		return $this->transactionId;
	}
	
	public function setTransactionId($trans);
	{
		$this->transactionId = $tras;
	}
	
	public function getName()
	{
		return $this->name;
	}
    
    public function setName($name)
	{
		$this->name = $name;
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
	
	public function getPostcode()
	{
		return $this->postcode;
	}
   
	public function setPostcode($input)
	{
		$this->postcode = $input;
	}
}
?>
	
