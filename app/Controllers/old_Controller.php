<?php

namespace App\Controllers;

use App\Models\Users;
use App\Controllers\BaseController;

class Controller extends  BaseController
{
	public function __construct()
	{
		parent::__construct();
	}
	public function emailSend()
	{
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		echo "america";			
	 } 
		echo $_POST['msg'];
		echo json_encode(['email'=>'sended']);
	}
	public function userInfo($userInfo)
	{
		print_r($userInfo);
		$user = new Users();
		
		$user->email = $userInfo['email'];
		$user->name = $userInfo['name'];
		$user->save();
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
		$yandexAPI = ['data'=>'test', 'version'=>3];
		$this->render->view('admin.test', ['google'=>'http://google.ru', 'yandex' =>$yandexAPI ]);
		echo '<form method="POST" action="/email/send">';
		echo '<input type="text" name="msg">';
		echo  "<input type='submit' value='Send email'>";
		echo '</form>';
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
