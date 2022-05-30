<?php
class State extends MY_Controller
{
    function __construct(){

        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();
        $this->load->model('Base_model');
        $this->load->model('admin/State_model', 'State_model');
        $this->data['config']  = $this->Base_model->all_setting_data();
	}

	
	public function index(){
		$data['title'] = '';
        $data['records']   = $this->State_model->get_all_state();
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/state/index', $data);
		$this->load->view('admin/includes/_footer');
	}


       //-----------------------------------------------------------
  public function add(){
    $this->rbac->check_operation_access(); // check opration permission
    $this->form_validation->set_rules('state_name', 'state_name', 'required');
    $this->form_validation->set_rules('state_code', 'state_code', 'required');
    

        if($this->form_validation->run() == true){ 
            $data['state_name'] = $this->input->post('state_name');
            $data['state_code'] = $this->input->post('state_code');
            $data['state_create_at']        = date('Y-m-d H:i:s');
            
            if($this->Base_model->_inser_query('dk_state',$data)) {
             
              $this->session->set_flashdata('success', 'state have been successfully created !');
            }else{
                $this->session->set_flashdata('error', 'Some have error ! please try again ');
            }

           
            redirect('admin/state');
        }
    $data['title'] = '';
    $this->load->view('admin/includes/_header');
    $this->load->view('admin/state/add', $data);
    $this->load->view('admin/includes/_footer');
  }

  public function edit(){
    $this->rbac->check_operation_access(); // check opration permission
    $state_id = $this->uri->segment(4); 
    $this->data['single'] = $this->Base_model->_single_data_query(array('state_id'=>$state_id),'dk_state')->row_array();
    $this->form_validation->set_rules('state_name', 'state_name', 'required');
    $this->form_validation->set_rules('state_code', 'state_code', 'required');

        if($this->form_validation->run() == true){ 
            $state_id = $this->input->post('state_id');
            $data['state_name'] = $this->input->post('state_name');
            $data['state_code'] = $this->input->post('state_code');
            $data['state_update_at']        = date('Y-m-d H:i:s');
            if($this->Base_model->_update_query('dk_state',$data,array('state_id'=>$state_id))) {
              $this->session->set_flashdata('success', 'state have been successfully updated !');
            }else{
                $this->session->set_flashdata('error', 'Some have error ! please try again ');
            }


            redirect('admin/state');
        }
       

    $this->data['title'] = '';
    $this->load->view('admin/includes/_header');
    $this->load->view('admin/state/edit', $this->data);
    $this->load->view('admin/includes/_footer');
  }


  //-----------------------------------------------------------
  public function state_status(){
    $this->rbac->check_operation_access(); // check opration permission
    $state_id = $this->uri->segment(4);
    $this->data['single'] = $this->Base_model->_single_data_query(array('state_id'=>$state_id),'dk_state')->row();
    $data['state_status'] = $this->uri->segment(5) == '1' ? '0' : '1';

    if($this->Base_model->_update_query('dk_state',$data,array('state_id'=>$state_id))) {
      $this->session->set_flashdata('success', 'state status has been changed successfully');
      redirect(base_url('admin/state'));
    }else{
        $this->session->set_flashdata('errors', 'state Status has not been changed successfully');
      redirect(base_url('admin/state'));
    }
  }

  //------------------------------------------------------------
  public function delete($state_id=''){
    $this->rbac->check_operation_access(); // check opration permission
    $state_id = $this->uri->segment(4);
    if($this->Base_model->_delete_query('dk_state',array('state_id'=>$state_id))) 
    {
       
      $this->session->set_flashdata('success','state has been deleted Successfully.'); 
      redirect($_SERVER['HTTP_REFERER']);
    }
  }

}

?>
