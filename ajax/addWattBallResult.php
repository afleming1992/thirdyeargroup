<?php
include_once '../include/autoload.php';
include_once '../config/config.php';
if(isset($_GET['date']) && isset($_GET['tournamentID']))
{
    $tournamentID = htmlspecialchars($_GET['tournamentID']);
    $date = htmlspecialchars($_GET['date']);
    try 
    {
        $db = new PDO("mysql:host=$server;dbname=$database",$user,$password);
        $result = $db->query("SELECT  matchID, tournamentID, DATE_FORMAT(matchDate,'%D %M %Y') AS matchDate, matchTime, pitch, team1, team2
                                 FROM wattBall_matches WHERE matchDate = '$date' AND  tournamentID = $tournamentID ");
        
        var_dump($result->fetch());
        if($result->fetch() != false)
        {
            var_dump($result->fetch());
            $matches = array();
            $i = 0;
            while ($data = $result->fetch())
            {
                
                $m = new Match($data['matchID'], $data['team1'], $data['team2'], $data['matchDate'], $data['matchTime'], $data['pitch'],null, $db);
                $t1 = $m->getTeam1Info();
                $t2 = $m->getTeam2Info();
                $matches[$i]['match'] = $m;
                $matches[$i]['team1'] = $t1;
                $matches[$i]['team2'] = $t2;
                $matches[$i]['playersTeam1'] = $t1->getPlayersInfo();
                $matches[$i]['playersTeam2'] = $t2->getPlayersInfo();
                $i++;
                
            }
            
           
            $tournament[0] = new Tournament($tournamentID, null, null, null, null, null, null);
            include_once '../include/addWattBallResult.php';
        }
        else
        {
            echo "<option>No Matches !</option>";
        }
    }
    catch (Exception $exc)
    {
        echo $exc->getTraceAsString();
    }
}
?>
