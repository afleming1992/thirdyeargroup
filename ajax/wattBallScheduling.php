<?php
include_once '../include/autoload.php';
include_once '../config/config.php';
if(isset($_GET['id']))
{   
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
        $tournament = new Tournament($id, $data['name'], $data['startDate'], $data['endDate'], $data['registrationOpen'], $data['registrationClose'], $db);
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
        //var_dump($matches);

        //give a date and an umpire to the matches

        $date = $tournament->getDateSQLFormat($tournament->getStartDate());
        $scheduledMathes = array();

        $nb = 0;
        $numberOfMathes = count($matches);
        
        while ($nb < $numberOfMathes)
        {    
            $j = 0;
            $scheduledMathes[$date] = array(); 
            $scheduleUmpire["morning"] = array();
            $scheduleUmpire["afternoon"] = array();
            $pitch = 0;
            for($i=0;$i<$numberOfMathes;$i++)
            {
                if($matches[$i]->getDate() == null)
                {
                    if($j%2 == 0)
                    {
                        $time = "morning";
                        $pitch++;
                    }
                    else
                    {
                        $time = "afternoon";
                    }
                    $teamAvailability = checkTeamAvailability($scheduledMathes[$date],$matches[$i],$time);
                    $umpireFound = findUmpire($scheduleUmpire,$umpire,$time,$date);
                    if($teamAvailability == TRUE && $umpireFound != FALSE)
                    {                        
                        $matches[$i]->setDate($date);
                        $matches[$i]->setHour($time);
                        $matches[$i]->setPitch($pitch);
                        $matches[$i]->setUmpire($umpireFound);
                        $scheduledMathes[$date][$j] = $matches[$i];
                        $scheduleUmpire[$time][$j] = $umpireFound->getID();
                        $j++;
                    }
                    else if($time == "morning")
                        $pitch--;
                    
                }
            }
            $nb += count($scheduledMathes[$date]);
            $date = $tournament->nextDate($date);
            
        }    
        
        for($i = 0;$i<count($matches);$i++)
            $matches[$i]->saveMatch ($id);
            //var_dump($matches);
        echo "All the matches are scheduled !";
        
        //var_dump($matches);
        /*do
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
                       
                        /*list($Y,$m,$d)=explode('-',date($date));
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
                            }
                        }
                        if($matches[$i]->getUmpire() == null)
                        {
                            $matches[$i]->setDate(null);
                            $matches[$i]->setHour(null);
                            $matches[$i]->setPitch(null);
                        }
                        
                    }
                }
            }
            $nb += count($scheduledMathes[$date]);
            $date = $tournament->nextDate($date);
        }
        while ($nb < $numberOfMathes);*/
        //var_dump($matches);
        //for($i = 0;$i<count($matches);$i++)
            //$matches[$i]->saveMatch ($id);
            //var_dump($matches);
        //echo "All the matches are scheduled !";
        
    } 
    catch (Exception $exc) 
    {
        echo $exc->getTraceAsString();
    }

}
else if(isset ($_GET['tournament']))
{
    $id = htmlspecialchars($_GET['tournament']);
    try
    {
       $db = new PDO("mysql:host=$server;dbname=$database",$user,$password);
       //is already schedule ?
        $isSchedule = $db->query("SELECT COUNT(*) as number FROM wattBall_matches WHERE tournamentID = $id");
        $data = $isSchedule->fetch();
        if($data['number']!=0)
        {
            echo "This tournament is already schedule";
        }
        else
        {   
            $result = $db->query("SELECT name, DATE_FORMAT(startDate,'%D %M %Y') AS startDate, DATE_FORMAT(endDate,'%D %M %Y') AS endDate,
                                      DATE_FORMAT(registrationOpen,'%D %M %Y') AS registrationOpen, DATE_FORMAT(registrationClose,'%D %M %Y') AS registrationClose 
                                   FROM tournament
                                   WHERE tournamentID = $id");
             $data = $result->fetch();
             $tournament = new Tournament($id, $data['name'], $data['startDate'], $data['endDate'], $data['registrationOpen'], $data['registrationClose'],$db);

             $numberOfTeam = $tournament->getNumberOfTeam();
             $numberOfUmpire = $tournament->getNumberOfUmpire();

             include_once '../include/schedulingInfo.php';
        }
       
    }
    catch (Exception $exc)
    {
        echo $exc->getTraceAsString();
    }
}
else if(isset ($_GET['schedule']))
{
    $id = htmlspecialchars($_GET['schedule']);
    try
    {
       $db = new PDO("mysql:host=$server;dbname=$database",$user,$password);
       $result = $db->query("SELECT name, DATE_FORMAT(startDate,'%D %M %Y') AS startDate, DATE_FORMAT(endDate,'%D %M %Y') AS endDate,
				 DATE_FORMAT(registrationOpen,'%D %M %Y') AS registrationOpen, DATE_FORMAT(registrationClose,'%D %M %Y') AS registrationClose 
                              FROM tournament
                              WHERE tournamentID = $id");
        $data = $result->fetch();
        $tournament = new Tournament($id, $data['name'], $data['startDate'], $data['endDate'], $data['registrationOpen'], $data['registrationClose'], $db);
        $matches = $tournament->getAllMatches();
        $teams1 = array();
        $teams2 = array();
        $i = 0;
        foreach ($matches as $m) 
        {
           $teams1[$i] = $m->getTeam1Info();
           $teams2[$i] = $m->getTeam2Info();
           $i++;
        }
        include_once '../include/schedule.php';
       
    }
    catch (Exception $exc)
    {
        echo $exc->getTraceAsString();
    }
}

function checkTeamAvailability($scheduledMatches,$match,$time)
{
    $availability = true;
    for($i=0;$i<count($scheduledMatches);$i++)
    {
        if($scheduledMatches[$i]->getHour() == $time)
        {
            $team1 = $match->getTeam1();
            $team2 = $match->getTeam2();
            if($scheduledMatches[$i]->getTeam1() == $team1 || $scheduledMatches[$i]->getTeam2() == $team1 || $scheduledMatches[$i]->getTeam1() == $team2 || $scheduledMatches[$i]->getTeam2() == $team2)
            {
                $availability = false;
                break;
            }
        }
    }
    return $availability;
}

function findUmpire($scheduledUmpire,$umpire,$time,$date)
{
    $umpireFound = false;
    for($i=0;$i<count($umpire);$i++)
    {
        if(count($scheduledUmpire[$time]) >0)
        {
            if(!in_array($umpire[$i]->getID(), $scheduledUmpire[$time]))
            {
                list($Y,$m,$d)=explode('-',date($date));
                if($umpire[$i]->is_available(Date("l", mktime(0,0,0,$m,$d,$Y)), $time))
                {
                    $umpireFound = $umpire[$i];
                    break;
                }
            }
        }
        else
        {
            list($Y,$m,$d)=explode('-',date($date));
            if($umpire[$i]->is_available(Date("l", mktime(0,0,0,$m,$d,$Y)), $time))
            {
                $umpireFound = $umpire[$i];
                break;
            }
        }
    }
    return $umpireFound;
}


function lookinkForTeam($array,$match)
{
    //echo $match->getTeam1()->getTeamName()." VS ".$match->getTeam2()->getTeamName();
    //var_dump($array);
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
