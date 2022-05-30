<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Filereader extends BaseController
{
	public function fetchfile($path, $file)
	{  
		$filepath = $path .'/'. $file;
		$image  = file_get_contents(WRITEPATH. $filepath);
		$mimeType = 'image/jpg';
		$this->response
		->setStatusCode(200)
		->setContentType($mimeType)
		->setBody($image)
		->send();
	}

	public function filew()
	{
		$path = filter_inp($this->request->getVar('path'));
		$image  = file_get_contents(WRITEPATH. hex2bin($path));
		$mimeType = 'image/jpg';
		$this->response
		->setStatusCode(200)
		->setContentType($mimeType)
		->setBody($image)
		->send();
	}

	public function filev()
	{
		$path = filter_inp($this->request->getVar('path'));
		$image  = file_get_contents(WRITEPATH. hex2bin($path));
		$mimeType = 'video/mp4';
		$this->response
		->setStatusCode(200)
		->setContentType($mimeType)
		->setBody($image)
		->send();
	}
}
