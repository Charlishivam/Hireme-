<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\Auth\RegisterModel;

class Profile extends BaseController
{
	protected $registerModel;

	function __construct()
	{
		$this->registerModel = new RegisterModel;
	}

	public function index() {
		if (empty(user())) {
			show_404();
			die;
		}
		$info = user();
		
		$email = user()->email;
		// $email = 'demo@gmail.com';
		// print_r($email);die;
		$user_profile = $this->registerModel->getUserProfileData($email);

		$user_comp_profile = $this->registerModel->getUserCompanyProfileData($email);

		if ($user_profile) {
			$user_profile->user_image = base_url('FileReader/fetchfile/').'/'. $user_profile->user_image;
		}

		if ($user_comp_profile) {
			$user_comp_profile->company_logo = base_url('FileReader/fetchfile/').'/'. $user_comp_profile->company_logo;
		}
		
		// echo '<pre>';print_r($user_profile);
		// echo '<pre>';print_r($user_comp_profile);die;

		return view('frontend/user_profile',compact('user_profile', 'user_comp_profile'));
	}

	public function updateprofile() {
		$validation =  \Config\Services::validation();
		if ($this->request->getMethod() === 'post' && $this->validate([
			'name' => [
	            'label'  => 'Name',
	            'rules'  => 'trim|required|alpha_space|min_length[3]|max_length[50]',
	            'errors' => [
	                'required' => 'The {field} is required.'
	            ]
			],
			'email' => [
	            'label'  => 'Mail',
	            'rules'  => 'trim|required|valid_email',
	            'errors' => [
	                'required' => 'The {field} is required.'
	            ]
			],
			'mobile' => [
	            'label'  => 'Mobile',
	            'rules'  => 'trim|required|numeric|exact_length[10]|regex_match[/^[6-9]\d{9}$/]',
	            'errors' => [
	                'required' => 'The {field} is required.'
	            ]
			],
			'dob' => [
	            'label'  => 'Date of Date',
	            'rules'  => 'trim|required|valid_date',
	            'errors' => [
	                'required' => 'The {field} is required.'
	            ]
			],
			'anniversary' => [
	            'label'  => 'Anniversary Date',
	            'rules'  => 'trim|required|valid_date',
	            'errors' => [
	                'required' => 'The {field} is required.'
	            ]
			],
			'address' => [
	            'label'  => 'Address',
	            'rules'  => 'trim|required|alpha_numeric_punct|min_length[5]|max_length[100]',
	            'errors' => [
	                'required' => 'The {field} is required.'
	            ]
			],
		]))	{

			$email = $this->request->getPost('email');
			$data = [
			    'name' 			=>  $this->request->getPost('name'),
			    // 'email' 		=>  $this->request->getPost('email'),
			    'mobile' 		=>  $this->request->getPost('mobile'), 
			    'dob' 			=>  $this->request->getPost('dob'), 
			    'anniversary' 	=>  $this->request->getPost('anniversary'), 
			    'address' 		=>  $this->request->getPost('address'),
			];

			$update = $this->registerModel->updateUserData($data, $email);
        	if ($update) {
        		$result['token'] = csrf_hash();
        		$result['status'] = 'true';
        	}
		} else {
			$result['token'] = csrf_hash();
			$result['status'] = 'false';
			$result['errors'] = $validation->getErrors();
		}	

		// echo '<pre>';print_r($result);die;
       	return $this->response->setJSON($result);
	}

	public function companyprofile() {
		// echo '<pre>';print_r($_POST);die;
		$validation =  \Config\Services::validation();
		if ($this->request->getMethod() === 'post' && $this->validate([
			
			'email' => [
	            'label'  => 'Mail',
	            'rules'  => 'trim|required|valid_email',
	            'errors' => [
	                'required' => 'The {field} is required.'
	            ]
			],
			'company_name' => [
	            'label'  => 'Company Name',
	            'rules'  => 'trim|required|alpha_space|min_length[3]|max_length[50]',
	            'errors' => [
	                'required' => 'The {field} is required.'
	            ]
			],
			'company_email' => [
	            'label'  => 'Office E-mail',
	            'rules'  => 'trim|required|valid_email',
	            'errors' => [
	                'required' => 'The {field} is required.'
	            ]
			],
			'company_mobile' => [
	            'label'  => 'Mobile',
	            'rules'  => 'trim|required|numeric|exact_length[10]|regex_match[/^[6-9]\d{9}$/]',
	            'errors' => [
	                'required' => 'The {field} is required.'
	            ]
			],
			'company_address' => [
	            'label'  => 'Company Address',
	            'rules'  => 'trim|required|alpha_numeric_punct|min_length[5]|max_length[100]',
	            'errors' => [
	                'required' => 'The {field} is required.'
	            ]
			],
		]))	{

			$email = $this->request->getPost('email');
			$data = [
			    'company_name' 			=>  $this->request->getPost('company_name'),
			    'company_email' 		=>  $this->request->getPost('company_email'),
			    'company_mobile' 		=>  $this->request->getPost('company_mobile'), 
			    'company_address' 			=>  $this->request->getPost('company_address'), 
			];

			$update = $this->registerModel->updateCompanyData($data, $email);
        	if ($update) {
        		$result['token'] = csrf_hash();
        		$result['status'] = 'true';
        	}
		} else {
			$result['token'] = csrf_hash();
			$result['status'] = 'false';
			$result['errors'] = $validation->getErrors();
			// echo '<pre>';print_r($result['errors']);die;
		}	

		// echo '<pre>';print_r($result);die;
       	return $this->response->setJSON($result);
	}

	public function updatelogo() {

		$file 	= $this->request->getPost('file');
		$email 	= $this->request->getPost('email');

		$isFileUploaded = base64_to_jpeg($file, 'companylogo');

		if ($isFileUploaded === false) {
			$msg = "fail to update Company Logo.";
		};
		$path = $isFileUploaded['path'];
		$update = $this->registerModel->updateCompanyLogo($path, $email);

		if ($update) {
			$filepath = base_url('FileReader/fetchfile/').'/'. $path;
		}

		$result['logo'] = $filepath;
		$result['token'] = csrf_hash();

		return $this->response->setJSON($result);

	}

	public function updatedp() {
		$file 	= $this->request->getPost('file');
		$email 	= $this->request->getPost('email');

		$isFileUploaded = base64_to_jpeg($file, 'userimages');
		

		if ($isFileUploaded === false) {
			$msg = "fail to update Company Logo.";
		};
		$path = $isFileUploaded['path'];
		$update = $this->registerModel->updateUserdp($path, $email);

		if ($update) {
			$filepath = base_url('FileReader/fetchfile/').'/'. $path;
		}

		$result['logo'] = $filepath;
		$result['token'] = csrf_hash();

		return $this->response->setJSON($result);
	}

	public function friendlist() {
		return view('frontend/friend_list');
	}

	public function addfriend() {

		// ad($_POST);
		$validation =  \Config\Services::validation();
		if ($this->request->getMethod() === 'post' && $this->validate([
			'name' => [
	            'label'  => 'Name',
	            'rules'  => 'trim|required|alpha_space|min_length[3]|max_length[50]',
	            'errors' => [
	                'required' => 'The {field} is required.'
	            ]
			],
			'image' => [
	            'label'  => 'Image',
	            'rules'  => 'trim|required',
	            'errors' => [
	                'required' => 'The {field} is required.'
	            ]
			],
			'email' => [
	            'label'  => 'E-mail',
	            'rules'  => 'trim|required|valid_email',
	            'errors' => [
	                'required' => 'The {field} is required.'
	            ]
			],
			'mobile' => [
	            'label'  => 'Mobile',
	            'rules'  => 'trim|required|numeric|exact_length[10]|regex_match[/^[6-9]\d{9}$/]',
	            'errors' => [
	                'required' => 'The {field} is required.'
	            ]
			],
			'dob' => [
	            'label'  => 'Date of Birth',
	            'rules'  => 'trim|required|valid_date',
	            'errors' => [
	                'required' => 'The {field} is required.'
	            ]
			],
			'anniversary' => [
	            'label'  => 'Anniversary',
	            'rules'  => 'trim|required|valid_date',
	            'errors' => [
	                'required' => 'The {field} is required.'
	            ]
			],
			'address' => [
	            'label'  => 'Address',
	            'rules'  => 'trim|required|alpha_numeric_punct|min_length[5]|max_length[100]',
	            'errors' => [
	                'required' => 'The {field} is required.'
	            ]
			],
		]))	{
			
			$file = $this->request->getPost('image') ?? null;
			// ad($file);
			$isFileUploaded = base64_to_jpeg($file, 'friendlist');
			// ad($isFileUploaded);
			if ($isFileUploaded === false) {
				$msg = "fail to update Company Logo.";
			};
			$path = $isFileUploaded['path'];

			$data = [
				'user_email'	=>  user()->email,
			    'name' 			=>  $this->request->getPost('name') ?? null,
			    'image' 		=>  $path ?? null,
			    'mobile' 		=>  $this->request->getPost('mobile') ?? null, 
			    'email' 		=>  $this->request->getPost('email') ?? null, 
			    'dob' 			=>  $this->request->getPost('dob') ?? null, 
			    'anniversary' 	=>  $this->request->getPost('anniversary') ?? null, 
			    'address' 		=>  $this->request->getPost('address') ?? null, 
			];
			// ad($data);
			$data = $this->registerModel->createFriend($data);
        	if ($data) {
        		$result['token'] = csrf_hash();
        		$result['error'] = false;
                $result['msg'] = 'Friend added successfully';
        	}
		} else {
			$result['token'] = csrf_hash();
			$result['error'] = true;
			$result['errors'] = $validation->getErrors();
		}	
       	return $this->response->setJSON($result);
	}

	public function fetch() {
		$this->_check_ajax();
		$response = array(
			'status' 	=> 'success',
			'records' 	=> [],
		);

		$filter = [];
		$page   = 1;
		$export = 'N';
		if (strtolower($this->request->getMethod()) == 'post') {
			$response['token'] = csrf_hash();
			$keyword 	= preg_replace('#[^a-zA-Z0-9\s\-\.]#', '', $this->request->getPost('keyword'));
			$page 		= preg_replace('#[^0-9]#', '', $this->request->getPost('page'));
			// $status 	= preg_replace('#[^a-zA-Z]#', '', strtoupper($this->request->getPost('status')));
			$export 	= preg_replace('#[^a-zA-Z]#', '', strtoupper($this->request->getPost('export')));
			if (!empty($keyword)) {
				$filter["name"] = $keyword;
			}
		}
		$start 		= (($page-1) * PAGE_LIMIT);
		$records	= $this->registerModel->getData($filter, $start, $export);
		foreach ($records as $r) {
			$r->image = base_url('FileReader/fetchfile/').'/'. $r->image;
		}
		// ad($records);
		$response['records'] = $records;
		return $this->response->setJSON($response);
	}

	public function updateFriend() {
		// ad($_POST);
		$validation =  \Config\Services::validation();
		if ($this->request->getMethod() === 'post' && $this->validate([
			'name' => [
	            'label'  => 'Name',
	            'rules'  => 'trim|required|alpha_space|min_length[3]|max_length[50]',
	            'errors' => [
	                'required' => 'The {field} is required.'
	            ]
			],
			'image' => [
	            'label'  => 'Image',
	            'rules'  => 'trim|required',
	            'errors' => [
	                'required' => 'The {field} is required.'
	            ]
			],
			'email' => [
	            'label'  => 'E-mail',
	            'rules'  => 'trim|required|valid_email',
	            'errors' => [
	                'required' => 'The {field} is required.'
	            ]
			],
			'mobile' => [
	            'label'  => 'Mobile',
	            'rules'  => 'trim|required|numeric|exact_length[10]|regex_match[/^[6-9]\d{9}$/]',
	            'errors' => [
	                'required' => 'The {field} is required.'
	            ]
			],
			'dob' => [
	            'label'  => 'Date of Birth',
	            'rules'  => 'trim|required|valid_date',
	            'errors' => [
	                'required' => 'The {field} is required.'
	            ]
			],
			'anniversary' => [
	            'label'  => 'Anniversary',
	            'rules'  => 'trim|required|valid_date',
	            'errors' => [
	                'required' => 'The {field} is required.'
	            ]
			],
			'address' => [
	            'label'  => 'Address',
	            'rules'  => 'trim|required|alpha_numeric_punct|min_length[5]|max_length[100]',
	            'errors' => [
	                'required' => 'The {field} is required.'
	            ]
			],
		]))	{
			
			$file = $this->request->getPost('image') ?? null;
			// ad($file);
			$isFileUploaded = base64_to_jpeg($file, 'friendlist');
			// ad($isFileUploaded);
			if ($isFileUploaded === false) {
				$msg = "fail to update Company Logo.";
			};
			$path 	= $isFileUploaded['path'];
			$email 	= $this->request->getPost('email') ?? null;
			$data = [
				'user_email'	=>  user()->email,
			    'name' 			=>  $this->request->getPost('name') ?? null,
			    'image' 		=>  $path ?? null,
			    'mobile' 		=>  $this->request->getPost('mobile') ?? null, 
			    'email' 		=>  $this->request->getPost('email') ?? null, 
			    'dob' 			=>  $this->request->getPost('dob') ?? null, 
			    'anniversary' 	=>  $this->request->getPost('anniversary') ?? null, 
			    'address' 		=>  $this->request->getPost('address') ?? null, 
			];
			// ad($data);
			$data = $this->registerModel->updateFriend($data, $email);
        	if ($data) {
        		$result['token'] 	= csrf_hash();
        		$result['error'] 	= false;
        		$result['status'] 	= 'true';
                $result['msg'] 		= 'Friend updated successfully';
        	}
		} else {
			$result['token'] 	= csrf_hash();
			$result['error'] 	= true;
			$result['status'] 	= 'false';
			$result['errors'] 	= $validation->getErrors();
		}	
       	return $this->response->setJSON($result);
	}
	
	public function calendar() {
	    $from 	 		= date('Y-m-d');
		$to 			= date('Y-m-d', strtotime('12/31'));
		$dob			= $this->registerModel->getFriendDob($from, $to);
		$anniversary	= $this->registerModel->getFriendAnniversary($from, $to);
		$categeory		= $this->registerModel->getCategeory($from, $to);
		// ad($categeory);

		$finalDob 	= [];
		foreach ($dob as $key => $value) {
			$date 	= strtotime($value->dob);
			$month 	= date('F', $date);
			if (!array_key_exists($month, $finalDob)) {
				$finalDob[$month] = array($value);;
			} else {
				$existData = $finalDob[$month];
				array_push($existData, $value);
				$finalDob[$month] = $existData;
			}
		}

		$finalAnniversary 	= [];
		foreach ($anniversary as $key => $value) {
			$date 	= strtotime($value->anniversary);
			$month 	= date('F', $date);
			if (!array_key_exists($month, $finalAnniversary)) {
				$finalAnniversary[$month] = array($value);;
			} else {
				$existData = $finalAnniversary[$month];
				array_push($existData, $value);
				$finalAnniversary[$month] = $existData;
			}
		}

		$festival 	= [];
		foreach ($categeory as $key => $value) {
			$date 	= strtotime($value->eventdate);
			$month 	= date('F', $date);
			if (!array_key_exists($month, $festival)) {
				$festival[$month] = array($value);;
			} else {
				$existData = $festival[$month];
				array_push($existData, $value);
				$festival[$month] = $existData;
			}
		}

		// ad($finalDob);
		// ad($finalAnniversary);
		// ad($festival);

		// $data['dob'] 			= $finalDob;
		// $data['anniversary'] 	= $finalAnniversary;
		// ad($data);
		//return view('frontend/event_calendar', compact('finalDob', 'finalAnniversary', 'festival'));
		return view('frontend/event_calender', compact('finalDob', 'finalAnniversary', 'festival'));
	}

	public function getcalenderData() {
		$from = date('Y-m-d');
		$to = date('Y-m-d', strtotime('12/31'));
		$response['dob']			= $this->registerModel->getFriendDob($from, $to);
		$response['anniversary']	= $this->registerModel->getFriendAnniversary($from, $to);
		$response['categeory']		= $this->registerModel->getCategeory($from, $to);
		$response['token'] 			= csrf_hash();
		return $this->response->setJSON($response);
	}
}