<?php
class Slider extends MY_Controller
{
    function __construct(){

        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();
        $this->load->model('Base_model');
        $this->load->helper('data_helper');
		$this->load->model('admin/Slider_model', 'Slider_model');
		$this->load->model('admin/Coustomer_model', 'Coustomer_model');

    }


	//-----------------------------------------------------------
	public function index(){

		$data['title'] = '';
		$data['records'] = $this->Slider_model->get_all_slider();
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/slider/index', $data);
		$this->load->view('admin/includes/_footer');
	}

	//-----------------------------------------------------------
	public function add(){

		

	  // now code for add product category
		$this->rbac->check_operation_access(); // check opration permission
		$this->form_validation->set_rules('slider_name', 'SLider Name', 'required');
		
		

        if($this->form_validation->run() == true){ 

			$data['slider_name'] 			= $this->input->post('slider_name');
			$data['slider_link'] 			= $this->input->post('slider_link');
			$data['slider_type'] 			= $this->input->post('slider_type');
     	    $data['slider_create_at']        = date('Y-m-d H:i:s');

         	  $this->Base_model->__constomdo_uploads('./uploads/slider/','slider_url');
              if(!empty($this->upload->data('file_name'))){
                $data['slider_url'] = 'uploads/slider/'.$this->upload->data('file_name');
              }
         	    
             	 
            if($this->Base_model->_inser_query('dk_slider',$data)) {
              $this->session->set_flashdata('success', 'slider have been successfully created !');
            }else{
                $this->session->set_flashdata('error', 'Some have error ! please try again ');
            }
            redirect('admin/slider');
        }
       
		
        $data['title'] = '';
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/slider/add', $data);
		$this->load->view('admin/includes/_footer');
	}



	public function edit(){
		$slider_id =$this->uri->segment(4);
		$this->data['single'] = $this->Base_model->_single_data_query(array('slider_id'=>$slider_id),'dk_slider')->row();
		$this->rbac->check_operation_access(); // check opration permission
		$this->form_validation->set_rules('slider_name', 'SLider Name', 'required');
        if($this->form_validation->run() == true){ 

        	$slider_id 						= $this->input->post('slider_id');
			$data['slider_name'] 			= $this->input->post('slider_name');
			$data['slider_link'] 			= $this->input->post('slider_link');
			$data['slider_type'] 			= $this->input->post('slider_type');
     	    $data['slider_update_at']       = date('Y-m-d H:i:s');

     	    $this->Base_model->__constomdo_uploads('./uploads/slider/','slider_url');
              if(!empty($this->upload->data('file_name'))){
                $data['slider_url'] = 'uploads/slider/'.$this->upload->data('file_name');
              }
         	    
            if($this->Base_model->_update_query('dk_slider',$data,array('slider_id'=>$slider_id))) {
              $this->session->set_flashdata('success', 'slider have been successfully updated !');
            }else{
                $this->session->set_flashdata('error', 'Some have error ! please try again ');
            }
            redirect('admin/slider');
        }
     
		$this->data['title'] = '';
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/slider/edit', $this->data);
		$this->load->view('admin/includes/_footer');
	}



	//------------------------------------------------------------
	public function delete($id=''){
		$this->rbac->check_operation_access(); // check opration permission
		$slider_id =$this->uri->segment(4);
		if($this->Base_model->_delete_query('dk_slider',array('slider_id'=>$slider_id))) {
		  $this->session->set_flashdata('success','slider has been deleted Successfully.');	
		  redirect('admin/slider');
		}
	}

	//-----------------------------------------------------------
	public function slider_status(){
		$this->rbac->check_operation_access(); // check opration permission
	  $slider_id =$this->uri->segment(4);
	  $data['slider_status'] = $this->uri->segment(5) == '1' ? '0' : '1';

	  if($this->Base_model->_update_query('dk_slider',$data,array('slider_id'=>$slider_id))) {
			$this->session->set_flashdata('success', 'slider status has been changed successfully');
			redirect(base_url('admin/slider'));
		}else{
		    $this->session->set_flashdata('errors', 'slider status has not been changed');
			redirect(base_url('admin/slider'));
		}
	}

}

?>