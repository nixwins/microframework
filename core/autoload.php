<?php


function core_autoload($className)
{
	$className = str_replace('../', '', $className);
	$className = str_replace('\\', '/', $className);
	$className = lcfirst($className);
	
	require '../'. $className . '.php';
}

/*function controller_autoload($className)
{
	require '../controllers/' . $className .'.php'; 
}*/

spl_autoload_register('core_autoload');
//spl_autoload_register('controller_autoload');
