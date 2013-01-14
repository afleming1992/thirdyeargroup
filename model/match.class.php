<?php

Class Match
{
    private $id;
    private $team1;
    private $team2;
    private $date;
    private $hour;
    private $pitch;
    private $umpire;
    
    private $db;
    
    
    public function __construct($id, $team1,$team2,$date,$hour,$pitch,$umpire, $db)
    {
        $this->db = $db;
        $this->id = $id;
        $this->team1 = $team1;
        $this->team2 = $team2;
        $this->date = $date;
        $this->hour = $hour;
        $this->pitch = $pitch;
        $this->umpire = $umpire;
        
    }
    
    public  function saveMatch($tournamentID)
    {
       
       if($this->hour == "morning")
           $time = "10am";
       else if($this->hour == "afternoon")
           $time = "2pm";
       
       $this->db->exec("INSERT INTO wattBall_matches(tournamentID,matchDate,matchTime,pitch,team1,team2,umpire) VALUES($tournamentID,'".$this->date."','$time',".$this->pitch.",
                ".$this->team1->getTeamId().",".$this->team2->getTeamId().",".$this->umpire->getID().")");
    }
    
    public function getTeam1Info()
    {        
        $result = $this->db->query("SELECT * FROM wattBall_team WHERE teamID = ".$this->team1);
        $data = $result->fetch();
        $team1 = new Team($this->db, $data['teamID']);
        $team1->getTeamInfo();
        return $team1;
    }
    
    public function getTeam2Info()
    {        
        $result = $this->db->query("SELECT * FROM wattBall_team WHERE teamID = ".$this->team2);
        $data = $result->fetch();
        $team2 = new Team($this->db, $data['teamID']);
        $team2->getTeamInfo();
        return $team2;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function setTeam1($team1)
    {
        $this->team1 = $team1;
    }
    
    public function setTeam2($team2)
    {
        $this->team2 = $team2;
    }
    
    public function setDate($date)
    {
        $this->date = $date;
    }
    
    public function setHour($hour)
    {
        $this->hour = $hour;
    }
    
    public function setPitch($pitch)
    {
        $this->pitch = $pitch;
    }
    
    public function setUmpire($umpire)
    {
        $this->umpire = $umpire;
    }
    
    
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getTeam1()
    {
        return $this->team1;
    }
    
    public function getTeam2()
    {
        return $this->team2;
    }
    
    public function getDate()
    {
        return $this->date;
    }
    
    public function getHour()
    {
        return $this->hour;
    }
    
    public function getPitch()
    {
        return $this->pitch;
    }
    
    public function getUmpire()
    {
        return $this->umpire;
    }
            
}
?>
