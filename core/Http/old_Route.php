<?php
namespace Core\Http;

use Core\Http\RouteRegister;

class Route
{
	public $url;
	public $route;
	private $generedRoute;
	private $className;
	private $action;
	private $paramsCount;
	private $paramsCountRoute;
	private $slashCount;
	private $slashCountUrl;
	private $params = null;
	public  static $register = [];
	
	public static function initRoute($route, $classAction)
	{
		$init = new Route();
		$init->url = $init->getURL();
		//echo count(self::$register);
		/*for($i=0; $i < count($register); $i++)
		{
			$key = array_search($init->url, self::$register[$i]);
		}
		echo "ME: -->";
		var_dump(self::$register);*/
		$init->route = $route;
		//$init->className = $classAction;
		
		$init->slashCount = $init->getParamsAndSlashesCount('slash');
		$init->slashCountUrl = $init->getParamsAndSlashesCount('slash_url');
		$init->paramsCount = $init->getParamsAndSlashesCount();
		$init->generedRoute = $init->getGeneredUrl();
		$init->params = $init->getParams();
		$init->paramsCountRoute = $init->getParamsNameFromRoute(true);
		
		/*$regiter = new RouteRegister();
		$register->url = $init->url;
		$regiter->route = $init->route;
		$regiter->classAction = $classAction;*/
		return $init;
	}
	public static function get($route, $classAction)
	{
		$url = new Route();
		$url->getURL();
		
		if(in_array($route, self::$register))
		{
			
		}else
		{
			self::$register[] = $route . "@" . $classAction;
		}
		$init = self::initRoute($route, $classAction);
		//echo $init->url . "<br>";
		//echo $init->generedRoute;
	
		//self::$register[] =	;
		echo "<pre>";
		//var_dump(self::$register);
		echo "</pre>";
	/*	if( $init->url == $init->generedRoute )
		{
			self::run($route, $classAction);
		}/*
		/*for($i=0; $i < count($paramsArray); $i++)
		{
			if($i == 0)
			{
				$params[$paramsArray[$i]] = $paramsArray[$i + 1];
			}elseif($i%2 == 0)
			{
				$params[$paramsArray[$i]] = $paramsArray[$i + 1];
			}		
		}*/
		//exit();
	}
	public function getRegister()
	{
		return self::$register;
	}
	public static function run()
	{
		
		$init = self::initRoute($route, $classAction);
		if(($init->slashCount + 1) == $init->slashCountUrl)
		{
			$init->slashCountUrl = $init->slashCountUrl - 1;
		}elseif(($init->slashCount - 1) == $init->slashCountUrl)
		{
			$init->slashCountUrl = $init->slashCountUrl + 1;
		}
		 
		if( $init->url == $init->generedRoute /*&& $init->slashCount == $init->slashCountUrl*/)
		{
			 $tempArray = explode("@", $classAction);
			 $className = $tempArray[0];
			 $action = $tempArray[1];
			 $cls =   'Controllers\\' . $className ;
			 $obj = new $cls;
			//if(count($init->params))
			//{
				$obj->$action($init->params);
			//}else
			//{
				//$obj->$action();
				
			//}
		}else
		{
			//echo "The route as " . $init->url;
			echo "<h1> NOT FOUND </h1>";
		}
	}
	public function getParams()
	{
		
		$paramsArray = $this->getParamsArray();
		$paramsCount = $this->getParamsAndSlashesCount();
		$keyName 	 = $this->getParamsNameFromRoute();
		$params 	 = [];

		for($i=0; $i < $this->paramsCount; $i++)
		{
			if(!isset($paramsArray[$i]) || empty($paramsArray[$i])) 
			{		
				echo "<h3 style='color:red'> You lost param!! Created route " . $this->route . "<h3>";
				echo "<h3 style='color:red'> Your url: " . $this->url . "<h3>";
				exit();
			}
			$params[$keyName[0][$i]] = $paramsArray[$i];
		}
		return $params;
	}
	public function getGeneredUrl()
	{
		$url = $this->getURL();
		$paramsArray = $this->getParamsArray();
		$countSlashes = $this->getParamsAndSlashesCount('slash');
		$paramsCount = $this->getParamsAndSlashesCount();
		if($paramsCount == 0)
		{
			return $url;
		}else
		{
			$routeArray = explode('/', $this->route);
			$generedURLArray = array_slice($routeArray, 0, ($countSlashes - $this->paramsCount) + 1);
			array_push($generedURLArray, implode('/', $paramsArray));
		
			return  implode('/', $generedURLArray);
		}
		

	
	}
	public function getParamsArray()
	{
		$countSlashes = $this->getParamsAndSlashesCount('slash');
		$paramsCount = $this->getParamsAndSlashesCount();
		$urlArray = explode('/', $this->url);
		$paramsArray = array_slice($urlArray, ($countSlashes - $this->paramsCount) + 1);
		//echo count($paramsArray);
		return $paramsArray;
		
		
	}
	public function getURL()
	{
		return $_SERVER['REQUEST_URI'];
	}
	public function getParamsAndSlashesCount($which = 'params')
	{
		if($which == 'params')
		{
			return preg_match_all("/(:)\w+/", $this->route, $out);
		}elseif($which == 'slash')
		{
			return 	preg_match_all("/\//", $this->route);
		}elseif($which == 'slash_url')
		{
			return 	preg_match_all("/\//", $this->url);
		}
	
	}
	public function getParamsNameFromRoute($count = false)
	{
		if(!$count)
		{
			preg_match_all("/(:)\w+/", $this->route, $out);
			return $out;
		}elseif($count)
		{
			return preg_match_all("/(:)\w+/", $this->route);
		}
	}
}
