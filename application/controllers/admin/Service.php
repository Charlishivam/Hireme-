<?php
class Service extends MY_Controller
{
    function __construct(){

        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();
        $this->load->model('Base_model');
        $this->load->model('admin/Service_model', 'Service_model');
        $this->data['config']  = $this->Base_model->all_setting_data();
	}

	
	public function index(){
    $data['records']   = $this->Service_model->get_all_service();
     //echo "<pre>"; print_r($data['records']); echo "<pre>"; die(); 
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/service/index', $data);
		$this->load->view('admin/includes/_footer');
	}


    //-----------------------------------------------------------
  public function add(){
    //echo "<pre>"; print_r($_POST); echo "<pre>"; die(); 
    $this->rbac->check_operation_access(); // check opration permission
    $this->form_validation->set_rules('service_title', 'jobpost_title', 'required');
        if($this->form_validation->run() == true){ 
            $data['customer_id']   = $this->input->post('customer_id');
            $data['service_title'] = $this->input->post('service_title');
            $data['service_price'] = $this->input->post('service_price');
            $data['service_description'] = $this->input->post('service_description');
            $data['service_delivery'] = $this->input->post('service_delivery');
            $data['service_category']    = $this->input->post('service_category');
            $data['service_subcategory'] = $this->input->post('service_subcategory');
            $this->Base_model->__constomdo_uploads('./uploads/service/','service_image');
            if(!empty($this->upload->data('file_name'))){
              $data['service_image'] = 'uploads/service/'.$this->upload->data('file_name');
            }
            $data['service_create_at']        = date('Y-m-d H:i:s');
            if($this->Base_model->_inser_query('dk_service',$data)) {
              $this->session->set_flashdata('success', 'New Service have been successfully created !');
            }else{
                $this->session->set_flashdata('error', 'Some have error ! please try again ');
            }
            //echo $this->db->last_query(); die();
            redirect('admin/service');
             
        }

    $this->data['category_name']    = $this->Base_model->_dropdownlist('category_id','category_name',array('category_status'=>'1'),'dk_category','Select Category Name','');
    $this->data['customer_name']    = $this->Base_model->_dropdownlist('customer_id','customer_full_name',array('customer_status'=>'1'),'dk_customer','Select Customer Name','');
    $this->data['subcategory_name'] = $this->Base_model->_dropdownlist('subcategory_id','subcategory_name',array('subcategory_status'=>'1'),'dk_subcategory','Select Subcategory Name','');

    $this->data['skill_name'] = $this->Base_model->_dropdownlist('skill_id','skill_name',array('skill_status'=>'1'),'dk_skill','','');
       

    $data['title'] = '';
    $this->load->view('admin/includes/_header');
    $this->load->view('admin/service/add',$this->data);
    $this->load->view('admin/includes/_footer');
  }

  public function edit(){
    $this->rbac->check_operation_access(); // check opration permission
    $service_id = $this->uri->segment(4); 
    $this->data['single'] = $this->Base_model->_single_data_query(array('service_id'=>$service_id),'dk_service')->row_array();
    $this->form_validation->set_rules('service_title', 'service_title', 'required');
    // $jobpost_skill     = $this->input->post('jobpost_skill');
    // if(!empty($jobpost_skill)){
    //     $skill = json_encode($jobpost_skill);
    // }

        if($this->form_validation->run() == true){ 
            $service_id                       = $this->input->post('service_id');
            $data['customer_id']              = $this->input->post('customer_id');
            $data['service_title']            = $this->input->post('service_title');
            $data['service_price']            = $this->input->post('service_price');
            $data['service_description']      = $this->input->post('service_description');
            $data['service_delivery']         = $this->input->post('service_delivery');
            $data['service_category']         = $this->input->post('service_category');
            $data['service_subcategory']      = $this->input->post('service_subcategory');
            $data['service_update_at']        = date('Y-m-d H:i:s');
            
            if($this->Base_model->_update_query('dk_service',$data,array('service_id'=>$service_id))) {
              $this->session->set_flashdata('success', 'Service have been successfully Updated !');
            }else{
                $this->session->set_flashdata('error', 'Some have error ! please try again ');
            }
           
                redirect('admin/service');
            
        }
       

    $this->data['title'] = '';
    $this->data['customer_name']    = $this->Base_model->_dropdownlist('customer_id','customer_full_name',array('customer_status'=>'1'),'dk_customer','Select Customer Name','');
    $this->data['category_name']    = $this->Base_model->_dropdownlist('category_id','category_name',array('category_status'=>'1'),'dk_category','Select Category Name','');
    $this->data['subcategory_name'] = $this->Base_model->_dropdownlist('subcategory_id','subcategory_name',array('subcategory_status'=>'1'),'dk_subcategory','Select Subcategory Name','');
    $this->data['skill_name']       = $this->Base_model->_dropdownlist('skill_id','skill_name',array('skill_status'=>'1'),'dk_skill','','');
    $this->load->view('admin/includes/_header');
    $this->load->view('admin/service/edit', $this->data);
    $this->load->view('admin/includes/_footer');
  }

  //-----------------------------------------------------------
  public function service_status(){
    $this->rbac->check_operation_access(); // check opration permission
    $service_id = $this->uri->segment(4); 
    $this->data['single'] = $this->Base_model->_single_data_query(array('service_id'=>$service_id),'dk_service')->row();
    $data['service_status'] = $this->uri->segment(5) == '1' ? '0' : '1';

    if($this->Base_model->_update_query('dk_service',$data,array('service_id'=>$service_id))) {
      $this->session->set_flashdata('success', 'Service Status has been changed successfully');
      redirect($_SERVER['HTTP_REFERER']);
    }else{
        $this->session->set_flashdata('errors', 'Service Status has not been changed successfully');
      redirect($_SERVER['HTTP_REFERER']);
    }
  }

  

  //------------------------------------------------------------
  public function delete($service_id=''){
    $this->rbac->check_operation_access(); // check opration permission
     $service_id = $this->uri->segment(4); 
    if($this->Base_model->_delete_query('dk_service',array('service_id'=>$service_id))) 
    {
      $this->session->set_flashdata('success','Service has been deleted Successfully.'); 
      redirect($_SERVER['HTTP_REFERER']);
    }
  }

}

?>
