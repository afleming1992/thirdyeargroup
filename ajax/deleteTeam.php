<?php

include_once '../include/autoload.php';
include_once '../config/config.php';
include_once '../controller/mainController.class.php';
if(isset($_GET['id']))
{
    $id = htmlspecialchars($_GET['id']);
    try 
    {
        $db = new PDO("mysql:host=$server;dbname=$database",$user,$password);
        $request1 = $db->exec("DELETE FROM wattball_players WHERE teamID = $id");
        $request = $db->exec("DELETE FROM wattball_team WHERE teamID = $id");
        $delete = true;
        if($request1 === FALSE || $request === FALSE)
        {
            $delete = false;
        }
        
        $app = new MainController($db);
        $isTournamentStarted = $app->isTournamentStarted();
        $result = $app->getDb()->query("SELECT * FROM wattball_team ORDER BY teamName");
        $data = $result->fetchAll();
        $teams = array();
        $i = 0;
        if($data != false)
        {
            foreach ($data as $d)
            {
                $teams[$i] = new Team($app->getDb(), $d['teamID']);
                $teams[$i]->setContactName($d['contactName']);
                $teams[$i]->setTeamName($d['teamName']);
                $teams[$i]->setNwaNumber($d['NWANumber']);
                $teams[$i]->setEmail($d['email']);
                $teams[$i]->setContactNumber($d['contactNumber']);
                $i++;
            }
        }
        
        include_once '../include/adminWattBall.php';
        
    }
    catch (Exception $e)
    {
        echo $exc->getTraceAsString();
    }
}
?>
