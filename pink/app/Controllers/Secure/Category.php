<?php

namespace App\Controllers\Secure;

use App\Controllers\BaseController;

use App\Models\Secure\CategoryModel;

class Category extends BaseController
{
	protected $categoryModel;

	function __construct()
	{
		$this->categoryModel = new CategoryModel;	
	}

	public function index()
	{
		return view('secure/categories/index');
	}

	public function create()
	{
		if ($this->request->getPost('submit')) {
			return $this->save();
		}
		$validation =  \Config\Services::validation();
		return view('secure/categories/create', compact('validation'));
	}

	public function edit($id)
	{
		if ($this->request->getPost('submit')) {
			return $this->update($id);
		}
		$validation =  \Config\Services::validation();
		$item = $this->categoryModel->getCategory($id);
		return view('secure/categories/edit', compact('validation', 'item'));
	}

	public function delete($id)
	{
		if ($this->categoryModel->remove($id)) {
			return redirect()->to(base_url('secure/category'))->with('success_message', 'Category deleted successfully');
		}else{
			return redirect()->to(base_url('secure/category'))->with('success_message', 'Fail to delete category');
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
		$records 			 = $this->categoryModel->getCategories($filters, $start, $export);
		$response['records'] = $records;
		return $this->response->setJSON($response);
	}

	private function save()
	{	
		if ($this->request->getMethod() === 'post'){
			$type 			= filter_inp($this->request->getPost('type'));
			if ($type == "POLITICAL") {
				$validate = $this->validate([
					'name' 			=> 'required|min_length[3]|max_length[100]',
					'slug'  		=> 'required|is_unique[categories.slug]|min_length[3]|max_length[100]',
					'status'  		=> 'required|in_list[ENABLE, DISABLE, BLOCK]',
					'type'  		=> 'required|in_list[CELEBRATION, FESTIVAL, POLITICAL]',
					'eventdate'  	=> 'required',
					'party'  		=> 'required',
				]);
			} else {
				$validate = $this->validate([
					'name' 			=> 'required|min_length[3]|max_length[100]',
					'slug'  		=> 'required|is_unique[categories.slug]|min_length[3]|max_length[100]',
					'status'  		=> 'required|in_list[ENABLE, DISABLE, BLOCK]',
					'type'  		=> 'required|in_list[CELEBRATION, FESTIVAL, POLITICAL]',
					'eventdate'  	=> 'required',
				]);
			}

			if ($validate)
			{
				$name 			= filter_inp($this->request->getPost('name'));
				$slug 			= filter_inp($this->request->getPost('slug'));
				$status 		= filter_inp($this->request->getPost('status'));
				$icon 			= filter_inp($this->request->getPost('icon'));
				$thumbnail 		= filter_inp($this->request->getPost('thumbnail'));
				$description 	= filter_inp($this->request->getPost('description'));
				$startdate 		= filter_inp($this->request->getPost('startdate'));
				$enddate 		= filter_inp($this->request->getPost('enddate'));
				$type 			= filter_inp($this->request->getPost('type'));
				$eventdate 		= filter_inp($this->request->getPost('eventdate'));
				$party 			= filter_inp($this->request->getPost('party'));

				if (empty($slug)) {
					$slug = url_title($name, '-', TRUE);
				}
				$data = [
					'name' 			=> $name,
					'slug'  		=> $slug,
					'status'  		=> $status,
					'icon'  		=> $icon,
					'description'	=> $description,
					'startdate'		=> $startdate,
					'enddate'		=> $enddate,
					'type'			=> $type,
					'eventdate'		=> $eventdate,
					'party'			=> $party,
				];

				$msg = 'Category created successfully';
				if (!empty($thumbnail)) {
					$isFileUploaded = base64_to_jpeg($thumbnail, 'categories');
					if ($isFileUploaded === false) {
						$msg = "Category created successfully but fail to upload file.";
					};
					$data['thumbnail'] = $isFileUploaded['path'];
				}
				$this->categoryModel->saveCategory($data);
				return redirect()->to(base_url('secure/category/create'))->with('success_message', $msg);
			}
			return redirect()->back()->withInput();
		}
	}

	private function update($id)
	{
		if ($this->request->getMethod() === 'post'){
			$type 			= filter_inp($this->request->getPost('type'));
			if ($type == "POLITICAL") {
				$validate = $this->validate([
					'name' 			=> 'required|min_length[3]|max_length[100]',
					'slug'  		=> 'required|min_length[3]|max_length[100]',
					'status'  		=> 'required|in_list[ENABLE, DISABLE, BLOCK]',
					'type'  		=> 'required|in_list[CELEBRATION, FESTIVAL, POLITICAL]',
					'eventdate'  	=> 'required',
					'party'  		=> 'required',
				]);
			} else {
				$validate = $this->validate([
					'name' 			=> 'required|min_length[3]|max_length[100]',
					'slug'  		=> 'required|min_length[3]|max_length[100]',
					'status'  		=> 'required|in_list[ENABLE, DISABLE, BLOCK]',
					'type'  		=> 'required|in_list[CELEBRATION, FESTIVAL, POLITICAL]',
					'eventdate'  	=> 'required',
				]);
			}

			if ($validate) {
				$name 			= filter_inp($this->request->getPost('name'));
				$slug 			= filter_inp($this->request->getPost('slug'));
				$status 		= filter_inp($this->request->getPost('status'));
				$icon 			= filter_inp($this->request->getPost('icon'));
				$thumbnail 		= filter_inp($this->request->getPost('thumbnail'));
				$description 	= filter_inp($this->request->getPost('description'));
				$startdate 		= filter_inp($this->request->getPost('startdate'));
				$enddate 		= filter_inp($this->request->getPost('enddate'));
				$type 			= filter_inp($this->request->getPost('type'));
				$eventdate 		= filter_inp($this->request->getPost('eventdate'));
				$party 			= filter_inp($this->request->getPost('party'));

				if (empty($slug)) {
					$slug = url_title($name, '-', TRUE);
				}
				$data = [
					'name' 			=> $name,
					'slug'  		=> $slug,
					'status'  		=> $status,
					'icon'  		=> $icon,
					'description'  	=> $description,
					'startdate'		=> $startdate,
					'enddate'		=> $enddate,
					'type'			=> $type,
					'eventdate'		=> $eventdate,
					'party'			=> $type == "POLITICAL" ? $party : '',
				];
				$msg = 'Category updated successfully';
				if (!empty($thumbnail)) {
					$isFileUploaded = base64_to_jpeg($thumbnail, 'categories');
					if ($isFileUploaded === false) {
						$msg = "Category upddated successfully but fail to upload file.";
					};
					$data['thumbnail'] = $isFileUploaded['path'];
					$item = $this->categoryModel->getCategory($id);
					if (!empty($item->thumbnail)) {
						remove_file($item->thumbnail);
					}
				}
				$this->categoryModel->updateCategory($id, $data);
				return redirect()->to(base_url('secure/category'))->with('success_message', $msg);
			}
			return redirect()->back()->withInput();
		}
	}
}
