<?php

namespace Core\Config;

class AppConfig
{
	private static $debug;
	private static $log;
	
	public static function  setDebugFlag($flag = true)
	{
		self::$debug = $flag;
	}
	public static function getDebugFlag()
	{
		return self::$debug;
	}
	public static function  setLogFlag($flag = true)
	{
		self::$log = $flag;
	}
	public static function getLogFlag()
	{
		return self::$log;
	}
}
