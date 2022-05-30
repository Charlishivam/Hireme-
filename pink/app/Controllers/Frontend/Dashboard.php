<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\Frontend\FrontendModel;

class Dashboard extends BaseController
{
	protected $frontendModel;

	function __construct()
	{
		$this->frontendModel = new FrontendModel;	
	}

	public function index()
	{
		// if (empty(user())) {
		// 	show_404();
		// 	die;
		// }
		// echo "Dashboard";
		$celibrationList['categeory'] = $this->frontendModel->dashboardCategeory();
		return view('frontend/frontend_dashboard', $celibrationList);
	}

	public function navbarlist() {
		$celibrationList = $this->frontendModel->getCelibrationList();
		$festivalList = $this->frontendModel->getFestivalList();
		$response = [
			'celibration' => $celibrationList,
			'festival'	  => $festivalList	
		];
		$response['token'] = csrf_hash();
		return $this->response->setJSON($response);
	}
}
