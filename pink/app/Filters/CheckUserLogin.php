<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class CheckUserLogin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
    	helper(['common']);
        if (empty(user())) {
        	session_destroy();
        	return redirect()->to(base_url('/home'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}