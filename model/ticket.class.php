<?php


Class Ticket
{
	private $id;
	private $bookingId;
	private $methodOfSale;
	private $dateOfTicket;
	private $status;
	private $type;
	private $db;
	
	public function __construct($id, $db)
    {
        $this->id = $id;  
        $this->db = $db;
    }
    
    public function getTicketDetails
    {
		$result = $this->db->query("SELECT * FROM ticket WHERE ticketID = '".$this->id."'");
		if($data = $result->fetch())
		{
			$bookingId = $data['bookingID'];
			$methodOfSale = $data['methodOfSale'];
			$dateOfTicket = $data['dateOfTicket'];
			$status = $data['status'];
			$type = $data['type'];
		}
	}
	
	public function createTicket()
	{
		$result = $this->db->query("INSERT INTO ticket (bookingID,methodOfSale,dateOfTicket,status,type) VALUES ('".$this->bookingId."','".$this->methodOfSale."','".$this->dateOfTicket."','".$this->status"','".$this->type."')");
		if($result == true)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	
	public function saveTicketDetails()
	{
		$result = $this->db->query("UPDATE ticket SET bookingId = '".$this->bookingId."',methodOfSale = '".$this->methodOfSale."',dateOfTicket = '".$ticket->dateOfTicket."',status = '".$this->status."','type='".$this->type."' WHERE ticketID = '".$this->id."'");
		if($result == true)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function getTicketId()
	{
		return $this->id;
	}
	
	public function getBookingId()
	{
		return $this->bookingId;
	}
	
	public function getMethodOfSale()
	{
		return $this->getMethodOfSale;
	}
	
	public function getDate()
	{
		return $this->getDate;
	}
	
	public function getStatus()
	{
		return $this->status;
	}
	
	public function getType()
	{
		return $this->type;
	}
	
	public function setType()
	{
		$this->type = type;
	}
}

?>

