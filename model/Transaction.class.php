<?php
	
	Class Transaction
	{
		private $transactionID;
		private $nameOnCard;
		private $cardNumber;
		private $cscNumber;
		private $cardType;
		private $validUntil;
		private $db;
		
		public function __construct($transactionId , $db)
		{
			$this->transactionID = $transactionId;     
			$this->db = $db;
		}
		
		public function createTransaction()
		{
			$result = $this-db->query("INSERT INTO transaction (nameOnCard,cardNumber,cscNumber,cardType,validUntil) VALUES ('".$this->nameOnCard."','".$this->nameOnCard."','".$this->cardNumber."','".$this->cscNumber."','".$this->cardType."','".$this->validUntil."')");
			if($result == true)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
		public function updateTransaction()
		{
			$result = $this->db->query("UPDATE transaction SET nameOnCard = '".$this->nameOnCard."',cardNumber = '".$this->cardNumber."',cscNumber = '".$this->cscNumber."',cardType = '".$this->cardType."',validUntil = '".$this->validUntil."' WHERE transactionID = '".$this->transactionID."'");
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
		
		public function setTransactionID($transactionID);
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
			return $this->cscNumber
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