<?php

namespace App\Controllers\BackendAuth;
use App\Controllers\BaseController;

use App\Models\BackendAuth\LoginModel;

class Login extends BaseController
{
	protected $loginModel;

	function __construct()
	{
		$this->loginModel = new LoginModel;
	}

	public function index()
	{
		if (!empty(admin())) {
			return redirect()->to(base_url('secure/dashboard'));
		}
		if ($this->request->getPost('submit')) {
			return $this->checkUser();
		}
		$title = 'Admin Login';
		return view('auth/login', compact('title'));
	}

	public function user()
	{
		$this->_check_ajax();
		$response = array(
			'status' 	=> 'fail',
			'message' 	=> 'Invalid username or password',
			'token' => csrf_hash(),
		);

		$username = preg_replace('#[^a-zA-Z0-9\.\,\_\@]#', '', $this->request->getPost('username'));
		$password 	= filter_inp($this->request->getPost('password'));
		$password 	= decrypt_data($password, 'uauth_cook');
		if ($password == FALSE) {
			return $this->response->setJSON($response);
		}
		$user = $this->loginModel->checkAccount($username);
		if (empty($user)) {
			$response['message'] = 'It seems that user is not registered';
			return $this->response->setJSON($response);
		}
		if ($user->status != 'ENABLE') {
			$response['message'] = accountStatus($user->status);
			return $this->response->setJSON($response);
		}

		if (checkPass($password, $user->password) === FALSE) {
			return $this->response->setJSON($response);
		}
		delete_cookie('uauth_cook');
		$user->login_time = time();
		$this->session->set('user', $user);
		$response['status'] = 'success';
		$response['message'] = 'Logged in successfully';
		return $this->response->setJSON($response);
	}
	
	private function checkUser()
	{
		$username 	= preg_replace('#[^a-zA-Z0-9\@\.\-\_]#', '', $this->request->getPost('username'));
		if (empty($username)) {
			return redirect()->back()->with('message', 'Username / Email is required');
		}
		$password 	= filter_inp($this->request->getPost('password'));
		$password 	= decrypt_data_new($password);
		if ($password == FALSE) {
			return redirect()->back()->with('message', 'Invalid password, please try again');
		}
		
		if (strlen($password) < 5) {
			return redirect()->back()->with('message', 'Invalid password, please try again');
		}

		$user = $this->loginModel->checkUser($username);
		if (empty($user)) {
			return redirect()->back()->with('message', 'Invalid user found.!');
		}

		if ($user->status != 'ENABLE') {
			return redirect()->back()->with('message', accountStatus($user->status));
		}
		$pwd1 = hash('sha256',$password);
		$pwd2 = $user->password;
		if ($pwd1 !== $pwd2) {
			return redirect()->back()->with('message', 'Invalid username or password.!');
		}
		delete_cookie('auth_cook');
		$user->login_time = time();
		$this->session->set('admin', $user);
		return redirect()->to(base_url('secure/dashboard'));
	}

	public function logout()
	{
		session_destroy();
		return redirect()->to(base_url('/admin'));
	}
}