<?php

namespace App\Controllers;

use App\Controllers\Controller;

class AdminProfileController extends Controller
{
	public function index()
	{
		$this->render->view('admin.test', ['google'=>'Google Map']);
	}	
}
