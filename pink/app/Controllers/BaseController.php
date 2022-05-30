<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\NavigationModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends Controller
{
	/**
	 * Instance of the main Request object.
	 *
	 * @var IncomingRequest|CLIRequest
	 */
	protected $request;

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['form', 'common', 'cookie', 'date','url'];

	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.: $this->session = \Config\Services::session();
		$this->session 	= \Config\Services::session();
		$this->cache 	= \Config\Services::cache();
		//$this->_build_menu(false);
	}

	function __construct()
	{

	}

	protected function _check_ajax()
	{
		if ($this->request->isAJAX() == FALSE) {
			die(json_encode(array(
				'status' => FALSE,
				'message' => 'Direct access not allowed',
			)));
		}
	}

	private function _build_menu($refresh)
	{
		if ($refresh == false) {
			if (!empty(getCache('navigation'))) {
				return true;
			}
		}
		
		$navigation = new NavigationModel;
		$navdata = $navigation->getMenuData();
		$data = [];

		foreach ($navdata['categories'] as $c) {
			foreach ($navdata['subcategories'] as $s) {
				foreach ($navdata['topics'] as $t) {
					if ($t->category_id == $c->id && $t->subcategory_id == $s->id) {
						$s->topics[] = $t;
					}
				}
				if ($s->category_id == $c->id) {
					$c->subcategories[] = $s;
				}
			}
			$data[] = $c;
		}
		saveCache('navigation', $data);
	}
}
