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
	
	
	public function __construct($db)
	{
		$this->setDb($db);
	}
	
	public function loadHomePage()
	{
		require_once 'view/header.php';
		require_once 'view/home.php';
		require_once 'view/footer.php';
	}
	
	public function login($username, $password)
	{
		$staff = new Staff($username, sha1($password), $this->db);
		
		if($staff->checkPassword())
		{
			require_once 'view/header.php';
			require_once 'view/footer.php';			
		}
		else
		{
			
			
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
}

?>