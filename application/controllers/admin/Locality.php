<?php
class Locality extends MY_Controller
{
    function __construct(){

        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();
        $this->load->model('Base_model');
        $this->load->model('admin/Locality_model', 'Locality_model');
        $this->data['config']  = $this->Base_model->all_setting_data();
	}

	
	public function index(){
		$data['title'] = '';
        $data['records']   = $this->Locality_model->get_all_locality();
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/locality/index', $data);
		$this->load->view('admin/includes/_footer');
	}


       //-----------------------------------------------------------
  public function add(){
    $this->rbac->check_operation_access(); // check opration permission
    $this->form_validation->set_rules('locality_name', 'locality_name', 'required');
        if($this->form_validation->run() == true){ 
            $data['locality_state_id'] = $this->input->post('locality_state_id');
            $data['locality_city_id'] = $this->input->post('locality_city_id');
            $data['locality_name'] = $this->input->post('locality_name');
            $data['locality_create_at']        = date('Y-m-d H:i:s');
            
            if($this->Base_model->_inser_query('dk_locality',$data)) {
             
              $this->session->set_flashdata('success', 'locality have been successfully created !');
            }else{
                $this->session->set_flashdata('error', 'Some have error ! please try again ');
            }

           
            redirect('admin/locality');
        }

    $this->data['all_state'] = $this->Base_model->_dropdownlist('state_id','state_name',array('state_status'=>'1'),'dk_state','Select State Name','');
    $this->data['all_city'] = $this->Base_model->_dropdownlist('city_id','city_name',array('city_status'=>'1'),'dk_city','Select City Name','');
   
    $this->data['title'] = '';
    $this->load->view('admin/includes/_header');
    $this->load->view('admin/locality/add', $this->data);
    $this->load->view('admin/includes/_footer');
  }

  public function edit(){
    $this->rbac->check_operation_access(); // check opration permission
    $locality_id = $this->uri->segment(4); 
    $this->data['single'] = $this->Base_model->_single_data_query(array('locality_id'=>$locality_id),'dk_locality')->row_array();
    $this->form_validation->set_rules('locality_name', 'locality_name', 'required');
        if($this->form_validation->run() == true){ 
            $locality_id = $this->input->post('locality_id');
            $data['locality_state_id'] = $this->input->post('locality_state_id');
            $data['locality_city_id'] = $this->input->post('locality_city_id');
            $data['locality_name'] = $this->input->post('locality_name');
            $data['locality_update_at']        = date('Y-m-d H:i:s');
            if($this->Base_model->_update_query('dk_locality',$data,array('locality_id'=>$locality_id))) {
              $this->session->set_flashdata('success', 'locality have been successfully updated !');
            }else{
                $this->session->set_flashdata('error', 'Some have error ! please try again ');
            }
            redirect('admin/locality');
        }
    $this->data['all_state'] = $this->Base_model->_dropdownlist('state_id','state_name',array('state_status'=>'1'),'dk_state','Select State Name','');
    $this->data['all_city'] = $this->Base_model->_dropdownlist('city_id','city_name',array('city_status'=>'1'),'dk_city','Select City Name','');
    $this->data['title'] = '';
    $this->load->view('admin/includes/_header');
    $this->load->view('admin/locality/edit', $this->data);
    $this->load->view('admin/includes/_footer');
  }
  //-----------------------------------------------------------
  public function locality_status(){
    $this->rbac->check_operation_access(); // check opration permission
    $locality_id = $this->uri->segment(4);
    $this->data['single'] = $this->Base_model->_single_data_query(array('locality_id'=>$locality_id),'dk_locality')->row();
    $data['locality_status'] = $this->uri->segment(5) == '1' ? '0' : '1';
    if($this->Base_model->_update_query('dk_locality',$data,array('locality_id'=>$locality_id))) {
      $this->session->set_flashdata('success', 'locality status has been changed successfully');
      redirect(base_url('admin/locality'));
    }else{
        $this->session->set_flashdata('errors', 'locality Status has not been changed successfully');
      redirect(base_url('admin/locality'));
    }
  }

  //------------------------------------------------------------
  public function delete($locality_id=''){
    $this->rbac->check_operation_access(); // check opration permission
    $locality_id = $this->uri->segment(4);
    if($this->Base_model->_delete_query('dk_locality',array('locality_id'=>$locality_id))) 
    {
      $this->session->set_flashdata('success','locality has been deleted Successfully.'); 
      redirect($_SERVER['HTTP_REFERER']);
    }
  }

    public function getcity(){
        $city_id  =  $this->input->post('city_id');
        $data['city']=$this->Locality_model->all_city_by_state_id($city_id);
        print_r(json_encode($data['city']));
    }

}

?>
