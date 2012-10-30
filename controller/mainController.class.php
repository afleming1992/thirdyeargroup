<?php

/**
 * Use to load view
 * @author Yohann
 *
 */
class MainController
{
	/**
	 * Object PDO for database connection, query ...
	 * @var PDO
	 */
	private $db;
	private $tournament = array();
	
	
	public function __construct($db)
	{
		$this->setDb($db);
	}
	
	public function loadHomePage()
	{
		require_once 'view/header.php';
		require_once 'view/login.php';
		require_once 'view/home.php';
		require_once 'view/footer.php';
	}
	
	public function login($username, $password)
	{
		$staff = new Staff($username, sha1($password), $this->db);
		
		if($staff->checkPassword())
		{
			require_once 'view/header.php';
			require_once 'view/homeStaff.php';
			require_once 'view/footer.php';			
		}
		else
		{
			require_once 'view/header.php';
			require_once 'view/loginFalse.php.php';
			require_once 'view/home.php';
			require_once 'view/footer.php';			
		}
	}
	
	public function loadPage($pageName) 
	{
		require_once 'view/header.php';
		require_once 'view/'.$pageName.'.php';
		require_once 'view/footer.php';
	}
	
	public function getAllTournament()
	{
		$result = $this->db->query("SELECT tournamentID, name, DATE_FORMAT(startDate,'%D %M %Y') AS startDate, DATE_FORMAT(endDate,'%D %M %Y') AS endDate,
				 DATE_FORMAT(registrationOpen,'%D %M %Y') AS registrationOpen, DATE_FORMAT(registrationClose,'%D %M %Y') AS registrationClose FROM tournament");
		$i = 0;
		while($data = $result->fetch())
		{
			$this->tournament[$i] = new Tournament($data['tournamentID'],$data['name'],$data['startDate'],$data['endDate'],$data['registrationOpen'],$data['registrationClose']);
			$i++;
		}
	}
	
	
	
	
	/*-------- GETTERS & SETTERS --------*/
	
	public function getDb()
	{
	    return $this->db;
	}

	public function setDb($db)
	{
		if($db != null)
	   		$this->db = $db;
		else 
			die("Connection Error");
	}

	public function getTournament()
	{
	    return $this->tournament;
	}

	public function setTournament($tournament)
	{
	    $this->tournament = $tournament;
	}
}

?>