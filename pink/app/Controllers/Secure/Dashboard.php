<?php

namespace App\Controllers\Secure;
use App\Controllers\BaseController;

class Dashboard extends BaseController
{

	function __construct()
	{
		
	}

	public function index()
	{
		return view('secure/dashboard');
	}
}