<?php

namespace App\Controllers\Auth;
use App\Controllers\BaseController;

use App\Models\Auth\LoginModel;
use App\Libraries\Messenger;

class Password extends BaseController
{
	protected $userModel;

	function __construct()
	{
		$this->userModel = new LoginModel;
		$this->messenger = new Messenger;
	}

	public function reset()
	{
		$this->_check_ajax();
		$response = array(
			'status' 	=> 'fail',
			'message' 	=> 'Invalid request',
			'token' => csrf_hash(),
		);

		if (!empty(user())) {
			$response['message'] = 'Unauthorized request';
			return $this->response->setJSON($response);
		}

		$username = preg_replace('#[^a-zA-Z0-9\.\,\_\@]#', '', $this->request->getPost('username'));
		$user = $this->userModel->checkAccount($username);
		if (empty($user)) {
			$response['message'] = 'It seems that user is not registered';
			return $this->response->setJSON($response);
		}
		if ($user->status != 'ENABLE') {
			$response['message'] = accountStatus($user->status);
			return $this->response->setJSON($response);
		}
		$exp_time = time() + LINK_EXPIRATION_TIME;
		$reset_data = $username .'<>'. $exp_time;
		$reset_link = base_url('auth/password/regenerate/'.aesencrypt($reset_data, AES_KEY, 'S'));

		$subject = 'Reset Password';
		$mail_body = '<div style="font-family: sans-serif;padding: 20px;">Hi <strong>'.$user->name.'</strong> <br><br>';
		$mail_body .= '<p style="margin-top:10px;">A password reset for your account was requested.Please click the button below to change your password. Note that this link is valid for 30 minutes. After the time limit has expired, you will have to resubmit the request for a password reset.</p><br>';
		$mail_body .= '<a href="'.$reset_link.'"><span style="color:#fff;background:#171f32;line-height:1.2;border-top:14px solid #171f32;border-bottom:14px solid #171f32;font-weight:700;display:inline-block;text-decoration:none;white-space:nowrap;border-left:12px solid #171f32;text-align:center;font-size:16px;letter-spacing:-0.2px;min-width:80px;border-right:12px solid #171f32;padding:0px 30px;margin-top: 25px;font-family: sans-serif;">Change Your Password</span></a>';
		$mail_body .= '<br><br><br> Regards <br> Team HunarHaat</div>';

		$this->messenger->pushMessage($username, $user->name, $mail_body, $subject);

		$response['status'] = 'success';
		$response['message'] = 'Password reset link has been sent on ' . short_name($username);
		return $this->response->setJSON($response);
	}

	public function regenerate($param = '')
	{
		if (!empty(user())) {
			show_404();
			die;
		}
		$reset_data = aesdecrypt($param, AES_KEY, 'S');
		if (empty($reset_data)) {
			show_404();
			die;	
		}
		$reset_data = explode('<>', $reset_data);
		if (count($reset_data) != 2) {
			show_404();
			die;
		}

		$email = $reset_data[0];
		$time = $reset_data[1];
		$data = [
			'link_expired' => false,
		];
		if (verify_time($time, LINK_EXPIRATION_TIME) == FALSE) {
			$data = [
				'link_expired' => true,
				'message' => 'Link has been expired',
			];
			return view('auth/reset_password', $data);
		}
		
		$user = $this->userModel->checkAccount($email);
		if (empty($user)) {
			$message = 'It seems that user is not registered';
			$data = [
				'link_expired' => true,
				'message' => $message,
			];
			return view('auth/reset_password', $data);
		}
		if ($user->status != 'ENABLE') {
			$message = accountStatus($user->status);
			$data = [
				'link_expired' => true,
				'message' => $message,
			];
			return view('auth/reset_password', $data);
		}

		$data['email'] = $email;
		if ($this->request->getPost('submit')) {
			return $this->resetPassword($user);
		}
		return view('auth/reset_password', $data);
	}

	private function resetPassword($user)
	{
		$password = filter_inp($this->request->getPost('re_password'));
		$password = decrypt_data($password, 'reset_cook');
		if (empty($password)) {
			$message = 'Invalid password found';
			return redirect()->back()->with('message', $message);
		}

		$data = [
			'password' => hash('sha256', $password)
		];
		$res = $this->userModel->updatePassword($user->id, $data);
		if ($res) {
			delete_cookie('reset_cook');
			$message = 'Password updated successfully';
			return redirect()->to(base_url('/home'))->with('success_message', $message);
		}else{
			$message = 'Fail to update password, please try again';
			return redirect()->back()->with('message', $message);
		}
	}
}