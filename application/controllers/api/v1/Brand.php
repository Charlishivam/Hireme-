<?php
class Brand extends MY_Controller
{
    function __construct(){

        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();
        $this->load->model('Base_model');
        $this->load->helper('data_helper');
		    $this->load->model('admin/Brand_model', 'Brand_model');
		    $this->load->model('admin/Coustomer_model', 'Coustomer_model');

    }


	//-----------------------------------------------------------
	public function index(){

		$data['title'] = '';
		$data['records'] = $this->Brand_model->get_all_brand();

		//echo "<pre>"; print_r($data['records']); echo "</pre>"; die();

		$this->load->view('admin/includes/_header');
		$this->load->view('admin/brand/index', $data);
		$this->load->view('admin/includes/_footer');
	}

	//-----------------------------------------------------------
	public function add(){

		

	  // now code for add product category
		$this->rbac->check_operation_access(); // check opration permission
		$this->form_validation->set_rules('brand_name', 'brand Name', 'required');
		
		

        if($this->form_validation->run() == true){ 

			$data['brand_name'] 			= $this->input->post('brand_name');
			
     	    $data['brand_create_at']        = date('Y-m-d H:i:s');

	     	  $this->Base_model->__constomdo_uploads('./uploads/brand/','brand_url');
	          if(!empty($this->upload->data('file_name'))){
	            $data['brand_url'] = 'uploads/brand/'.$this->upload->data('file_name');
	          }
         	    
             	 
            if($this->Base_model->_inser_query('park_brand',$data)) {
              $this->session->set_flashdata('success', 'brand have been successfully created !');
            }else{
                $this->session->set_flashdata('error', 'Some have error ! please try again ');
            }

           		
            redirect('admin/brand');
        }
       
		
        $data['title'] = '';
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/brand/add', $data);
		$this->load->view('admin/includes/_footer');
	}



	public function edit(){
		$brand_id =$this->uri->segment(4);
		$this->data['single'] = $this->Base_model->_single_data_query(array('brand_id'=>$brand_id),'park_brand')->row();
		$this->rbac->check_operation_access(); // check opration permission
		$this->form_validation->set_rules('brand_name', 'brand Name', 'required');
        if($this->form_validation->run() == true){ 

        	$brand_id 						= $this->input->post('brand_id');
			$data['brand_name'] 			= $this->input->post('brand_name');
     	    $data['brand_update_at']       = date('Y-m-d H:i:s');
     	    $this->Base_model->__constomdo_uploads('./uploads/brand/','brand_url');
              if(!empty($this->upload->data('file_name'))){
                $data['brand_url'] = 'uploads/brand/'.$this->upload->data('file_name');
              }
         	    
            if($this->Base_model->_update_query('park_brand',$data,array('brand_id'=>$brand_id))) {
              $this->session->set_flashdata('success', 'brand have been successfully updated !');
            }else{
                $this->session->set_flashdata('error', 'Some have error ! please try again ');
            }
            redirect('admin/brand');
        }
     
		$this->data['title'] = '';
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/brand/edit', $this->data);
		$this->load->view('admin/includes/_footer');
	}



	//------------------------------------------------------------
	public function delete($id=''){
		$this->rbac->check_operation_access(); // check opration permission
		$brand_id =$this->uri->segment(4);
		if($this->Base_model->_delete_query('park_brand',array('brand_id'=>$brand_id))) {
		  $this->session->set_flashdata('success','brand has been deleted Successfully.');	
		  redirect('admin/brand');
		}
	}

	//-----------------------------------------------------------
	public function brand_status(){
		$this->rbac->check_operation_access(); // check opration permission
	  $brand_id =$this->uri->segment(4);
	  $data['brand_status'] = $this->uri->segment(5) == '1' ? '0' : '1';

	  if($this->Base_model->_update_query('park_brand',$data,array('brand_id'=>$brand_id))) {
			$this->session->set_flashdata('success', 'brand status has been changed successfully');
			redirect(base_url('admin/brand'));
		}else{
		    $this->session->set_flashdata('errors', 'brand status has not been changed');
			redirect(base_url('admin/brand'));
		}
	}

}

?>