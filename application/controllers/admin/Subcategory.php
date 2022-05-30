<?php
class Subcategory extends MY_Controller
{
    function __construct(){

        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();
        $this->load->model('Base_model');
        $this->load->helper('data_helper');
		    $this->load->model('admin/Subcategory_model', 'Subcategory_model');
		    $this->load->model('admin/Coustomer_model', 'Coustomer_model');

    }


	//-----------------------------------------------------------
	public function index(){

		$data['title'] = '';
		$data['records'] = $this->Subcategory_model->get_all_subcategory();

		$this->load->view('admin/includes/_header');
		$this->load->view('admin/subcategory/index', $data);
		$this->load->view('admin/includes/_footer');
	}

	//-----------------------------------------------------------
	public function add(){
	  // now code for add product subcategory
		$this->rbac->check_operation_access(); // check opration permission
		$this->form_validation->set_rules('subcategory_name', 'subcategory name', 'required');
        if($this->form_validation->run() == true){ 
			$data['category_id'] 			= $this->input->post('category_id');
			$data['subcategory_name'] 			= $this->input->post('subcategory_name');
     	    $data['subcategory_create_at']        = date('Y-m-d H:i:s');

     	    $this->Base_model->__constomdo_uploads('./uploads/subcategory/','subcategory_image');
            if(!empty($this->upload->data('file_name'))){
              $data['subcategory_image'] = 'uploads/subcategory/'.$this->upload->data('file_name');
            }	 
            if($this->Base_model->_inser_query('dk_subcategory',$data)) {
              $this->session->set_flashdata('success', 'subcategory have been successfully created !');
            $last_id = $this->db->insert_id();
            $this->data['single'] = $this->Base_model->_single_data_query(array('subcategory_id'=>$last_id),'dk_subcategory')->row_array();
            $slug = slugify($this->data['single']['subcategory_name']);
            $subcategory['subcategory_slug']  = $slug.'-'.$last_id;
            $this->Base_model->_update_query('dk_subcategory',$subcategory,array('subcategory_id'=>$last_id));
            }else{
                $this->session->set_flashdata('error', 'Some have error ! please try again ');
            }
            redirect('admin/subcategory');
        }

        $this->data['category_name'] = $this->Base_model->_dropdownlist('category_id','category_name',array('category_status'=>'1'),'dk_category','Select Category Name','');
        $this->data['title'] = '';
       
		
        
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/subcategory/add', $this->data);
		$this->load->view('admin/includes/_footer');
	}



	public function edit(){
		$this->rbac->check_operation_access(); // check opration permission
		$subcategory_id =$this->uri->segment(4);
		$this->data['single'] = $this->Base_model->_single_data_query(array('subcategory_id'=>$subcategory_id ),'dk_subcategory')->row_array();
		
		$this->form_validation->set_rules('subcategory_name', 'subcategory name', 'required');
        if($this->form_validation->run() == true){ 
        	$subcategory_id					= $this->input->post('subcategory_id');
        	$data['category_id'] 			= $this->input->post('category_id');
			$data['subcategory_name'] 			= $this->input->post('subcategory_name');
            $slug = slugify($data['subcategory_name']);
            $data['subcategory_slug']  = $slug.'-'.$subcategory_id;
	         $data['subcategory_update_at']        = date('Y-m-d H:i:s');
	         $this->Base_model->__constomdo_uploads('./uploads/subcategory/','subcategory_image');
            if(!empty($this->upload->data('file_name'))){
              $data['subcategory_image'] = 'uploads/subcategory/'.$this->upload->data('file_name');
            }
            if($this->Base_model->_update_query('dk_subcategory',$data,array('subcategory_id'=>$subcategory_id))) {
              $this->session->set_flashdata('success', 'subcategory have been successfully updated !');
            }else{
                $this->session->set_flashdata('error', 'Some have error ! please try again ');
            }
            redirect('admin/subcategory');
        }
        $this->data['category_name'] = $this->Base_model->_dropdownlist('category_id','category_name',array('category_status'=>'1'),'dk_category','Select Category Name','');
     
		$this->data['title'] = '';
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/subcategory/edit', $this->data);
		$this->load->view('admin/includes/_footer');
	}



	//------------------------------------------------------------
	public function delete($id=''){
		$this->rbac->check_operation_access(); // check opration permission
		$subcategory_id =$this->uri->segment(4);
		$this->data['single'] = $this->Base_model->_single_data_query(array('subcategory_id'=>$subcategory_id),'dk_subcategory')->row();
		if($this->Base_model->_delete_query('dk_subcategory',array('subcategory_id'=>$subcategory_id))) {
		  $this->session->set_flashdata('success','subcategory subcategory has been deleted Successfully.');	
		  redirect('admin/subcategory');
		}
	}

	//-----------------------------------------------------------
	public function subcategory_status(){
		$this->rbac->check_operation_access(); // check opration permission
	  $subcategory_id = $this->uri->segment(4);
	  $data['subcategory_status'] = $this->uri->segment(5) == '1' ? '0' : '1';
	  if($this->Base_model->_update_query('dk_subcategory',$data,array('subcategory_id'=>$subcategory_id))) {
			$this->session->set_flashdata('success', 'subcategory status has been changed successfully');
			redirect(base_url('admin/subcategory'));
		}else{
		    $this->session->set_flashdata('errors', 'subcategory subcategory status has not been changed successfully');
			redirect(base_url('admin/subcategory'));
		}
	}


	


}

?>