<?php

namespace Models;

use Core\Db\ActiveRecord;
use Core\Db\DBConnect;

class Users extends ActiveRecord
{
	public function __construct()
	{
		$conn = DBConnect::getInstance();
		parent::__construct($conn);
	}
}
