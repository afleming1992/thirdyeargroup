<?php
/**
 * Autoloading classes from model folder when PHP instruction 'new MyClass'
 * @param String $className
 */
function loadClass($className)
{
	require_once '../model/'.$className.'.class.php';
}
spl_autoload_register ('loadClass');
?>
