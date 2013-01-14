<?php

if(isset($_GET['id']))
{
    include_once '../config/config.php';
    include_once '../model/tournament.class.php';
    include_once '../model/team.class.php';
    include_once '../model/match.class.php';
    include_once '../model/umpire.class.php';
    $id = htmlspecialchars($_GET['id']);
    try 
    {
        $db = new PDO("mysql:host=$server;dbname=$database",$user,$password);
        
        //Get all information about the tournament
        $resultTournament = $db->query("SELECT name, DATE_FORMAT(startDate,'%D %M %Y') AS startDate, DATE_FORMAT(endDate,'%D %M %Y') AS endDate,
				 DATE_FORMAT(registrationOpen,'%D %M %Y') AS registrationOpen, DATE_FORMAT(registrationClose,'%D %M %Y') AS registrationClose 
                              FROM tournament
                              WHERE tournamentID = $id");
        $data = $resultTournament->fetch();
        $tournament = new Tournament($id, $data['name'], $data['startDate'], $data['endDate'], $data['registrationOpen'], $data['registrationClose'], null, $db);
        $teams = $tournament->getTeams();
        
        // Get all the information about umpire
        $umpire = array();
        $resultUmpire = $db->query("SELECT * FROM umpire");
        $i = 0;
        while ($data = $resultUmpire->fetch())
        {
           $umpire[$i] = new Umpire($data["umpireID"], $data["umpireName"], $data["umpireEmail"], $data["monMorning"], $data["monAfternoon"], $data["tuesMorning"], $data["tuesAfternoon"], 
                   $data["wedMorning"], $data["wedAfternoon"], $data["thursMorning"], $data["thursAfternoon"], $data["friMorning"], $data["friAfternoon"], $data["satMorning"],
                   $data["satAfternoon"], $data["sunMorning"], $data["sunAfternoon"]);
           $i++;
        }        
        
        $matches = array();
        $k = 0;
        
        //create matches
        for($i = 0;$i<count($teams);$i++)
        {
            for($j = $i+1;$j<count($teams);$j++)
            {
               $matches[$k] = new Match(null, $teams[$i], $teams[$j], null, null, null, null, $db);
               $k++;
            }
            
        }
        
        
        //give a date and an umpire to the matches
        
        $date = $tournament->getDateSQLFormat($tournament->getStartDate());
        $scheduledMathes = array();
        
        $nb = 0;
        $numberOfMathes = count($matches);
        do
        {
            $j = 0;
            $scheduledMathes[$date] = array(); 
            $scheduleUmpire = array();
            $pitch = 1;
            
            for($i = 0;$i<count($matches);$i++)
            {   
                if($pitch >8)
                    break;
                if($matches[$i]->getDate() == null)
                {
                    if(lookinkForTeam($scheduledMathes[$date], $matches[$i]) == true)
                    {
                        $matches[$i]->setDate($date);
                        $time = "";
                        
                        if($j%2 == 0)
                        {
                            $time = "morning";
                            $matches[$i]->setHour ($time);
                            $matches[$i]->setPitch($pitch);
                            $pitch++;
                        }
                        else
                        {
                            $time = "afternoon";
                            $matches[$i]->setHour ($time);
                            $matches[$i]->setPitch($pitch);
                        }
                        
                        list($Y,$m,$d)=explode('-',date($date));
                        for($k = 0;$i<count($umpire);$k++)
                        {
                            if(!in_array($umpire[$k], $scheduleUmpire))
                            {
                                if($umpire[$k]->is_available(Date("l", mktime(0,0,0,$m,$d,$Y)), $time))
                                {
                                    $matches[$i]->setUmpire($umpire[$k]);
                                    $scheduledMathes[$date][$j] = $matches[$i];
                                    $scheduleUmpire[$j] = $umpire[$k];
                                    $j++;
                                    break;
                                }
                                else
                                {
                                    $matches[$i]->setDate(null);
                                    $matches[$i]->setHour(null);
                                    $matches[$i]->setPitch(null);
                                }
                            }
                        }  
                    }
                }
            }
            $nb += count($scheduledMathes[$date]);
            $date = $tournament->nextDate($date);
        }
        while ($nb < $numberOfMathes);
        
        for($i = 0;$i<count($matches);$i++)
            $matches[$i]->saveMatch ($id);
        
        echo "All the matches are scheduled !";
        
    } 
    catch (Exception $exc) 
    {
        echo $exc->getTraceAsString();
    }

}
else if(isset ($_GET['tournament']))
{
    include_once '../config/config.php';
    include_once '../model/tournament.class.php';
    $id = htmlspecialchars($_GET['tournament']);
    try
    {
       $db = new PDO("mysql:host=$server;dbname=$database",$user,$password);
       $result = $db->query("SELECT name, DATE_FORMAT(startDate,'%D %M %Y') AS startDate, DATE_FORMAT(endDate,'%D %M %Y') AS endDate,
				 DATE_FORMAT(registrationOpen,'%D %M %Y') AS registrationOpen, DATE_FORMAT(registrationClose,'%D %M %Y') AS registrationClose 
                              FROM tournament
                              WHERE tournamentID = $id");
        $data = $result->fetch();
        $tournament = new Tournament($id, $data['name'], $data['startDate'], $data['endDate'], $data['registrationOpen'], $data['registrationClose'], null, null, $db);
        
        $numberOfTeam = $tournament->getNumberOfTeam();
        $numberOfUmpire = $tournament->getNumberOfUmpire();
        
        include_once '../include/schedulingInfo.php';
       
    }
    catch (Exception $exc)
    {
        echo $exc->getTraceAsString();
    }
}





function lookinkForTeam($array,$match)
{
    $find = false;
    if(count($array) == 0)
    {
        $find = true;
    }
    else
    {
        for($i = 0;$i<count($array);$i++)
        {
           $team1 = $match->getTeam1();
           $team2 = $match->getTeam2();

           if($array[$i]->getTeam1() == $team1 || $array[$i]->getTeam2() == $team1 || $array[$i]->getTeam1() == $team2 || $array[$i]->getTeam2() == $team2)
           {
               $find = false;
               break;
           }
           else
           {
               $find = true;
           }
        }   
    }
    
    return $find;
}

function findPitch($scheduledMathes)
{
    $pitch = 0;
    if(count($scheduledMathes) == 0)
    {
        $pitch = 1;
    }
    else 
    {
        $str = "";
        for($i = 0;$i<cout($scheduledMathes);$i++)
            $str .= $scheduledMathes[$i]->getPitch();
        
        
    }
    
    return $pitch;
}

?>
