<?php
include_once '../include/autoload.php';
include_once '../config/config.php';
if(isset($_GET['id']) && isset($_GET['date']) && isset($_GET['hour']) && isset($_GET['pitch']) && isset($_GET['vs']))
{
    $id = htmlspecialchars($_GET['id']);
    $date = htmlspecialchars($_GET['date']);
    $hour = htmlspecialchars($_GET['hour']);
    $pitch = htmlspecialchars($_GET['pitch']);
    $vs = htmlspecialchars($_GET['vs']);;
    try
    {
       $db = new PDO("mysql:host=$server;dbname=$database",$user,$password);
       
       $result = $db->query("SELECT * FROM wattball_matches WHERE matchDate = '$date' AND matchTime = '$hour' AND pitch = $pitch");       
       $data = $result->fetch();
       $result2 = $db->query("SELECT DATE_FORMAT(matchDate,'%D %M %Y') AS date FROM wattball_matches WHERE matchID = $id");
       $data2 = $result2->fetch();
       if($data != null)
       {
           printMatch(true,$vs,$date,$data2['date'],$hour,$pitch,$id);
       }
       else
       {
            $db->exec("UPDATE wattball_matches SET matchDate = '$date' , matchTime = '$hour' , pitch = $pitch WHERE matchID = $id");
            printMatch(false,$vs,$date,$data2['date'],$hour,$pitch,$id);
            
       }
       
       
       
    }
    catch (Exception $exc)
    {
        echo $exc->getTraceAsString();
    }
}

function printMatch($error,$vs,$date,$date2,$hour,$pitch,$id)
{
    if($error)
        echo "<p class='text-error'>Another match is scheduled at this date!</p>";
    echo "<p id='vs' class='text-info center'>$vs</p>";
    echo "<p class='text-info' >Date:</p>";
    echo "<p id='date' dateSQL='$date'>".$date2."</p>";
    echo "<p class='text-info' >Hour:</p>";
    echo "<p id='hour' >$hour</p>";
    echo "<p class='text-info' >Pitch:</p>";
    echo "<p id='pitch' >$pitch</p>";
    echo "<button id='$id' data-target='#changeSchedule' class='btn btn-small btn-primary' type='button'><i class='icon-wrench icon-white'></i> Re-Schedule</button>";
}
?>
