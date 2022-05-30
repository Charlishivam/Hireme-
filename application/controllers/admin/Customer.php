<?php
class Customer extends MY_Controller
{
    function __construct(){

        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();
        $this->load->model('Base_model');
        $this->load->model('admin/Coustomer_model', 'Coustomer_model');
        $this->data['config']  = $this->Base_model->all_setting_data();
	}

	
	public function index(){
    $data['records']   = $this->Coustomer_model->get_all_customer();
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/customer/index', $data);
		$this->load->view('admin/includes/_footer');
	}


    //-----------------------------------------------------------
  public function add(){
    $this->rbac->check_operation_access(); // check opration permission
    $this->form_validation->set_rules('customer_first_name', 'customer_last_name', 'required');
    $this->form_validation->set_rules('customer_last_name', 'customer_last_name', 'required');
    $this->form_validation->set_rules('customer_mobile', 'customer_mobile', 'required');
    $this->form_validation->set_rules('customer_address1', 'customer_address1', 'required');

        if($this->form_validation->run() == true){ 
            // $data['customer_type'] = $this->input->post('customer_type');
            $data['customer_first_name'] = $this->input->post('customer_first_name');
            $data['customer_last_name'] = $this->input->post('customer_last_name');
            $data['customer_full_name'] = $this->input->post('customer_first_name').' '.$this->input->post('customer_last_name');
            $data['customer_mobile'] = $this->input->post('customer_mobile');
            $data['customer_username'] = $this->input->post('customer_username');
            $data['customer_password'] = $this->input->post('customer_password');
            $data['customer_email'] = $this->input->post('customer_email');
            $data['customer_address1'] = $this->input->post('customer_address1');
            $data['customer_lat'] = $this->input->post('customer_lat');
            $data['customer_long'] = $this->input->post('customer_long');
            $data['customer_pincode'] = $this->input->post('customer_pincode');
            $data['customer_address2'] = $this->input->post('customer_address2');
            $data['customer_state'] = $this->input->post('customer_state');
            $data['customer_city'] = $this->input->post('customer_city');
            $data['customer_work_experience'] = $this->input->post('customer_work_experience');
            $data['customer_flatno'] = $this->input->post('customer_flatno');
            $data['customer_landmark'] = $this->input->post('customer_landmark');
            $data['customer_dob'] = date('Y-m-d', strtotime($this->input->post('customer_dob')));
            $data['customer_gender'] = $this->input->post('customer_gender');
            $data['customer_description'] = $this->input->post('customer_description');
            $data['customer_create_at']        = date('Y-m-d H:i:s');
            $this->Base_model->__constomdo_uploads('./uploads/customer/','customer_image');
            if(!empty($this->upload->data('file_name'))){
              $data['customer_image'] = 'uploads/customer/'.$this->upload->data('file_name');
            }

            if($this->Base_model->_inser_query('dk_customer',$data)) {
              $this->session->set_flashdata('success', 'Content have been successfully created !');
            }else{
                $this->session->set_flashdata('error', 'Some have error ! please try again ');
            }


            redirect('admin/customer');
        }
       

    $data['title'] = '';
    $this->load->view('admin/includes/_header');
    $this->load->view('admin/customer/add', $data);
    $this->load->view('admin/includes/_footer');
  }

  public function edit(){
    $this->rbac->check_operation_access(); // check opration permission
    $customer_id = $this->uri->segment(4); 
    $this->data['single'] = $this->Base_model->_single_data_query(array('customer_id'=>$customer_id),'dk_customer')->row_array();

    $this->form_validation->set_rules('customer_first_name', 'customer_last_name', 'required');
    $this->form_validation->set_rules('customer_last_name', 'customer_last_name', 'required');
    $this->form_validation->set_rules('customer_mobile', 'customer_mobile', 'required');
    $this->form_validation->set_rules('customer_address1', 'customer_address1', 'required');

        if($this->form_validation->run() == true){ 
            $customer_id = $this->input->post('customer_id');
            // $data['customer_type'] = $this->input->post('customer_type');

            $data['customer_first_name'] = $this->input->post('customer_first_name');
            $data['customer_last_name'] = $this->input->post('customer_last_name');
            $data['customer_full_name'] = $this->input->post('customer_first_name').''.$this->input->post('customer_last_name');
            $data['customer_mobile'] = $this->input->post('customer_mobile');
            $data['customer_username'] = $this->input->post('customer_username');
            $data['customer_password'] = $this->input->post('customer_password');
            $data['customer_email'] = $this->input->post('customer_email');
            $data['customer_address1'] = $this->input->post('customer_address1');
            $data['customer_lat'] = $this->input->post('customer_lat');
            $data['customer_long'] = $this->input->post('customer_long');
            $data['customer_pincode'] = $this->input->post('customer_pincode');
            $data['customer_address2'] = $this->input->post('customer_address2');
            $data['customer_work_experience'] = $this->input->post('customer_work_experience');
            $data['customer_state'] = $this->input->post('customer_state');
            $data['customer_city'] = $this->input->post('customer_city');
            $data['customer_flatno'] = $this->input->post('customer_flatno');
            $data['customer_landmark'] = $this->input->post('customer_landmark');
            $data['customer_dob'] = date('Y-m-d', strtotime($this->input->post('customer_dob')));
            $data['customer_gender'] = $this->input->post('customer_gender');
            $data['customer_description'] = $this->input->post('customer_description');
            $data['customer_update_at']        = date('Y-m-d H:i:s');
            $this->Base_model->__constomdo_uploads('./uploads/customer/','customer_image');
            if(!empty($this->upload->data('file_name'))){
              $data['customer_image'] = 'uploads/customer/'.$this->upload->data('file_name');
            }

            
            if($this->Base_model->_update_query('dk_customer',$data,array('customer_id'=>$customer_id))) {
              $this->session->set_flashdata('success', 'Content have been successfully created !');
            }else{
                $this->session->set_flashdata('error', 'Some have error ! please try again ');
            }


            redirect('admin/customer');
        }
       

    $this->data['title'] = '';
    $this->load->view('admin/includes/_header');
    $this->load->view('admin/customer/edit', $this->data);
    $this->load->view('admin/includes/_footer');
  }

  public function view(){
    $this->rbac->check_operation_access(); // check opration permission
    $customer_id = $this->uri->segment(4); 
    $this->data['single'] = $this->Base_model->_single_data_query(array('customer_id'=>$customer_id),'dk_customer')->row_array();
    $this->data['service_records'] = $this->Base_model->_single_data_query(array('customer_id'=>$customer_id),'dk_customer_service')->result_array();
    $this->data['title'] = '';
    $this->load->view('admin/includes/_header');
    $this->load->view('admin/customer/view', $this->data);
    $this->load->view('admin/includes/_footer');
  }

    //-----------------------------------------------------------
  public function customer_status(){
    $this->rbac->check_operation_access(); // check opration permission
    $customer_id = $this->uri->segment(4);
    $this->data['single'] = $this->Base_model->_single_data_query(array('customer_id'=>$customer_id),'dk_customer')->row();
    $data['customer_status'] = $this->uri->segment(5) == '1' ? '0' : '1';

    if($this->Base_model->_update_query('dk_customer',$data,array('customer_id'=>$customer_id))) {
      $this->session->set_flashdata('success', 'Customer Status has been changed successfully');
      redirect(base_url('admin/customer'));
    }else{
        $this->session->set_flashdata('errors', 'Customer Status has not been changed successfully');
      redirect(base_url('admin/customer'));
    }
  }

  //------------------------------------------------------------
  public function delete($customer_id=''){
    $this->rbac->check_operation_access(); // check opration permission
    $customer_id = $this->uri->segment(4);
    if($this->Base_model->_delete_query('dk_customer',array('customer_id'=>$customer_id))) 

      $this->Base_model->_delete_query('dk_customer_service',array('customer_id'=>$customer_id));
     
    {
       
      $this->session->set_flashdata('success','Customer has been deleted Successfully.'); 
      redirect($_SERVER['HTTP_REFERER']);
    }
  }

  public function service_add(){
    $this->rbac->check_operation_access(); // check opration permission
    $this->form_validation->set_rules('customer_id', 'customer_id', 'required');
    $this->data['customer_id'] = $this->uri->segment(4); 
        if($this->form_validation->run() == true){ 
            $customer_id = $this->input->post('customer_id');
            $data['customer_id'] = $customer_id;
            $data['customer_service_name'] = $this->input->post('customer_service_name');
            $data['customer_service_price'] = $this->input->post('customer_service_price');
            $data['customer_service_description'] = $this->input->post('customer_service_description');
            $data['customer_service_create_at']  = date('Y-m-d H:i:s');
            $this->Base_model->__constomdo_uploads('./uploads/customer/customer_service/','customer_service_image');
            if(!empty($this->upload->data('file_name'))){
              $data['customer_service_image'] = 'uploads/customer/customer_service/'.$this->upload->data('file_name');
            }
            if($this->Base_model->_inser_query('dk_customer_service',$data)) {
              $this->session->set_flashdata('success', 'customer service have been successfully created !');
            }else{
                $this->session->set_flashdata('error', 'Some have error ! please try again ');
            }
            redirect('admin/customer/view/'.$customer_id);
        }
       

    $this->data['title'] = '';
    $this->load->view('admin/includes/_header');
    $this->load->view('admin/customer/customer-service-add', $this->data);
    $this->load->view('admin/includes/_footer');
  }

  public function service_edit(){
    $this->rbac->check_operation_access(); // check opration permission
    $customer_service_id = $this->uri->segment(4);
    $this->data['single'] = $this->Base_model->_single_data_query(array('customer_service_id'=>$customer_service_id),'dk_customer_service')->row_array();
    $this->form_validation->set_rules('customer_service_id', 'customer_service_id', 'required');
   
        if($this->form_validation->run() == true){ 
            $customer_id = $this->input->post('customer_id');
            $customer_service_id = $this->input->post('customer_service_id');
            $data['customer_id'] = $customer_id;
            $data['customer_service_id'] = $customer_service_id;
            $data['customer_service_name'] = $this->input->post('customer_service_name');
            $data['customer_service_price'] = $this->input->post('customer_service_price');
            $data['customer_service_description'] = $this->input->post('customer_service_description');
            $data['customer_service_update_at'] = date('Y-m-d H:i:s');
            $this->Base_model->__constomdo_uploads('./uploads/customer/customer_service/','customer_service_image');
            if(!empty($this->upload->data('file_name'))){
              $data['customer_service_image'] = 'uploads/customer/customer_service/'.$this->upload->data('file_name');
            }
            if($this->Base_model->_update_query('dk_customer_service',$data,array('customer_service_id'=>$customer_service_id))) {
              $this->session->set_flashdata('success', 'customer service have been successfully created !');
            }else{
                $this->session->set_flashdata('error', 'Some have error ! please try again ');
            }
            redirect('admin/customer/view/'.$customer_id);
        }
    $this->data['title'] = '';
    $this->load->view('admin/includes/_header');
    $this->load->view('admin/customer/customer-service-edit', $this->data);
    $this->load->view('admin/includes/_footer');
  }

  //------------------------------------------------------------
  public function service_delete($customer_service_id=''){
    $this->rbac->check_operation_access(); // check opration permission
    $customer_service_id = $this->uri->segment(4);
    if($this->Base_model->_delete_query('dk_customer_service',array('customer_service_id'=>$customer_service_id))) 
     
    {
       
      $this->session->set_flashdata('success','customer service has been deleted Successfully.'); 
      redirect($_SERVER['HTTP_REFERER']);
    }
  }
}

?>
