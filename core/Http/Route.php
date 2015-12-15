<?php

namespace Core\Http;

use Core\Config\AppConfig;

class Route 
{
	private static $routes = [];
	private 		 $url;
	private static $paramsName = [];
	private			 $params;
	
	public static function get($route, $controllerAction)
	{
		//self::$currentRoute = $route;
		$routes = preg_split('/:/', $route);
		self::$routes[$routes[0]] = $controllerAction;
		$tempArr = [];
		for ($i=1; $i < count($routes);	 $i++) 
		{
			if(!empty($routes[$i]))
			{
				if(count($routes) > 0)
				{
					$tempArr[]	= preg_replace("#/$#", "", $routes[$i]);
					self::$paramsName[$controllerAction ] =  $tempArr;
				}
				
			} 
			
		}	
	}
	
	public function run()
	{
		$this->url = $this->getUrl();
		$this->getGeneredRoute();
	
		if(array_key_exists($this->url, self::$routes))
		{
			$controllerActionArr = explode('@', self::$routes[$this->url]);
			$controllerName = 'App\\Controllers\\' . $controllerActionArr[0];
			$actionName = $controllerActionArr[1];
			$controller = new $controllerName();
			if(!empty($this->params))
			{
				$controller->$actionName($this->params);
			}else
			{
				$controller->$actionName();
			}
			
		}else
		{
			$this->notFound('Route not found');
		}
		
	}

	private function getGeneredRoute()
	{
		$urlArr = preg_split('@\/@', $this->url);
		foreach (self::$routes as $key => $value)
		{	
			$tempKey = substr($this->getUrl(), 0, strlen($key));
			$tempRoute = str_replace('/', '\/', $key);
			$pattern = '@('. $tempRoute . ')@';
			if(preg_match($pattern, $tempKey))
			{
				$urlCount = count($urlArr);
				$routeCount = count(explode("/", $tempKey));
				
				if(!empty(self::$paramsName[$value]))
				{
					$paramsCount = count(self::$paramsName[$value]);
					$routeCount = ($routeCount - 1) + $paramsCount;	
					
				}
			
				if($routeCount == $urlCount && !empty(self::$paramsName[$value]))
				{
					self::$routes[$this->url] = $value;
					unset(self::$routes[$key]);
					$paramsName = self::$paramsName[$value];
					$paramsValue = array_slice($urlArr, $urlCount - count(self::$paramsName[$value]));
					$this->setParams($paramsName, $paramsValue);					
				}elseif($this->url == $key)
				{
					
				}elseif($routeCount != $urlCount and !preg_match($pattern, $tempKey))
				{
					if(!empty(self::$paramsName[$value]))
					{
						$this->notFound($key, self::$paramsName[$value]);	
					}else
					{
						$this->notFound($key);
					}
					
				}
			}
		}
	}
	
	private function setParams($paramsName, $paramsValue)
	{
		$paramsCount = count($paramsName);
		for($i=0; $i<$paramsCount; $i++)
		{
			$this->params[$paramsName[$i]] = $paramsValue[$i];
		}
	}
	private function notFound($route, $params='')
	{
		echo "<h1> Page: " . $_SERVER['HTTP_HOST']. $this->url .  " not found</h1>";
		
		
		if(AppConfig::getDebugFlag())
		{
		   echo "<h2> Your route: " . $route.  " in routes.php </h2>";
		   
		   if($params != '')
		   {
		   	 echo "<h3> Params: " . implode('/', $params) .  "</h3>";
		   }
		   
		   debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
		  
		   
		}
		if(AppConfig::getLogFlag())
		{
		   error_log("Page: " . $_SERVER['HTTP_HOST']. $this->url .  "\n", 3, '../logs/log.log');
		   error_log("Your route: " . $route.  " in routes.php", 3, '../logs/log.log');
		   //error_log(implode(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS), '/'), 3, '../logs/log.log');
		}
		
		
	}
	private function getUrl()
	{
		$url = $_SERVER['REQUEST_URI'];
		return preg_replace("#/$#", "", $url); 
	}	

}
