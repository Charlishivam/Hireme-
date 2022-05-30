<?php
class city extends MY_Controller
{
    function __construct(){

        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();
        $this->load->model('Base_model');
        $this->load->model('admin/City_model', 'City_model');
        $this->data['config']  = $this->Base_model->all_setting_data();
	}

	
	public function index(){
		$data['title'] = '';
        $data['records']   = $this->City_model->get_all_city();
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/city/index', $data);
		$this->load->view('admin/includes/_footer');
	}


       //-----------------------------------------------------------
  public function add(){
    $this->rbac->check_operation_access(); // check opration permission
    $this->form_validation->set_rules('city_name', 'city_name', 'required');
        if($this->form_validation->run() == true){ 
            $data['city_state_id'] = $this->input->post('city_state_id');
            $data['city_name'] = $this->input->post('city_name');
            $data['city_create_at']        = date('Y-m-d H:i:s');
            
            if($this->Base_model->_inser_query('dk_city',$data)) {
             
              $this->session->set_flashdata('success', 'city have been successfully created !');
            }else{
                $this->session->set_flashdata('error', 'Some have error ! please try again ');
            }

           
            redirect('admin/city');
        }
        $this->data['all_state'] = $this->Base_model->_dropdownlist('state_id','state_name',array('state_status'=>'1'),'dk_state','Select State Name','');
   
    $this->data['title'] = '';
    $this->load->view('admin/includes/_header');
    $this->load->view('admin/city/add', $this->data);
    $this->load->view('admin/includes/_footer');
  }

  public function edit(){
    $this->rbac->check_operation_access(); // check opration permission
    $city_id = $this->uri->segment(4); 
    $this->data['single'] = $this->Base_model->_single_data_query(array('city_id'=>$city_id),'dk_city')->row_array();
    $this->form_validation->set_rules('city_name', 'city_name', 'required');
        if($this->form_validation->run() == true){ 
            $city_id = $this->input->post('city_id');
            $data['city_state_id'] = $this->input->post('city_state_id');
            $data['city_name'] = $this->input->post('city_name');
            $data['city_update_at']        = date('Y-m-d H:i:s');
            if($this->Base_model->_update_query('dk_city',$data,array('city_id'=>$city_id))) {
              $this->session->set_flashdata('success', 'city have been successfully updated !');
            }else{
                $this->session->set_flashdata('error', 'Some have error ! please try again ');
            }


            redirect('admin/city');
        }
    $this->data['all_state'] = $this->Base_model->_dropdownlist('state_id','state_name',array('state_status'=>'1'),'dk_state','Select State Name','');
       

    $this->data['title'] = '';
    $this->load->view('admin/includes/_header');
    $this->load->view('admin/city/edit', $this->data);
    $this->load->view('admin/includes/_footer');
  }


  //-----------------------------------------------------------
  public function city_status(){
    $this->rbac->check_operation_access(); // check opration permission
    $city_id = $this->uri->segment(4);
    $this->data['single'] = $this->Base_model->_single_data_query(array('city_id'=>$city_id),'dk_city')->row();
    $data['city_status'] = $this->uri->segment(5) == '1' ? '0' : '1';
    if($this->Base_model->_update_query('dk_city',$data,array('city_id'=>$city_id))) {
      $this->session->set_flashdata('success', 'city status has been changed successfully');
      redirect(base_url('admin/city'));
    }else{
        $this->session->set_flashdata('errors', 'city Status has not been changed successfully');
      redirect(base_url('admin/city'));
    }
  }

  //------------------------------------------------------------
  public function delete($city_id=''){
    $this->rbac->check_operation_access(); // check opration permission
    $city_id = $this->uri->segment(4);
    if($this->Base_model->_delete_query('dk_city',array('city_id'=>$city_id))) 
    {
       
      $this->session->set_flashdata('success','city has been deleted Successfully.'); 
      redirect($_SERVER['HTTP_REFERER']);
    }
  }

}

?>
