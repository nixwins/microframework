<?php

namespace Core\Http;

use Core\Http\Route;

class RouteRegister
{
	public $route;
	public $url;
	public $classAction;
	public function test()
	{
		$mass = new Route();
		$route = implode($mass->getRegister(), "@");
		$objRoute = new Route();
		//$init->route= $route;
		$generedUrl = $objRoute->getGeneredUrl();
		echo "GEN: " . $generedUrl;
		echo "<pre>";
		var_dump($mass->getRegister());
		echo "</pre>";
	}
	public function get($route, $classAction)
	{
		echo "dfsd " . $classAction;
		$init = new  RouteRegister();
		$init->route= $route;
		$init->classAction = $classAction;
		$url = $_SERVER['REQUEST_URI'];
		$objRoute = new Route();
		$objRoute->route = $this->route;
		$objRoute->url = $url;
		$generedUrl = $objRoute->getGeneredUrl();
		
		//$route = '/ma';
		//echo "THIS: " . $this->classAction;
		if($url == $generedUrl)
		{
			Route::get($route, $classAction);
		}
	}
	public function run()
	{
		$this->get();
		/*	echo "THIS: " . $this->classAction;
		$url = $_SERVER['REQUEST_URI'];
		$objRoute = new Route();
		$objRoute->route = $this->route;
		$objRoute->url = $url;
		$generedUrl = $objRoute->getGeneredUrl();
		
		//$route = '/ma';
		//echo "THIS: " . $this->classAction;
		if($url == $generedUrl)
		{
			Route::get($this->route, $this->classAction);
		}*/
	}
}