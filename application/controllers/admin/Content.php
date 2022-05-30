<?php
class Content extends MY_Controller
{
    function __construct(){

        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();
        $this->load->model('Base_model');
        $this->load->helper('data_helper');
		$this->load->model('admin/Content_model', 'Content_model');
    }


	//-----------------------------------------------------------
	public function index(){

		$data['title'] = '';
		$data['records'] = $this->Content_model->get_all_content();

		$this->load->view('admin/includes/_header');
		$this->load->view('admin/content/index', $data);
		$this->load->view('admin/includes/_footer');
	}

	//-----------------------------------------------------------
	public function add(){

		


	   // now code for add product category
        $this->load->library('upload');
		$this->rbac->check_operation_access(); // check opration permission
		   
		$this->form_validation->set_rules('content_title', 'Content Name', 'required');
		$this->form_validation->set_rules('content_description', 'Content Description', 'required');
        if($this->form_validation->run() == true){ 

        	  $content_name  = $this->input->post('content_title');
		      $slug = slugify($content_name);
              $data['content_title'] = $content_name;
              $data['content_description'] = $this->input->post('content_description');
              $data['content_slug'] = $slug;
              $data['seo_title'] = $this->input->post('seo_title');
              $data['seo_description'] = $this->input->post('seo_description');
              $data['seo_keywords'] = $this->input->post('seo_keywords');
              $data['content_create_at']        = date('Y-m-d H:i:s');
              $this->Base_model->__constomdo_uploads('./uploads/content/','content_image');
              if(!empty($this->upload->data('file_name'))){
                $data['content_image'] = $this->upload->data('file_name');
              }
              
            if($this->Base_model->_inser_query('dk_content',$data)) {
              $this->session->set_flashdata('success', 'Content have been successfully created !');
            }else{
                $this->session->set_flashdata('error', 'Some have error ! please try again ');
            }
            redirect('admin/content');
        }
       

        $data['title'] = '';
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/content/add', $data);
		$this->load->view('admin/includes/_footer');
	}



	public function edit($id){
		$content_id=$this->uri->segment(4);
		
		$this->rbac->check_operation_access(); // check opration permission
        $this->form_validation->set_rules('content_title', 'Content Name', 'required');
		$this->form_validation->set_rules('content_description', 'Content Description', 'required');
        if($this->form_validation->run() == true){ 

              $content_name  = $this->input->post('content_title');
		      $slug = slugify($content_name);
              $data['content_title'] = $content_name;
              $data['content_description'] = $this->input->post('content_description');
              $data['content_slug'] = $slug;
              $data['seo_title'] = $this->input->post('seo_title');
              $data['seo_description'] = $this->input->post('seo_description');
              $data['seo_keywords'] = $this->input->post('seo_keywords');
              $data['content_update_at']        = date('Y-m-d H:i:s');


              $this->Base_model->__constomdo_uploads('./uploads/content/','content_image');
              if(!empty($this->upload->data('file_name'))){
                $data['content_image'] = $this->upload->data('file_name');
                
              }
    
            if($this->Base_model->_update_query('dk_content',$data,array('content_id'=>$id))) {
              $this->session->set_flashdata('success', 'Category have been successfully updated !');
            }else{
                $this->session->set_flashdata('error', 'Some have error ! please try again ');
            }
            redirect('admin/content');
        }


	
		$data['title'] = '';
		$data['record'] = $this->Content_model->get_content_by_id($id);

		
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/content/edit', $data);
		$this->load->view('admin/includes/_footer');
	}

	
	//------------------------------------------------------------
	public function delete($id=''){

		$this->rbac->check_operation_access(); // check opration permission

		$this->Content_model->delete_content($id);

		$this->session->set_flashdata('success','content has been deleted Successfully.');	
		redirect('admin/content');
	}

	//-----------------------------------------------------------
	public function content_status(){

		$this->rbac->check_operation_access(); // check opration permission
	    $id = $this->uri->segment(4);

	    $data['content_status'] = $this->uri->segment(5) == 1 ? 0 : 1;
		$result = $this->Content_model->edit_content($data, $id);
		if($result){
			$this->session->set_flashdata('success', 'Content Status has been changed successfully');
			redirect(base_url('admin/content'));
		}else{
		    $this->session->set_flashdata('errors', 'content Status has not been changed successfully');
			redirect(base_url('admin/content'));
		}
	}


	


}

?>