<?php
class Banner extends MY_Controller
{
    function __construct(){

        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();
        $this->load->model('Base_model');
        $this->load->helper('data_helper');
		    $this->load->model('admin/Banner_model', 'Banner_model');
		    $this->load->model('admin/Coustomer_model', 'Coustomer_model');

    }


	//-----------------------------------------------------------
	public function index(){

		$data['title'] = '';
		$data['records'] = $this->Banner_model->get_all_banner();

		//echo "<pre>"; print_r($data['records']); echo "</pre>"; die();

		$this->load->view('admin/includes/_header');
		$this->load->view('admin/banner/index', $data);
		$this->load->view('admin/includes/_footer');
	}

	//-----------------------------------------------------------
	public function add(){

		

	  // now code for add product category
		$this->rbac->check_operation_access(); // check opration permission
		$this->form_validation->set_rules('banner_name', 'banner Name', 'required');
		
		

        if($this->form_validation->run() == true){ 

			$data['banner_name'] 			= $this->input->post('banner_name');
			$data['banner_text_url'] 			= $this->input->post('banner_text_url');
			$data['banner_type'] 			= $this->input->post('banner_type');
     	    $data['banner_created_at']        = date('Y-m-d H:i:s');

	     	  $this->Base_model->__constomdo_uploads('./uploads/banner/','banner_url');
	          if(!empty($this->upload->data('file_name'))){
	            $data['banner_url'] = 'uploads/banner/'.$this->upload->data('file_name');
	          }
         	    
             	 
            if($this->Base_model->_inser_query('dk_banner',$data)) {
              $this->session->set_flashdata('success', 'banner have been successfully created !');
            }else{
                $this->session->set_flashdata('error', 'Some have error ! please try again ');
            }
            redirect('admin/banner');
        }
       
		
        $data['title'] = '';
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/banner/add', $data);
		$this->load->view('admin/includes/_footer');
	}



	public function edit(){
		$banner_id =$this->uri->segment(4);
		$this->data['single'] = $this->Base_model->_single_data_query(array('banner_id'=>$banner_id),'dk_banner')->row();
		$this->rbac->check_operation_access(); // check opration permission
		$this->form_validation->set_rules('banner_name', 'banner Name', 'required');
        if($this->form_validation->run() == true){ 

        	$banner_id 						= $this->input->post('banner_id');
			$data['banner_name'] 			= $this->input->post('banner_name');
			$data['banner_text_url'] 			= $this->input->post('banner_text_url');
			$data['banner_type'] 			= $this->input->post('banner_type');
     	    $data['banner_updated_at']       = date('Y-m-d H:i:s');

     	    $this->Base_model->__constomdo_uploads('./uploads/banner/','banner_url');
              if(!empty($this->upload->data('file_name'))){
                $data['banner_url'] = 'uploads/banner/'.$this->upload->data('file_name');
              }
         	    
            if($this->Base_model->_update_query('dk_banner',$data,array('banner_id'=>$banner_id))) {
              $this->session->set_flashdata('success', 'banner have been successfully updated !');
            }else{
                $this->session->set_flashdata('error', 'Some have error ! please try again ');
            }
            redirect('admin/banner');
        }
     
		$this->data['title'] = '';
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/banner/edit', $this->data);
		$this->load->view('admin/includes/_footer');
	}



	//------------------------------------------------------------
	public function delete($id=''){
		$this->rbac->check_operation_access(); // check opration permission
		$banner_id =$this->uri->segment(4);
		if($this->Base_model->_delete_query('dk_banner',array('banner_id'=>$banner_id))) {
		  $this->session->set_flashdata('success','banner has been deleted Successfully.');	
		  redirect('admin/banner');
		}
	}

	//-----------------------------------------------------------
	public function banner_status(){
		$this->rbac->check_operation_access(); // check opration permission
	  $banner_id =$this->uri->segment(4);
	  $data['banner_status'] = $this->uri->segment(5) == '1' ? '0' : '1';

	  if($this->Base_model->_update_query('dk_banner',$data,array('banner_id'=>$banner_id))) {
			$this->session->set_flashdata('success', 'banner status has been changed successfully');
			redirect(base_url('admin/banner'));
		}else{
		    $this->session->set_flashdata('errors', 'banner status has not been changed');
			redirect(base_url('admin/banner'));
		}
	}

}

?>