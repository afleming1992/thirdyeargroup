<?php
	
	Class Transaction
	{
		private $transactionID;
		private $nameOnCard;
		private $cardNumber;
		private $cscNumber;
		private $cardType;
		private $validUntil;
		public $db;
		
		public function __construct($transactionId , $db)
		{
			$this->transactionID = $transactionId;     
			$this->db = $db;
		}
		
		public function createTransaction()
		{
			$result = $this->db->query("INSERT INTO transaction (nameOnCard,cardNumber,cscNumber,cardType,validUntil) VALUES ('".mysql_escape_string($this->nameOnCard)."','".mysql_escape_string($this->cardNumber)."','".mysql_escape_string($this->cscNumber)."','".$this->cardType."','".$this->validUntil."')");
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
		
		public function updateTransaction()
		{
			$result = $this->db->query("UPDATE transaction SET nameOnCard = '".mysql_escape_string($this->nameOnCard)."',cardNumber = '".$this->cardNumber."',cscNumber = '".$this->cscNumber."',cardType = '".$this->cardType."',validUntil = '".$this->validUntil."' WHERE transactionID = '".$this->transactionID."'");
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
		
		public function getTransactionID()
		{
			return $this->transactionID;
		}
		
		public function setTransactionID($transactionID)
		{
			$this->transactionID = $transactionID;
		}
		
		public function getNameOnCard()
		{
			return $this->nameOnCard;
		}
		
		public function setNameOnCard($input)
		{
			$this->nameOnCard = $input;
		}
		
		public function getCardNumber()
		{
			return $this->cardNumber;
		}
		
		public function setCardNumber($input)
		{
			$this->cardNumber = $input;
		}
		
		public function getCSCNumber()
		{
			return $this->cscNumber;
		}
		
		public function setCSCNumber($input)
		{
			$this->cscNumber = $input;
		}
		
		public function getCardType()
		{
			return $this->cardType;
		}
		
		public function setCardType($input)
		{
			$this->cardType = $input;
		}
		
		public function getValidUntil()
		{
			return $this->validUntil;
		}
		
		public function setValidUntil($input)
		{
			$this->validUntil = $input;
		}
		
		public function setdb($input)
		{
			$this->db = $input;
		}
		
		public function getdb()
		{
			return $this->db;
		}
	}
?>