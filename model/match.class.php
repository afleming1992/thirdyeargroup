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
    
    /**
     *
     * @var Database
     */
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
       
       $this->db->exec("INSERT INTO wattball_matches(tournamentID,matchDate,matchTime,pitch,team1,team2,umpire) VALUES($tournamentID,'".$this->date."','$time',".$this->pitch.",
                ".$this->team1->getTeamId().",".$this->team2->getTeamId().",".$this->umpire->getID().")");
    }
    
    public function getTeam1Info()
    {      
        if(is_object($this->team1))
        {
                $result = $this->db->query("SELECT * FROM wattball_team WHERE teamID = ".$this->team1->getTeamId());
        }
        else
        {
                $result = $this->db->query("SELECT * FROM wattball_team WHERE teamID = ".$this->team1);
        }
        $data = $result->fetch();
        $team1 = new Team($this->db, $data['teamID']);
        $team1->getTeamInfo();
        return $team1;
    }
    
    public function getTeam2Info()
    {       
		if(is_object($this->team2))
		{
			$result = $this->db->query("SELECT * FROM wattball_team WHERE teamID = ".$this->team2->getTeamId());
		}
		else
		{
			$result = $this->db->query("SELECT * FROM wattball_team WHERE teamID = ".$this->team2);
		}
        $data = $result->fetch();
        $team2 = new Team($this->db, $data['teamID']);
        $team2->getTeamInfo();
        return $team2;
    }
    
    public function getDateSQLFormat()
    {
        $result = $this->db->query("SELECT matchDate FROM wattball_matches WHERE matchID = ".$this->id);
        $data = $result->fetch();
        return $data['matchDate'];
    }
    
    public function saveResult($team1Score , $team2Score, $report)
    {
        $report = mysql_real_escape_string($report);
        $this->db->exec("INSERT INTO wattball_results(matchID,team1Score,team2Score,matchReport) VALUES(".$this->id.",$team1Score,$team2Score,'$report')");
    }
    
    public function saveRanking($team1Score , $team2Score)
    {
        //get the teamID
        $rtID = $this->db->query("SELECT * FROM wattball_matches WHERE matchID =".$this->id);
        $dtID = $rtID->fetch();
        $this->team1 = $dtID['team1'];
        $this->team2 = $dtID['team2'];
        //get the tournament ID
        $rID = $this->db->query("SELECT tournamentID FROM wattball_team WHERE teamID =".$this->team1);
        $dID = $rID->fetch();
        $tournamentID = $dID['tournamentID'];
        
        $winner = null;
        if($team1Score > $team2Score)
            $winner = "team1";
        else if($team1Score < $team2Score)
            $winner = "team2";
        else if($team1Score == $team2Score)
            $winner = "drawn";
        
        //team 1
        $result = $this->db->query("SELECT * FROM wattball_ranking WHERE teamID =".$this->team1);
        $data = $result->fetch();
        if($data == false)
        {
            $won = 0;
            $lost = 0;
            $drawn = 0;
            $goalsFor = 0;
            $goalsAgainst = 0;
            $goalsDifference = 0;
            $matchPoint = 0;
            $this->db->exec("INSERT INTO wattball_ranking(teamID,tournamentID,won,lost,drawn,goalsFor,goalsAgainst,goalDifference,matchPoint) VALUE (".$this->team1.",$tournamentID,0,0,0,0,0,0,0)");            
        }
        else
        {
            $won = $data['won'];
            $lost = $data['lost'];
            $drawn = $data['drawn'];
            $goalsFor = $data['goalsFor'];
            $goalsAgainst = $data['goalsAgainst'];
        }
        if($winner == "team1")
            $won++;
        else if($winner == "team2")
            $lost++;
        else
            $drawn++;
        $goalsFor += $team1Score;
        $goalsAgainst += $team2Score;
        $goalsDifference = $goalsFor - $goalsAgainst;
        $matchPoint = 3*$won + 1*$drawn;
        
        $this->db->exec("UPDATE wattball_ranking SET won=$won,lost=$lost,drawn=$drawn,goalsFor=$goalsFor,goalsAgainst=$goalsAgainst,goalDifference=$goalsDifference,matchPoint=$matchPoint 
                        WHERE teamID = ".$this->team1.";");
        
        $result = null;
        $data = null;
        
        
        //team 2
        $result = $this->db->query("SELECT * FROM wattball_ranking WHERE teamID =".$this->team2);
        $data = $result->fetch();
        if($data == false)
        {
            $won = 0;
            $lost = 0;
            $drawn = 0;
            $goalsFor = 0;
            $goalsAgainst = 0;
            $goalsDifference = 0;
            $matchPoint = 0;
            $this->db->exec("INSERT INTO wattball_ranking(teamID,tournamentID,won,lost,drawn,goalsFor,goalsAgainst,goalDifference,matchPoint) VALUE (".$this->team2.",$tournamentID,0,0,0,0,0,0,0)");            
        }
        else
        {
            $won = $data['won'];
            $lost = $data['lost'];
            $drawn = $data['drawn'];
            $goalsFor = $data['goalsFor'];
            $goalsAgainst = $data['goalsAgainst'];
        }
        if($winner == "team2")
            $won++;
        else if($winner == "team1")
            $lost++;
        else
            $drawn++;
        $goalsFor += $team2Score;
        $goalsAgainst += $team1Score;
        $goalsDifference = $goalsFor - $goalsAgainst;
        $matchPoint = 3*$won + 1*$drawn;
        
        $this->db->exec("UPDATE wattball_ranking SET won=$won,lost=$lost,drawn=$drawn,goalsFor=$goalsFor,goalsAgainst=$goalsAgainst,goalDifference=$goalsDifference,matchPoint=$matchPoint 
                        WHERE teamID = ".$this->team2.";");
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
    
    public function getUmpireName()
    {
		$result = $this->db->query("SELECT umpireName FROM umpire WHERE umpireID = ".$this->umpire);
		$data = $result->fetch();
		return $data['umpireName'];
	}
            
}
?>
