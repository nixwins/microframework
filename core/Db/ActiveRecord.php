<?php

namespace Core\Db;

use Core\Db\DBConnect;
use Core\Db\IDBProvider;

class ActiveRecord
{
	public $table;
	protected $fields = [];
	protected $properties = [];
	private $_conn = null;
	
	public function setDbConnection(IDBProvider $db)
	{
	
		return	$this->_conn = $db->getConnection();
		
	}
	public function __construct(IDBProvider $db)
	{
		$this->_conn = $db->getConnection();
		$className = strtolower(get_class($this));
		//echo $className;	
		$temp_tbname = str_replace('models\\', '', $className);
		$this->table = strtolower($temp_tbname);
		$this->getColumnName();
	}
	public function __set($name, $value)
	{
		$this->properties[$name] = $value;
	}
	public function __get($name) 
    {
        if (array_key_exists($name, $this->fields)) {
            return $this->properties[$name];
        }
    }
	private function getColumnName()
	{
		 foreach($this->_conn->query("SHOW COLUMNS FROM users") as $column)
		 {
		 	if($column['Extra'] != 'auto_increment')
		 		$this->fields[] = $column['Field'];
		 }
		 return $this->fields;
	}

	public function save()
	{
		$bindParamNames = [];
		
		foreach($this->fields as $field)
		{
			 $bindParamNames[] = ":". $field;	
		}
		var_dump($bindParamNames);
		
		$fields = implode(', ', $this->fields);
		$bindParamNamesString = implode(', ', $bindParamNames);
		$stmt = $this->_conn->prepare("INSERT INTO " . $this->table . " (" . $fields. ") VALUES (" . $bindParamNamesString .  ")");
		foreach($bindParamNames as $param)
		{
			$key = str_replace(':', '', $param);
			$stmt->bindParam($param, $this->properties[$key]);
		}
		$stmt->execute();
		
	}

}
