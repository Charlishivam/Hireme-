<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\Auth\RegisterModel;
use App\Libraries\Messenger;

class Register extends BaseController
{
	protected $registerModel, $messenger;

	function __construct()
	{
		$this->registerModel = new RegisterModel;
		$this->messenger = new Messenger;
	}

	public function user()
	{
		$this->_check_ajax();
		$response = array(
			'status' 	=> 'fail',
			'message' 	=> 'Invalid user data found, please retry',
			'stage' 	=> 1,
			'token' => csrf_hash(),
		);

		$fullname = preg_replace('#[^A-Za-z\s\.]#', '', ucwords(strtolower($this->request->getPost('fullname'))));
		if (empty($fullname) || strlen($fullname) < 2) {
			$response['message'] = 'Provided name is not valid';
			return $this->response->setJSON($response);
		}
		$email 		= $this->session->get('vemail');
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$response['message'] = 'Provided email is not valid';
			return $this->response->setJSON($response);
		}

		$isUnique = $this->registerModel->isUnique('email', $email);
		if ($isUnique > 0) {
			$response['stage'] 	 = -1;
			$response['message'] = 'Email is already in use please try with different email';
			return $this->response->setJSON($response);	
		}

		$mobile = preg_replace('#[^0-9]#', '', $this->request->getPost('mobile'));
		if ($mobile < 6000000000) {
			$response['message'] = 'Provided mobile is not valid';
			return $this->response->setJSON($response);
		}

		$isUnique = $this->registerModel->isUnique('mobile', $mobile);
		if ($isUnique > 0) {
			$response['message'] = 'Mobile is already in use please try with different mobile';
			return $this->response->setJSON($response);	
		}

		$password 	= filter_inp($this->request->getPost('password'));
		$password 	= decrypt_data($password, 'rauth_cook');
		if ($password == FALSE) {
			$response['message'] = 'Password is not valid';
			return $this->response->setJSON($response);
		}

		$type = preg_replace('#[^A-Za-z]#', '', $this->request->getPost('type'));
		if (empty($type)) {
			$type = 'S';
			$profile_status = 3; 
		}else{
			$type = 'I';
			$profile_status = 1;
		}

		$data = [
			'name' 	=> $fullname,
			'email' => $email,
			'mobile' => $mobile,
			'password' => hash('sha256', $password),
			'status' => 'ENABLE',
			'user_type' => $type,
			'profile_status' => $profile_status,
		];

		$res = $this->registerModel->createUser($data);
		if ($res) {
			$this->session->set('user', json_decode(json_encode($data)));
			$this->session->remove('vemail');
			$this->messenger->pushAccountCreatedMessage($email, $fullname);
			$response['status'] = 'success';
			$response['message'] = 'Account created successfully';
			
		}
		else{
			$response['message'] = 'Fail to create account, please try again later';
		}
		return $this->response->setJSON($response);
	}
}