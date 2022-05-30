<?php

namespace App\Controllers\Secure;

use App\Controllers\BaseController;

use App\Models\Secure\TemplateModel;

class Template extends BaseController
{	
	protected $templateModel;

	function __construct()
	{
		$this->templateModel = new TemplateModel;
	}

	public function index()
	{
		return view('secure/template/index');
	}

	public function create()
	{
		if ($this->request->getPost('submit')) {
			return $this->save();
		}
		$validation =  \Config\Services::validation();
		$categories = $this->templateModel->getCategeory();
		$tags 		= $this->templateModel->getTag();
		return view('secure/template/create', compact('validation', 'categories', 'tags'));
	}

	public function edit($id)
	{
		if ($this->request->getPost('submit')) {
			return $this->update($id);
		}
		$validation =  \Config\Services::validation();
		$item = $this->templateModel->getTemplate($id);
		$categories = $this->templateModel->getCategeory();
		$tags 		= $this->templateModel->getTag();
		return view('secure/template/edit', compact('validation', 'item', 'categories', 'tags'));
	}

	public function delete($id)
	{
		if ($this->templateModel->remove($id)) {
			return redirect()->to(base_url('secure/template'))->with('success_message', 'template deleted successfully');
		}else{
			return redirect()->to(base_url('secure/template'))->with('success_message', 'Fail to delete template');
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
			$page 		= preg_replace('#[^0-9]#', '', $this->request->getPost('page'));
			$status 	= preg_replace('#[^a-zA-Z]#', '', strtoupper($this->request->getPost('status')));
			$export 	= preg_replace('#[^a-zA-Z]#', '', strtoupper($this->request->getPost('export')));
			if (!empty($keyword)) {
				$filters["name"] = $keyword;
			}
			if (!empty($status)) {
				$filters['status'] = $status;
			}
		}

		$start 				 = (($page - 1) * PAGE_LIMIT);
		$records 			 = $this->templateModel->getTemplateData($filters, $start, $export);
		$response['records'] = $records;
		return $this->response->setJSON($response);
	}

	// private function save()
	// {
	// 	if ($this->request->getMethod() === 'post')
	// 	{	
	// 		$validate = $this->validate([
	// 			'name' 			=> 'required|min_length[3]|max_length[100]',
	// 			'slug'  		=> 'required|is_unique[template.slug]|min_length[3]|max_length[100]',
	// 			'status'  		=> 'required|in_list[ENABLE, DISABLE, BLOCK]',
	// 			'category'  	=> 'required|min_length[3]|max_length[100]',
	// 			'description'  	=> 'required|min_length[3]|max_length[500]',
	// 			// 'price'  		=> 'required|numeric',
	// 			// 'discount'  	=> 'required|numeric',
	// 			'tag'  			=> 'required|numeric',
	// 		]);
	// 		if ($validate) {
	// 			$name 			= filter_inp($this->request->getPost('name'));
	// 			$slug 			= filter_inp($this->request->getPost('slug'));
	// 			$status 		= filter_inp($this->request->getPost('status'));
	// 			$category 		= filter_inp($this->request->getPost('category'));
	// 			$description 	= filter_inp($this->request->getPost('description'));
	// 			$price 			= filter_inp($this->request->getPost('price'));
	// 			$discount 		= filter_inp($this->request->getPost('discount'));
	// 			$icon 			= filter_inp($this->request->getPost('icon'));
	// 			$thumbnail 		= filter_inp($this->request->getPost('thumbnail'));
	// 			$startdate 		= filter_inp($this->request->getPost('startdate'));
	// 			$enddate 		= filter_inp($this->request->getPost('enddate'));
	// 			$tag 			= filter_inp($this->request->getPost('tag'));

	// 			if (empty($slug)) {
	// 				$slug = url_title($name, '-', TRUE);
	// 			}
	// 			$data = [
	// 				'name' 			=> $name,
	// 				'slug'  		=> $slug,
	// 				'status'  		=> $status,
	// 				'icon'  		=> $icon,
	// 				'category_id'  	=> $category,
	// 				'description'  	=> $description,
	// 				'price'  		=> $price,
	// 				'discount' 		=> $discount,
	// 				'startdate'		=> $startdate,
	// 				'enddate'		=> $enddate,
	// 				'tag_id'		=> $tag,
	// 			];
	// 			$msg = 'Template created successfully';
	// 			if (!empty($thumbnail)) {
	// 				$isFileUploaded = base64_to_jpeg($thumbnail, 'template');
	// 				if ($isFileUploaded === false) {
	// 					$msg = "Category created successfully but fail to upload file.";
	// 				};
	// 				$data['thumbnail'] = $isFileUploaded['path'];
	// 			}
	// 			$this->templateModel->saveTemplate($data);
	// 			return redirect()->to(base_url('secure/template/create'))->with('success_message', $msg);
	// 		}
	// 		return redirect()->back()->withInput();
	// 	}
	// }

	private function save()
	{
		if ($this->request->getMethod() === 'post')
		{	
			$validate = $this->validate([
				'name' 			=> 'required|min_length[3]|max_length[100]',
				'slug'  		=> 'required|is_unique[template.slug]|min_length[3]|max_length[100]',
				'status'  		=> 'required|in_list[ENABLE, DISABLE, BLOCK]',
				'category'  	=> 'required|min_length[3]|max_length[100]',
				'description'  	=> 'required|min_length[3]|max_length[500]',
				// 'price'  		=> 'required|numeric',
				// 'discount'  	=> 'required|numeric',
				'tag'  			=> 'required|numeric',
			]);
			if ($validate) {
				$name 			= filter_inp($this->request->getPost('name'));
				$slug 			= filter_inp($this->request->getPost('slug'));
				$status 		= filter_inp($this->request->getPost('status'));
				$category 		= filter_inp($this->request->getPost('category'));
				$description 	= filter_inp($this->request->getPost('description'));
				$price 			= filter_inp($this->request->getPost('price'));
				$discount 		= filter_inp($this->request->getPost('discount'));
				$icon 			= filter_inp($this->request->getPost('icon'));
				$thumbnail 		= filter_inp($this->request->getPost('thumbnail'));
				$startdate 		= filter_inp($this->request->getPost('startdate'));
				$enddate 		= filter_inp($this->request->getPost('enddate'));
				$tag 			= filter_inp($this->request->getPost('tag'));

				if (empty($slug)) {
					$slug = url_title($name, '-', TRUE);
				}
				$data = [
					'name' 			=> $name,
					'slug'  		=> $slug,
					'status'  		=> $status,
					'icon'  		=> $icon,
					'category_id'  	=> $category,
					'description'  	=> $description,
					'price'  		=> $price,
					'discount' 		=> $discount,
					'startdate'		=> $startdate,
					'enddate'		=> $enddate,
					'tag_id'		=> $tag,
				];
				$msg = 'Template created successfully';
				if (!empty($thumbnail)) {

					$f = finfo_open();

					
					$imgdata = base64_decode($thumbnail);

					list($imgWidth, $imgHeight, $imgType, $imgAttr,) = getimagesizefromstring($imgdata);

					$nwidth		= 450;
					$nheight	= 650;

					$newimage=imagecreatetruecolor($nwidth,$nheight);

					$source = imagecreatefromstring($imgdata);
					imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$imgWidth,$imgHeight);
					// $file=date('ymdhis').'.jpg';
					$file_name	= date('YmdHis').'.jpg';
					$main_dir 	= WRITEPATH  . "template/";
					$isFileUploaded = imagejpeg($newimage,$main_dir.$file_name);

					if (!$isFileUploaded) {
						$msg = "Category created successfully but fail to upload file.";
					};

					$filePath = "template/".$file_name;
					$data['thumbnail'] = $filePath;
				}
				$this->templateModel->saveTemplate($data);
				return redirect()->to(base_url('secure/template/create'))->with('success_message', $msg);
			}
			return redirect()->back()->withInput();
		}
	}

	private function update($id)
	{
		if ($this->request->getMethod() === 'post')
		{	
			$validate = $this->validate([
				'name' 			=> 'required|min_length[3]|max_length[100]',
				'slug'  		=> 'required|is_unique[template.slug,id,{id}]|min_length[3]|max_length[100]',
				'status'  		=> 'required|in_list[ENABLE, DISABLE, BLOCK]',
				'category'  	=> 'required|min_length[3]|max_length[100]',
				'description'  	=> 'required|min_length[3]|max_length[500]',
				// 'price'  		=> 'required|numeric',
				// 'discount'  	=> 'required|numeric',
				'tag'  			=> 'required|numeric',
			]);
			if ($validate) {
				$name 			= filter_inp($this->request->getPost('name'));
				$slug 			= filter_inp($this->request->getPost('slug'));
				$status 		= filter_inp($this->request->getPost('status'));
				$category 		= filter_inp($this->request->getPost('category'));
				$description 	= filter_inp($this->request->getPost('description'));
				$price 			= filter_inp($this->request->getPost('price'));
				$discount 		= filter_inp($this->request->getPost('discount'));
				$icon 			= filter_inp($this->request->getPost('icon'));
				$thumbnail 		= filter_inp($this->request->getPost('thumbnail'));
				$startdate 		= filter_inp($this->request->getPost('startdate'));
				$enddate 		= filter_inp($this->request->getPost('enddate'));
				$tag 			= filter_inp($this->request->getPost('tag'));

				if (empty($slug)) {
					$slug = url_title($name, '-', TRUE);
				}
				$data = [
					'name' 			=> $name,
					'slug'  		=> $slug,
					'status'  		=> $status,
					'icon'  		=> $icon,
					'category_id'  	=> $category,
					'description'  	=> $description,
					'price'  		=> $price,
					'discount' 		=> $discount,
					'startdate'		=> $startdate,
					'enddate'		=> $enddate,
					'tag_id'		=> $tag,
				];
				$msg = 'template updated successfully';
				if (!empty($thumbnail)) {
					$f = finfo_open();
					$imgdata = base64_decode($thumbnail);

					list($imgWidth, $imgHeight, $imgType, $imgAttr,) = getimagesizefromstring($imgdata);

					$nwidth		= 450;
					$nheight	= 650;

					$newimage=imagecreatetruecolor($nwidth,$nheight);
					$source = imagecreatefromstring($imgdata);
					imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$imgWidth,$imgHeight);
					$file_name	= date('YmdHis').'.jpg';
					$main_dir 	= WRITEPATH  . "template/";
					$isFileUploaded = imagejpeg($newimage,$main_dir.$file_name);

					if (!$isFileUploaded) {
						$msg = "Category created successfully but fail to upload file.";
					};

					$filePath = "template/".$file_name;
					$data['thumbnail'] = $filePath;
				}
				$this->templateModel->updateTemplate($id, $data);
				return redirect()->to(base_url('secure/template'))->with('success_message', $msg);
			}	
		}
		return redirect()->back()->withInput();
	}
}