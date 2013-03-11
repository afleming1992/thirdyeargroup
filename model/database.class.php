<?php
class Database
{
    private $db;
    
    
    public function __construct($server, $database, $user ,$password)
    {
        try 
        {
                $this->db = new PDO("mysql:host=$server;dbname=$database",$user,$password);
        } 
        catch (Exception $e) 
        {
                echo "Connection error".$e->getMessage();
                die();
        }
    }    
    
    public function query($statement)
    {
        $result = $this->db->query($statement);        
        return $result;
    }
    
    public function exec($statement)
    {
        $this->db->exec($statement);
    }
    
}
?>