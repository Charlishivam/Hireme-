<?php

namespace App\Controllers;

class Token extends BaseController
{
	public function regenerate()
	{
		$this->_check_ajax();
		return view('partials/token');
	}
}