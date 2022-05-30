<?php

namespace App\Controllers\Secure;

use App\Controllers\BaseController;

use App\Models\Secure\UserModel;

class User extends BaseController
{
	protected $userModel;

	function __construct()
	{
		$this->userModel = new UserModel;	
	}

	public function users()
	{
		$pagetype = 'Users';
		return view('secure/users/index', compact('pagetype'));
	}

	public function show($id)
	{
		$item 		= $this->userModel->getUser($id);
		// echo '<pre>';print_r($item);die;
		if (empty($item)) {
			show_404();
			die;
		}
		if ($this->request->getPost('submit')) {
			return $this->update($id);
		}
		$type = 'User';
		return view('secure/users/show', compact('item', 'type'));
	}

	public function delete($id)
	{
		if ($this->userModel->remove($id)) {
			return redirect()->to(base_url('secure/user/show/'.$id))->with('success_message', 'User deleted successfully');
		}else{
			return redirect()->to(base_url('secure/user/show/'.$id))->with('success_message', 'Fail to delete user');
		}
	}

	public function fetch()
	{
		$this->_check_ajax();
		$response = array(
			'status' 	=> 'success',
			'records' 	=> [],
		);

		$page 	= 1;
		$export = 'N';
		$filters = [];
		
		if (strtolower($this->request->getMethod()) == 'post') {
			$response['token'] = csrf_hash();
			$keyword 	= preg_replace('#[^a-zA-Z0-9\s\-\.]#', '', $this->request->getPost('keyword'));
			$page = preg_replace('#[^0-9]#', '', $this->request->getPost('page'));
			$status = preg_replace('#[^a-zA-Z]#', '', strtoupper($this->request->getPost('status')));
			$export = preg_replace('#[^a-zA-Z]#', '', strtoupper($this->request->getPost('export')));
			if (!empty($keyword)) {
				$filters["name"] = $keyword;
			}
			if (!empty($status)) {
				$filters['status'] = $status;
			}
		}

		$start 				 = (($page - 1) * PAGE_LIMIT);
		$records 			 = $this->userModel->getUsers($filters, $start, $export);
		foreach ($records as $r) {
			$r->thumbnail = !empty($r->thumbnail) ? file_path($r->thumbnail) : default_user_thumbnail();
		}

		$response['records'] = $records;
		return $this->response->setJSON($response);
	}

	private function update($id)
	{
		if ($this->request->getMethod() === 'post' && $this->validate([
			'status'  => 'required|in_list[ENABLE, DISABLE, BANNED]',
		]))
		{
			$status = filter_inp($this->request->getPost('status'));
			$data = [
				'status'  => $status,
			];
			$msg = 'User updated successfully';
			$this->userModel->updateUser($id, $data);
			return redirect()->to(base_url('secure/user/show/'.$id))->with('success_message', $msg);
		}
		return redirect()->back()->withInput();
	}
}
