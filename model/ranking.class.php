<?php

class Ranking 
{
    /**
     *
     * @var Array Team
     */
    private $teams;
    
    /**
     *
     * @var Database
     */
    private $db;
    
    public function __construct($db)
    {
        $this->db = $db;
        $this->teams = array();
    }
    
    /**
     * Get all the teams, ordered by matchPoint
     */
    public function ranking()
    {
        $result = $this->db->query("SELECT * FROM wattball_ranking r
                                    JOIN wattball_team t on t.teamID = r.teamID
                                    ORDER BY goalDifference DESC , matchPoint DESC");
        $i = 0;
        while($data = $result->fetch())
        {
            $this->teams[$i] = new Team($this->db, $data['teamID']);
            $this->teams[$i]->setDrawn($data['drawn']);
            $this->teams[$i]->setWon($data['won']);
            $this->teams[$i]->setLost($data['lost']);
            $this->teams[$i]->setTeamName($data['teamName']);
            $this->teams[$i]->setMatchPoint($data['matchPoint']);
            $i++;
        }
    }    
    
    public function getRanking($teamID)
    {
        $i = 0;
        for($i;$i<count($this->teams);$i++)
        {
            if($this->teams[$i]->getTeamID() == $teamID)
                break;
        }
        return $i+1;
    }
    
    public function getTeams() {
        return $this->teams;
    }

    public function setTeams($teams) {
        $this->teams = $teams;
    }

    public function getDb() {
        return $this->db;
    }

    public function setDb($db) {
        $this->db = $db;
    }


}

?>
