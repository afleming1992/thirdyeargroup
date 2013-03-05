<?php 
error_reporting(E_ALL);
session_start();
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
 * Sign out
 */
if(isset($_GET['signout']) && $_GET['signout']=1)
	$_SESSION['login'] = false;

/**
 * DATABASE CONNECTION, with PDO object
 * All variables are defined in config/config.php
 */
require_once 'config/config.php';

if(isset($_GET['test']))
	echo "test";

try 
{
	$db = new PDO("mysql:host=$server;dbname=$database",$user,$password);
} 
catch (Exception $e) 
{
	echo "Connection error".$e->getMessage();
}
$section;
require_once 'controller/controller.php';


?>
