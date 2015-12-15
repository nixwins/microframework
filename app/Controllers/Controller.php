<?php

namespace App\Controllers;

use Core\View\View;

class Controller
{
	protected $render;
	
	public function main()
	{
		echo 'Welcome to MicroFramework!!';
	}
	public function __construct()
	{
		$this->render = new View();
	}
		
} 