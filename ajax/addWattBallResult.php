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
        if($tournamentID == "0")
        {
            $result = $db->query("SELECT  matchID, tournamentID, DATE_FORMAT(matchDate,'%D %M %Y') AS matchDate, matchTime, pitch, team1, team2
                                 FROM wattball_matches WHERE matchDate = '$date'");
        }
        else
        {
            $result = $db->query("SELECT  matchID, tournamentID, DATE_FORMAT(matchDate,'%D %M %Y') AS matchDate, matchTime, pitch, team1, team2
                                 FROM wattball_matches WHERE matchDate = '$date' AND  tournamentID = $tournamentID ");
        }
        
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
    catch (Exception $exc)
    {
        echo $exc->getTraceAsString();
    }

    
}
else if(isset($_GET['matchID']) && isset($_GET['playerTeam1']) && isset($_GET['playerTeam2']) && isset($_GET['minuteTeam1']) && isset($_GET['minuteTeam2']) )
{
    $playerTeam1;
    $minuteTeam1;
    $playerTeam2;
    $minuteTeam2;
    $goalsTeam1;
    $goalsTeam2;
    $matchID = htmlspecialchars($_GET['matchID']);
    for($i=0;$i<count($_GET['playerTeam1']);$i++)
    {
        $playerTeam1[$i] = htmlspecialchars($_GET['playerTeam1'][$i]);
        $minuteTeam1[$i] = htmlspecialchars($_GET['minuteTeam1'][$i]);
    }
    for($i=0;$i<count($_GET['playerTeam2']);$i++)
    {
        $playerTeam2[$i] = htmlspecialchars($_GET['playerTeam2'][$i]);
        $minuteTeam2[$i] = htmlspecialchars($_GET['minuteTeam2'][$i]);
    }
    
    if(count($playerTeam1) == 1 && $playerTeam1[0] == "0")
        $goalsTeam1 = 0;
    else
        $goalsTeam1 = count($playerTeam1);
    if(count($playerTeam2) == 1 && $playerTeam2[0] == "0")
        $goalsTeam2 = 0;
    else
        $goalsTeam2 = count($playerTeam2);
    
    
    try 
    {
        $db = new PDO("mysql:host=$server;dbname=$database",$user,$password);
        $match = new Match($matchID, null, null, null, null, null, null, $db);
        $match->saveResult($goalsTeam1, $goalsTeam2);
        
        if($goalsTeam1 > 0)
        {
            for($i=0;$i<count($playerTeam1);$i++)
            {
                $p = new Player($db);
                $p->setPlayerID($playerTeam1[$i]);
                $p->saveGoals($matchID, $minuteTeam1[$i]);
            }
        }
        
        if($goalsTeam2 > 0)
        {
           for($i=0;$i<count($playerTeam2);$i++)
            {
                $p = new Player($db);
                $p->setPlayerID($playerTeam2[$i]);
                $p->saveGoals($matchID, $minuteTeam2[$i]);
            } 
        }
        
        
        
    }
    catch (Exception $exc)
    {
        echo $exc->getTraceAsString();
    }
}
else if(isset($_GET['matchID']))
{
    $matchID = htmlspecialchars($_GET['matchID']);
    try 
    {
        $db = new PDO("mysql:host=$server;dbname=$database",$user,$password);
        $result = $db->query("SELECT  matchID, tournamentID, DATE_FORMAT(matchDate,'%D %M %Y') AS matchDate, matchTime, pitch, team1, team2
                                 FROM wattball_matches WHERE matchID = $matchID");
        $data = $result->fetch();
       
        if($data != null)
        {
            $matches = array();
            $m = new Match($data['matchID'], $data['team1'], $data['team2'], $data['matchDate'], $data['matchTime'], $data['pitch'],null, $db);
            $t1 = $m->getTeam1Info();
            $t2 = $m->getTeam2Info();
            $matches[0]['match'] = $m;
            $matches[0]['team1'] = $t1;
            $matches[0]['team2'] = $t2;
            $matches[0]['playersTeam1'] = $t1->getPlayersInfo();
            $matches[0]['playersTeam2'] = $t2->getPlayersInfo();
            
            $tournament[0] = new Tournament($data['tournamentID'], null, null, null, null, null, null);
            include_once '../include/addWattBallResult.php';
        }
        else
        {
            $matches = array();
            include_once '../include/addWattBallResult.php';
        }
    }
    catch (Exception $exc)
    {
        echo $exc->getTraceAsString();
    }
    
}
?>