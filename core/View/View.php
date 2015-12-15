<?php

namespace Core\View;

class View
{
	public    $viewsDir;
	protected $viewFileName;
	
	public function view($viewName, $data)
	{
		$this->viewsDir = '../app/Views/';
		$this->extractViewsName($viewName);
		
		extract($data);
		unset($data);
		
		if(file_exists($this->viewFileName))
		{
			include_once $this->viewFileName;
			
		}else
		{
			echo 'not found view ' . $viewName . '<br>';
			echo 'in ' . substr($this->viewsDir, 3, strlen($this->viewsDir) - 3);
		}
		
	}
	
	private function extractViewsName($viewName)
	{
		$viewsPathArr = preg_split('/\./', $viewName);
		$offset 	  = count($viewsPathArr) - 1;
		$view 		  = implode('/', $viewsPathArr);
		$this->viewFileName = $this->viewsDir . $view . '.php';
	}

}
