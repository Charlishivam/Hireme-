<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Messenger extends BaseController
{
	public function pushotp()
	{
		$this->_check_ajax();
		$response = array(
			'status' 	=> 'fail',
			'message' 	=> 'Invalid request found!',
			'token' => csrf_hash(),
		);

		$email = filter_inp($this->request->getPost('email'));
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$response['message'] = 'Provided email is not valid';
			return $this->response->setJSON($email);
		}

		$otp = '12345678';
		// $otp = rand(100000,999999);

		$econf = \Config\Services::email();
		$econf->setFrom(FROM_EMAIL, FROM_NAME);
		$econf->setTo($email);
		
		$econf->setSubject('OTP to verify Email for account creation');
		$econf->setMessage($otp . ' is your OTP to verify your email');
		$econf->send();

		$response['message'] = 'OTP has been sent on ' . short_name($email);
		$response['status'] = 'success';
		
		$this->session->set('temail', $email);
		$this->session->set('totp', $otp);
		$this->session->set('otptime', time());

		return $this->response->setJSON($response);
	}

	public function verifyotp()
	{
		$this->_check_ajax();
		$response = array(
			'status' 	=> 'fail',
			'message' 	=> 'Invalid request found!',
			'token' => csrf_hash(),
		);

		$otp = preg_replace('#[^0-9]#', '', $this->request->getPost('otp'));
		if (empty($otp) || strlen($otp) != 8) {
			$response['message'] = 'Provided OTP is not valid';
			return $this->response->setJSON($response);
		}

		$time = $this->session->get('otptime');
		if (!verify_time($time, OTP_VERIFY_TIME)) {
			$response['message'] = 'Time limit exceeded, please regenerate OTP to continue';
			return $this->response->setJSON($response);
		}

		$totp = $this->session->get('totp');
		if (empty($totp)) {
			$response['message'] = 'Session time out, please regenerate OTP to continue';
			return $this->response->setJSON($response);
		}

		if ($totp != $otp) {
			$response['message'] = 'Invalid OTP, please retry';
			return $this->response->setJSON($response);
		}

		$this->session->set('vemail', $this->session->get('temail'));
		$this->session->remove('totp');
		$this->session->remove('temail');
		$this->session->remove('otptime');

		$response['status'] = 'success';
		$response['message'] = 'Email verified successfully';
		return $this->response->setJSON($response);
	}
}