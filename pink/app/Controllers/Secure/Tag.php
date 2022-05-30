<?php

namespace App\Controllers\Secure;

use App\Controllers\BaseController;

use App\Models\Secure\TagModel;

class Tag extends BaseController
{
	protected $TagModel;

	function __construct()
	{
		$this->tagModel = new TagModel;	
	}

	public function index()
	{
		return view('secure/tag/index');
	}

	public function create()
	{
		if ($this->request->getPost('submit')) {
			return $this->save();
		}
		$validation =  \Config\Services::validation();
		return view('secure/tag/create', compact('validation'));
	}

	public function edit($id)
	{
		if ($this->request->getPost('submit')) {
			return $this->update($id);
		}
		$validation =  \Config\Services::validation();
		$item = $this->tagModel->getTagData($id);
		return view('secure/tag/edit', compact('validation', 'item'));
	}

	public function delete($id)
	{
		if ($this->tagModel->remove($id)) {
			return redirect()->to(base_url('secure/tag'))->with('success_message', 'Tag deleted successfully');
		}else{
			return redirect()->to(base_url('secure/tag'))->with('success_message', 'Fail to delete tag');
		}
	}

	public function fetch()
	{
		$this->_check_ajax();
		$response = array(
			'status' 	=> 'success',
			'records' 	=> [],
		);

		$filters 	= [];
		$page 		= 1;
		$export 	= 'N';
		if (strtolower($this->request->getMethod()) == 'post') {
			$response['token'] = csrf_hash();
			$keyword 	= preg_replace('#[^a-zA-Z0-9\s\-\.]#', '', $this->request->getPost('keyword'));
			$page 			= preg_replace('#[^0-9]#', '', $this->request->getPost('page'));
			$status 		= preg_replace('#[^a-zA-Z]#', '', strtoupper($this->request->getPost('status')));
			$export 		= preg_replace('#[^a-zA-Z]#', '', strtoupper($this->request->getPost('export')));
			if (!empty($keyword)) {
				$filters["name"] = $keyword;
			}
			if (!empty($status)) {
				$filters['status'] = $status;
			}
		}

		$start 				 = (($page - 1) * PAGE_LIMIT);
		$records 			 = $this->tagModel->getTag($filters, $start, $export);
		$response['records'] = $records;
		return $this->response->setJSON($response);
	}

	private function save()
	{
		if ($this->request->getMethod() === 'post' && $this->validate([
			'name' 			=> 'required|min_length[3]|max_length[100]',
			'status'  		=> 'required|in_list[ENABLE, DISABLE, BLOCK]',
			// 'description'  	=> 'required|min_length[3]|max_length[100]',
		]))
		{
			$name 			= filter_inp($this->request->getPost('name'));
			$status 		= filter_inp($this->request->getPost('status'));
			$description 	= filter_inp($this->request->getPost('description'));

			$data = [
				'name' 			=> $name,
				'status'  		=> $status,
				'description'	=> $description,
			];
			$msg = 'Tag created successfully';
			$this->tagModel->saveTag($data);
			return redirect()->to(base_url('secure/tag/create'))->with('success_message', $msg);
		}
		return redirect()->back()->withInput();
	}

	private function update($id)
	{
		if ($this->request->getMethod() === 'post' && $this->validate([
			'name' 			=> 'required|min_length[3]|max_length[100]',
			'status'  		=> 'required|in_list[ENABLE, DISABLE, BLOCK]',
			// 'description'  	=> 'required|min_length[3]|max_length[100]',
		]))
		{
			$name 			= filter_inp($this->request->getPost('name'));
			$status 		= filter_inp($this->request->getPost('status'));
			$description 	= filter_inp($this->request->getPost('description'));

			$data = [
				'name' 			=> $name,
				'status'  		=> $status,
				'description'	=> $description,
			];
			$msg = 'Tag updated successfully';
			$this->tagModel->updateTag($id, $data);
			return redirect()->to(base_url('secure/tag'))->with('success_message', $msg);
		}
		return redirect()->back()->withInput();
	}
}
