<?php
include_once '../include/autoload.php';
include_once '../config/config.php';
include_once '../controller/mainController.class.php';
$db = new PDO("mysql:host=$server;dbname=$database",$user,$password);
if(isset($_GET['id']) && isset($_GET['date']) && isset($_GET['hour']) && isset($_GET['pitch']) && isset($_GET['vs']) && isset($_GET['team1']) && isset($_GET['team2']))
{
	
    $id = htmlspecialchars($_GET['id']);
    $date = htmlspecialchars($_GET['date']);
    $hour = htmlspecialchars($_GET['hour']);
    $pitch = htmlspecialchars($_GET['pitch']);
    $vs = htmlspecialchars($_GET['vs']);
    $team1 = htmlspecialchars($_GET['team1']);
    $team2 = htmlspecialchars($_GET['team2']);
    
    try
    {
       $db = new PDO("mysql:host=$server;dbname=$database",$user,$password);
       
       $query = $db->query("SELECT umpire FROM wattball_matches WHERE matchID = $id");
       $fetched = $query->fetch();
       $umpire = $fetched['umpire'];
       
       $query2 = $db->query("SELECT * FROM wattball_matches WHERE umpire = '$umpire' AND matchDate = '$date' AND matchTime = '$hour' AND matchID = $id");
       $fetched2 = $query2->fetch();
            
       $result = $db->query("SELECT * FROM wattball_matches WHERE matchID != '$id' AND matchDate = '$date' AND matchTime = '$hour' AND (pitch = $pitch OR team1 = '$team1' OR team1 = '$team2' OR team2 = '$team1' OR team2 = '$team2')");     
       $data = $result->fetch();
       
       $result2 = $db->query("SELECT DATE_FORMAT('$date','%D %M %Y') AS date");
		$data2 = $result2->fetch();
       if($data != null)
       {
		   $message = "Another match with this pitch or at least one of these teams is already scheduled for this time:";
           printMatch(true,$message,$vs,$date,$data2['date'],$hour,$pitch,$id);
           return;
       }
		
		if($fetched2 == null)
		{
			$umpire = findUmpire($date, $hour);
			if($umpire == null)
			{
				$message = "No umpires available at this date and time:";
				printMatch(true,$message,$vs,$date,$data2['date'],$hour,$pitch,$id);
				return;
			}
		}
		else
		{
			$message = "No changes to be made, details same as before:";
			printMatch(true,$message,$vs,$date,$data2['date'],$hour,$pitch,$id);
			return;
		}
	   
		$db->exec("UPDATE wattball_matches SET matchDate = '$date' , matchTime = '$hour' , pitch = $pitch , umpire = '$umpire' WHERE matchID = $id");
		$message = "Match updated, changes below:";
		printMatch(false,$message,$vs,$date,$data2['date'],$hour,$pitch,$id);   
    }
    catch (Exception $exc)
    {
        echo $exc->getTraceAsString();
    }
}

function printMatch($error,$message,$vs,$date,$date2,$hour,$pitch,$id)
{
    if($error)
        echo "<p class='text-error'>".$message."</p>";
    else
		echo "<p class='text-success'>".$message."</p>";
    echo "<p id='vs' class='text-info center'>$vs</p>";
    echo "<p class='text-info' >Date:</p>";
    echo "<p id='date' dateSQL='$date'>".$date2."</p>";
    echo "<p class='text-info' >Hour:</p>";
    echo "<p id='hour' >$hour</p>";
    echo "<p class='text-info' >Pitch:</p>";
    echo "<p id='pitch' >$pitch</p>";
    echo "<button id='$id' data-target='#changeSchedule' class='btn btn-small btn-primary' type='button'><i class='icon-wrench icon-white'></i> Re-Schedule</button>";
}

function findUmpire($date, $hour)
{
	global $db;
	$umpireFound = false;
	
	if($hour == "10am")
	{
		$time = "morning";
	}
	else if($hour == "2pm")
	{
		$time = "afternoon";
	}
	
	$app = new MainController($db);
	$app->getAllUmpires();
	$allUmpires = $app->getUmpire();
	
	for($i=0;$i<sizeof($allUmpires);$i++)
	{
		$umpireID = $allUmpires[$i]->getID();
		$query = $db->query("SELECT * FROM wattball_matches WHERE umpire = '$umpireID' AND matchDate = '$date' AND matchTime = '$hour'");
		$fetched = $query->fetch();
		if($fetched == null)
        {
			list($Y,$m,$d)=explode('-',date($date));
			if($allUmpires[$i]->is_available(Date("l", mktime(0,0,0,$m,$d,$Y)), $time))
			{
				$umpireFound = $umpireID;
				break;
			}
		}
	}
	return $umpireFound;
}

?>
