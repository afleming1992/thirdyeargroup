<?php

include_once '../include/autoload.php';
include_once '../config/config.php';

if(isset($_GET['name']) && isset($_GET['teamID']) && isset($_GET['id'])) //change
{
    $name = mysql_escape_string(htmlspecialchars($_GET['name']));
    $teamID = htmlspecialchars($_GET['teamID']);
    $id = htmlspecialchars($_GET['id']);
    try 
    {
        $db = new PDO("mysql:host=$server;dbname=$database",$user,$password);
        $db->exec("UPDATE wattball_players SET playerName='$name' WHERE playerID=$id");
        
        $request = $db->query("SELECT * FROM wattball_players WHERE teamID = $teamID ORDER BY playerName");
        $players = array();
        $i = 0;
        while ($data = $request->fetch())
        {
            $players[$i] = new Player(NULL);
            $players[$i]->setPlayerID($data['playerID']);
            $players[$i]->setPlayerName($data['playerName']);
            $i++;
        }
        
        require_once '../include/changeTeamPlayers.php';
        
    }
    catch (Exception $e)
    {
        echo $e->getTraceAsString();
    }
    
}
else if(isset($_GET['name']) && isset($_GET['teamID'])) //add
{
    $name = mysql_escape_string(htmlspecialchars($_GET['name']));
    $teamID = htmlspecialchars($_GET['teamID']);
    
    try 
    {
        $db = new PDO("mysql:host=$server;dbname=$database",$user,$password);
        $db->exec("INSERT INTO wattball_players(teamID,playerName,numberOfGoals) VALUES($teamID,'$name',0)");
        
        
        $request = $db->query("SELECT * FROM wattball_players WHERE teamID = $teamID ORDER BY playerName");
        $players = array();
        $i = 0;
        while ($data = $request->fetch())
        {
            $players[$i] = new Player(NULL);
            $players[$i]->setPlayerID($data['playerID']);
            $players[$i]->setPlayerName($data['playerName']);
            $i++;
        }
        
        require_once '../include/changeTeamPlayers.php';
        
    }
    catch (Exception $e)
    {
        echo $e->getTraceAsString();
    }
}
else if(isset($_GET['id']) && isset($_GET['teamID']))
{
    $id = htmlspecialchars($_GET['id']);
    $teamID = htmlspecialchars($_GET['teamID']);
    try 
    {
        $db = new PDO("mysql:host=$server;dbname=$database",$user,$password);
        $db->exec("DELETE FROM wattball_players WHERE playerID = $id");
        
        
        $request = $db->query("SELECT * FROM wattball_players WHERE teamID = $teamID ORDER BY playerName");
        $players = array();
        $i = 0;
        while ($data = $request->fetch())
        {
            $players[$i] = new Player(NULL);
            $players[$i]->setPlayerID($data['playerID']);
            $players[$i]->setPlayerName($data['playerName']);
            $i++;
        }
        
        require_once '../include/changeTeamPlayers.php';
        
    }
    catch (Exception $e)
    {
        echo $e->getTraceAsString();
    }
}
?>
