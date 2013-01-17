<?php

/**
 * This object represent a staff guy
 * @author Yohann
 *
 */
class Staff
{
	/**
	 * username, use to login
	 * @var String
	 */
	private $username;
	
	/**
	 * Name
	 * @var String
	 */
	private $name;
	
	/**
	 * Password
	 * @var String
	 * Encrypted with sha1 algorithm
	 */
	private $password;
	
	/**
	 * Use to know if the staff guy is a manager
	 * @var Boolean
	 */
	private $manager;
	
	/**
	 * Object PDO for database connection, query ...
	 * @var PDO
	 */
	private $db;
	
	/**
	 * Build new staff object
	 * @param String $username
	 * @param String $password Encrypted with sha1
	 * @param PDO $db
	 */
	public function __construct($username,$password,$db)
	{
		$this->setDb($db);
		$this->setUsername($username);
		$this->setPassword($password);
	}
	
	/**
	 * Check the couple username/password in the database and, if it's true, get value for 'name' and 'manager'
	 * If the couple username/password is wrong (wrong password, wrong username or inexistant username in database, return false. Else, true
	 * @return Boolean
	 */
	public function checkPassword()
	{
		$result =$this->db->query("SELECT * FROM staff WHERE username='".$this->username."'");
                $data = $result->fetch();
                
		if ($result!=false && $this->password == $data['password'])
		{
			$this->setName($data['name']);
			$this->setManager($data['manager']);
			return true;
		}
		else
			return false;
	}
	
	public function getStaffInfo()
	{
		$result =$this->db->query("SELECT * FROM staff WHERE username='".$this->username."'");
		if ($result!=false)
		{
			while($data = $result->fetch())
			{
				$this->setName($data['name']);
				$this->setManager($data['manager']);
			}
			return true;
		}
		else
			return false;
	}
	
	
	/*-------- GETTERS & SETTERS --------*/
	
	

	public function getUsername()
	{
	    return $this->username;
	}

	public function setUsername($username)
	{
	    $this->username = $username;
	}

	public function getName()
	{
	    return $this->name;
	}

	public function setName($name)
	{
	    $this->name = $name;
	}

	public function getPassword()
	{
	    return $this->password;
	}

	public function setPassword($password)
	{
	    $this->password = $password;
	}

	public function getManager()
	{
	    return $this->manager;
	}

	public function setManager($manager)
	{
	    $this->manager = $manager;
	}

	public function getDb()
	{
	    return $this->db;
	}

	public function setDb($db)
	{
	    $this->db = $db;
	}
}

?>