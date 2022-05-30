<?php

namespace App\Libraries;

class Messenger
{
	public function pushMessage($to, $name, $msg, $subject)
	{
		$econf = \Config\Services::email();
		$econf->setFrom(FROM_EMAIL, FROM_NAME);
		$econf->setTo($to);
		$econf->setSubject($subject);
		$econf->setMessage($msg);
		$econf->send();

		return ['sent' => 'ok'];
	}

	public function pushAccountCreatedMessage($to, $name)
	{
		$msg = "Dear $name, <br /> Your account has been created successfully";
		$subject = 'Welcome to ' . APP_NAME . ' family';

		$econf = \Config\Services::email();
		$econf->setFrom(FROM_EMAIL, FROM_NAME);
		$econf->setTo($to);
		$econf->setSubject($subject);
		$econf->setMessage($msg);
		$econf->send();
		
		return ['sent' => 'ok'];
	}
}