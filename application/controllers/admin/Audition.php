<?php
class Audition extends MY_Controller
{
    function __construct(){

        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();
        $this->load->model('Base_model');
        $this->load->model('admin/Audition_model', 'Audition_model');
        $this->data['config']  = $this->Base_model->all_setting_data();
	}

	
	public function index(){
    $data['records']   = $this->Audition_model->get_all_audition();
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/audition/index', $data);
		$this->load->view('admin/includes/_footer');
	}


    //-----------------------------------------------------------
  public function add(){
    $this->rbac->check_operation_access(); // check opration permission
    $this->form_validation->set_rules('audition_season_id', 'audition_season_id', 'required');
    $this->form_validation->set_rules('audition_start_date', 'audition_start_date', 'required');
    $this->form_validation->set_rules('audition_end_date', 'audition_end_date', 'required');
   

        if($this->form_validation->run() == true){ 
            $data['audition_season_id']        = $this->input->post('audition_season_id');
            $data['audition_start_date']  = date('Y-m-d', strtotime($this->input->post('audition_start_date')));
            $data['audition_end_date']    = date('Y-m-d', strtotime($this->input->post('audition_end_date')));
            $data['audition_create_at']        = date('Y-m-d H:i:s');
            $this->Base_model->__constomdo_uploads('./uploads/audition/','audition_image');
            if(!empty($this->upload->data('file_name'))){
              $data['audition_image'] = 'uploads/audition/'.$this->upload->data('file_name');
            }
            if($this->Base_model->_inser_query('idol_audition',$data)) {
              $this->session->set_flashdata('success', 'audition have been successfully created !');
            }else{
                $this->session->set_flashdata('error', 'Some have error ! please try again ');
            }
            redirect('admin/audition');
        }
       
    $this->data['title'] = '';
    $this->data['season_name'] = $this->Base_model->_dropdownlist('season_id','season_name',array('season_status'=>'1'),'idol_season','Select Season Name','');
    $this->load->view('admin/includes/_header');
    $this->load->view('admin/audition/add',$this->data);
    $this->load->view('admin/includes/_footer');
  }

  public function edit(){
    $this->rbac->check_operation_access(); // check opration permission
    $audition_id = $this->uri->segment(4); 
    $this->data['single'] = $this->Base_model->_single_data_query(array('audition_id'=>$audition_id),'idol_audition')->row_array();
    $this->form_validation->set_rules('audition_season_id', 'audition_season_id', 'required');
    $this->form_validation->set_rules('audition_start_date', 'audition_start_date', 'required');
    $this->form_validation->set_rules('audition_end_date', 'audition_end_date', 'required');

        if($this->form_validation->run() == true){ 
            $audition_id = $this->input->post('audition_id');
            $data['audition_season_id']        = $this->input->post('audition_season_id');
            $data['audition_start_date']  = date('Y-m-d', strtotime($this->input->post('audition_start_date')));
            $data['audition_end_date']    = date('Y-m-d', strtotime($this->input->post('audition_end_date')));
            $data['audition_create_at']        = date('Y-m-d H:i:s');
            $this->Base_model->__constomdo_uploads('./uploads/audition/','audition_image');
            if(!empty($this->upload->data('file_name'))){
              $data['audition_image'] = 'uploads/audition/'.$this->upload->data('file_name');
            }
            
            if($this->Base_model->_update_query('idol_audition',$data,array('audition_id'=>$audition_id))) {
              $this->session->set_flashdata('success', 'audition have been successfully created !');
            }else{
                $this->session->set_flashdata('error', 'Some have error ! please try again ');
            }
            redirect('admin/audition');
        }
       

    $this->data['title'] = '';
    $this->data['season_name'] = $this->Base_model->_dropdownlist('season_id','season_name',array('season_status'=>'1'),'idol_season','Select Season Name','');
    $this->load->view('admin/includes/_header');
    $this->load->view('admin/audition/edit', $this->data);
    $this->load->view('admin/includes/_footer');
  }

    //-----------------------------------------------------------
  public function audition_status(){
    $this->rbac->check_operation_access(); // check opration permission
    $audition_id = $this->uri->segment(4);
    $this->data['single'] = $this->Base_model->_single_data_query(array('audition_id'=>$audition_id),'idol_audition')->row();
    $data['audition_status'] = $this->uri->segment(5) == '1' ? '0' : '1';

    if($this->Base_model->_update_query('idol_audition',$data,array('audition_id'=>$audition_id))) {
      $this->session->set_flashdata('success', 'audition Status has been changed successfully');
      redirect(base_url('admin/audition'));
    }else{
        $this->session->set_flashdata('errors', 'audition Status has not been changed successfully');
      redirect(base_url('admin/audition'));
    }
  }

  //------------------------------------------------------------
  public function delete($audition_id=''){
    $this->rbac->check_operation_access(); // check opration permission
    $audition_id = $this->uri->segment(4);
    if($this->Base_model->_delete_query('idol_audition',array('audition_id'=>$audition_id))) 
     
    {
       
      $this->session->set_flashdata('success','audition has been deleted Successfully.'); 
      redirect($_SERVER['HTTP_REFERER']);
    }
  }
}

?>
