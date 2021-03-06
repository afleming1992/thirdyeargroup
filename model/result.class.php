<?php


Class Result
{
    private $id;
    
    /**
     *
     * @var Team
     */
    private $team1;
    
    /**
     *
     * @var Team
     */
    private $team2;
    private $team1Score;
    private $team2Score;
    private $team1Goals;
    private $team2Goals;
    private $matchDate;
    /**
     *
     * @var Database 
     */
    private  $db;




    public function __construct($id , $team1 , $team2 , $team1Score , $team2Score , $db)
    {
        $this->id = $id;
        $this->team1 = $team1;
        $this->team1Score = $team1Score;
        $this->team2 = $team2;
        $this->team2Score = $team2Score;        
        $this->db = $db;
    }
    
    public function getTeamsInfo()
    {
        $this->team1->getTeamInfo();
        $this->team2->getTeamInfo();
    }
    
    public function getGoals()
    {
        $result = $this->db->query("SELECT * FROM wattball_results r
                                    JOIN wattball_matches m ON r.matchID = m.matchID
                                    JOIN wattball_goals g ON g.matchID = m.matchID
                                    JOIN wattball_players p ON g.playerID = p.playerID
                                    WHERE r.resultID = $this->id");
        $this->team1Goals = array();
        $this->team2Goals = array();
        $i = 0;
        $j = 0;
        while($data = $result->fetch())
        {
            if($data['teamID'] == $this->team1->getTeamId())
            {
                $this->team1Goals[$i] = array(
                    "player" => $data['playerName'],
                    "playerID" => $data['playerID'],
                    "minute" => $data['minute']
                );
                $i++;
            }
            else if($data['teamID'] == $this->team2->getTeamId())
            {
                $this->team2Goals[$j] = array(
                    "player" => $data['playerName'],
                    "playerID" => $data['playerID'],
                    "minute" => $data['minute']
                );
                $j++;
            }
        }
        
        
        
        
        
    }
    
    public function getResultID()
    {
        return $this->id;
    }
    
    public function setMatchDate($date)
    {
        $this->matchDate = $date;
    }
    
    public function getMatchDate()
    {
        return $this->matchDate;
    }
    
    public function getTeam1()
    {
        return $this->team1;
    }
    
    public function getTeam2()
    {
        return $this->team2;
    }
    
    public function getTeam1Score()
    {
        return $this->team1Score;
    }
    
    public function getTeam2Score()
    {
        return $this->team2Score;
    }
    
    public function getTeam1Goals()
    {
        return $this->team1Goals;
    }
    
    public function getTeam2Goals()
    {
        return $this->team2Goals;
    }
}

?>