<?php
class Category extends MY_Controller
{
    function __construct(){

        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();
        $this->load->model('Base_model');
        $this->load->helper('data_helper');
		    $this->load->model('admin/Category_model', 'Category_model');
		    $this->load->model('admin/Coustomer_model', 'Coustomer_model');

    }


	//-----------------------------------------------------------
	public function index(){

		$data['title'] = '';
		$data['records'] = $this->Category_model->get_all_category();

		$this->load->view('admin/includes/_header');
		$this->load->view('admin/category/index', $data);
		$this->load->view('admin/includes/_footer');
	}

	//-----------------------------------------------------------
	public function add(){
	  // now code for add product category
		$this->rbac->check_operation_access(); // check opration permission
		$this->form_validation->set_rules('category_name', 'category name', 'required');
        if($this->form_validation->run() == true){ 
			$data['category_name'] 			= $this->input->post('category_name');
     	    $data['category_create_at']        = date('Y-m-d H:i:s');

     	    $this->Base_model->__constomdo_uploads('./uploads/category/','category_image');
            if(!empty($this->upload->data('file_name'))){
              $data['category_image'] = 'uploads/category/'.$this->upload->data('file_name');
            }	 
            if($this->Base_model->_inser_query('dk_category',$data)) {
              $this->session->set_flashdata('success', 'category have been successfully created !');
            $last_id = $this->db->insert_id();
            $this->data['single'] = $this->Base_model->_single_data_query(array('category_id'=>$last_id),'dk_category')->row_array();
            $slug = slugify($this->data['single']['category_name']);
            $category['category_slug']  = $slug.'-'.$last_id;
            $this->Base_model->_update_query('dk_category',$category,array('category_id'=>$last_id));
            }else{
                $this->session->set_flashdata('error', 'Some have error ! please try again ');
            }
            redirect('admin/category');
        }
       
		
    $data['title'] = '';
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/category/add', $data);
		$this->load->view('admin/includes/_footer');
	}



	public function edit(){
		$this->rbac->check_operation_access(); // check opration permission
		$category_id =$this->uri->segment(4);
		$this->data['single'] = $this->Base_model->_single_data_query(array('category_id'=>$category_id ),'dk_category')->row_array();
		
		$this->form_validation->set_rules('category_name', 'category name', 'required');
        if($this->form_validation->run() == true){ 
        	$category_id					= $this->input->post('category_id');
			$data['category_name'] 			= $this->input->post('category_name');
            $slug = slugify($data['category_name']);
            $data['category_slug']  = $slug.'-'.$category_id;
	         $data['category_update_at']        = date('Y-m-d H:i:s');
	         $this->Base_model->__constomdo_uploads('./uploads/category/','category_image');
            if(!empty($this->upload->data('file_name'))){
              $data['category_image'] = 'uploads/category/'.$this->upload->data('file_name');
            }
            if($this->Base_model->_update_query('dk_category',$data,array('category_id'=>$category_id))) {
              $this->session->set_flashdata('success', 'category have been successfully updated !');
            }else{
                $this->session->set_flashdata('error', 'Some have error ! please try again ');
            }
            redirect('admin/category');
        }
     
		$this->data['title'] = '';
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/category/edit', $this->data);
		$this->load->view('admin/includes/_footer');
	}



	//------------------------------------------------------------
	public function delete($id=''){
		$this->rbac->check_operation_access(); // check opration permission
		$category_id =$this->uri->segment(4);
		$this->data['single'] = $this->Base_model->_single_data_query(array('category_id'=>$category_id),'dk_category')->row();
		if($this->Base_model->_delete_query('dk_category',array('category_id'=>$category_id))) {
		  $this->session->set_flashdata('success','category category has been deleted Successfully.');	
		  redirect('admin/category');
		}
	}

	//-----------------------------------------------------------
	public function category_status(){
		$this->rbac->check_operation_access(); // check opration permission
	  $category_id = $this->uri->segment(4);
	  $data['category_status'] = $this->uri->segment(5) == '1' ? '0' : '1';
	  if($this->Base_model->_update_query('dk_category',$data,array('category_id'=>$category_id))) {
			$this->session->set_flashdata('success', 'category status has been changed successfully');
			redirect(base_url('admin/category'));
		}else{
		    $this->session->set_flashdata('errors', 'category category status has not been changed successfully');
			redirect(base_url('admin/category'));
		}
	}


	


}

?>