<?php

/**
 * This object represents staff for staff management.
 *
 */
class RealStaff
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
	 * Email
	 * @var String
	 */
	private $email;
	
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
	public function __construct($username,$name,$manager,$email,$db)
	{
		$this->setDb($db);
		$this->setUsername($username);
		$this->setName($name);
		$this->setEmail($email);
		$this->setManager($manager);
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

	public function getEmail()
	{
	    return $this->email;
	}

	public function setEmail($email)
	{
	    $this->email = $email;
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
