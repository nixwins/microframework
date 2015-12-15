<?php

namespace Core\Db;

interface IDBProvider
{
	public function getConnection();
}
