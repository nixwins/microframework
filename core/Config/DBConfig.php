<?php

namespace Core\Config;

class DBConfig
{
	const DNS			= 'mysql';
	const DB_DRIVER 	= 'PDO';
	const DB_HOST 		= 'localhost';
	const DB_USER 		= 'root';
	const DB_PASS		= 'birone89';
	const DB_NAME		= 'ar_test';
	
	public static function getDbConfig()
	{
		
		return [
					'dns'		=> self::DNS,
					'dbDriver'	=> self::DB_DRIVER, 
					'dbHost'	=> self::DB_HOST,
					'dbUser'	=> self::DB_USER, 
					'dbPass'	=> self::DB_PASS,
					'dbName'	=> self::DB_NAME
				];
		
	}
}
