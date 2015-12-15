<?php

namespace App\Controllers;

class Controller
{
	public function __construct()
	{
		//echo get_class();
	}
	public function test($params)
	{
		//echo "test action";
		echo "->>>>>>> <pre>";
		var_dump($params);
		echo "</pre>";
		echo __METHOD__;
	}
	public function index()
	{
		echo "<h1>" . __METHOD__ . "</h1";
	}
	public function bigTester()
	{
		
		echo 'I\'m big tester';
	}
	public function smallGoogle()
	{
		echo __METHOD__;
	}
	public function usaAction()
	{
		//echo '<meta http-equiv="refresh" content="0.5" > ';
		echo "<h1>" . __METHOD__ . "</h1";
	}
	public function testAction()
	{
		//echo '<meta http-equiv="refresh" content="0.5" > ';
		echo "<h1>" . __METHOD__ . "</h1";
		
	}
	public function last()
	{
		echo "<h1>" . __METHOD__ . "</h1";
	}
}
