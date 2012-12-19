<?php
	
	class Player
	{
		private $playerID;
		private $teamID;
		private $playerName;
		private $db;
		
		/** --- CONSTRUCTORS --- **/
		
		public function __construct($db)
		{
			$this->setDb($db);
		}
		
		/** -- METHODS -- **/
		
		
		
		/** --- GETTERS AND SETTERS --- **/
		
		public function getPlayerID()
		{
			return $this->playerID;
		}
		
		public function setPlayerID($playerID)
		{
			$this->playerID = $playerID;
		}
		
		public function getTeamID()
		{
			return $this->teamID;
		}
		
		public function setTeamID($teamID)
		{
			$this->teamID = $teamID;
		}
			
		public function getPlayerName()
		{
			return $this->playerName;
		}
		
		public function setPlayerName($playerName)
		{
			$this->playerName = $playerName;
		}
			
