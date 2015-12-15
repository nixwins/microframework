<?php

namespace Core\Db;

use Core\Db\IDBProvider;
use Core\Db\DBConnect;
use Core\Db\ActiveRecord;

class Factory implements IDBProvider
{
	private $_instance;
	
	private function getInstance()
	{
		return $this->_instance = DBConnect::getInstance();
	}
	
	public function  getConnection()
	{
		//var_dump($this->getInstance()->getConnection());
		return  $this->getInstance()->getConnection();
	}
}
