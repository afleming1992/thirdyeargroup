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
	
	/**
	 * Use to keep all tournament
	 *  @var Array: contains object Tournament
	 */
	private $tournament = array();
	
	
	public function __construct($db)
	{
		$this->setDb($db);
	}
	
	/**
	 * Load view for home page
	 */
	public function loadHomePage()
	{
		require_once 'view/header.php';
		require_once 'view/banner.php';
		require_once 'view/navbar.php';
		require_once 'view/login.php';
		require_once 'view/home.php';
		require_once 'view/footer.php';
	}
	
	/**
	 * load view for staff if username/password ar correct or load home page with error message if username/password are wrong
	 * @param String $username
	 * @param String $password
	 */
	public function login($username, $password)
	{
		$staff = new Staff($username, sha1($password), $this->db);
		
		if($staff->checkPassword())
		{
			$_SESSION['login'] = true;
			$_SESSION['username'] = $username;		
			$_SESSION['login-popup'] = true;
			require_once 'view/header.php';
			require_once 'view/banner.php';			
			require_once 'view/navbar.php';
			require_once 'view/menu-staff.php';
			require_once 'view/homeStaff.php';
			require_once 'view/footer.php';					
		}
		else
		{
			require_once 'view/header.php';
			require_once 'view/banner.php';
			require_once 'view/navbar.php';
			require_once 'view/loginFalse.php.php';
			require_once 'view/home.php';
			require_once 'view/footer.php';		
		}
	}
	
	
	public function loadPage($pageName) 
	{
		if($pageName=='homeStaff')
		{
			$staff = new Staff($_SESSION['username'], null, $this->db);
			$staff->getStaffInfo();
			$this->getAllTournament();
		}
		require_once 'view/header.php';
		require_once 'view/banner.php';		
		require_once 'view/login.php';
		require_once 'view/navbar.php';
		require_once 'view/'.$pageName.'.php';
		require_once 'view/footer.php';
	}
	
	/**
	 * search in the database all tournament and put in an array
	 */
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
