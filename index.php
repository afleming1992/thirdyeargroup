<?php 

/**
 * Autoloading classes from model folder when PHP instruction 'new MyClass'
 * @param String $className
 */
function loadClass($className)
{
	require_once 'model/'.$className.'.class.php';
}
spl_autoload_register ('loadClass');

/**
 * DATABASE CONNECTION, with PDO object
 * All variables are defined in config/config.php
 */
require_once 'config/config.php';

try 
{
	$db = new PDO("mysql:host=$server;dbname=$database",$user,$password);
} 
catch (Exception $e) 
{
	echo "Connection error".$e->getMessage();
}


require_once 'controller/controller.php';
?>
