<?php

namespace Core\Db;

use \PDO;
use Core\Config\DBConfig;
use Core\Db\IDBProvider;

class DBConnect implements IDBProvider
{
	private $_conn		= null;
	private $_dbDriver	= null;
	private $_dns		= null;
	private $_dbName 	= null;
	private $_dbHost 	= null;
	private $_dbUser 	= null;
	private $_dbPass 	= null;
	
	
	private static $_instance = null;
	
	private function __construct($dbConfig)
	{
		
		$this->_dbDriver = $dbConfig['dbDriver'];
		$this->_dns = $dbConfig['dns'];
		$this->_dbHost = $dbConfig['dbHost'];
		$this->_dbName = $dbConfig['dbName'];
		$this->_dbUser = $dbConfig['dbUser'];
		$this->_dbPass = $dbConfig['dbPass'];
		
		if($this->_dbDriver == 'PDO')
		{
			$this->_conn = new PDO(
							$this->_dns. ":host=" .$this->_dbHost . 
							";dbname=" . $this->_dbName,
							$this->_dbUser,
							$this->_dbPass
							);
		}elseif ($this->_dbDriver == 'mysqli')
		{
			
		}
			
	}
	public static function getInstance()
	{
		$dbConfig = DBConfig::getDbConfig();
		if(self::$_instance == null)
		{
			return self::$_instance = new DBConnect($dbConfig);
		}
		return self::$_instance;
	}
	
	public function getConnection()
	{
		return $this->_conn;
	}
	
	
}
