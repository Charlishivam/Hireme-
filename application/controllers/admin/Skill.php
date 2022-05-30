<?php
class Skill extends MY_Controller
{
    function __construct(){

        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();
        $this->load->model('Base_model');
        $this->load->helper('data_helper');
		    $this->load->model('admin/Skill_model', 'Skill_model');
		    $this->load->model('admin/Coustomer_model', 'Coustomer_model');

    }


	//-----------------------------------------------------------
	public function index(){

		$data['title'] = '';
		$data['records'] = $this->Skill_model->get_all_skill();

		$this->load->view('admin/includes/_header');
		$this->load->view('admin/skill/index', $data);
		$this->load->view('admin/includes/_footer');
	}

	//-----------------------------------------------------------
	public function add(){
	  // now code for add product skill
		$this->rbac->check_operation_access(); // check opration permission
		$this->form_validation->set_rules('skill_name', 'skill name', 'required');
        if($this->form_validation->run() == true){ 
			$data['skill_name'] 			= $this->input->post('skill_name');
     	    $data['skill_create_at']        = date('Y-m-d H:i:s');
            if($this->Base_model->_inser_query('dk_skill',$data)) {
              $this->session->set_flashdata('success', 'skill have been successfully created !');
            }else{
                $this->session->set_flashdata('error', 'Some have error ! please try again ');
            }
            redirect('admin/skill');
        }
       
		
    $data['title'] = '';
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/skill/add', $data);
		$this->load->view('admin/includes/_footer');
	}



	public function edit(){
		$this->rbac->check_operation_access(); // check opration permission
		$skill_id =$this->uri->segment(4);
		$this->data['single'] = $this->Base_model->_single_data_query(array('skill_id'=>$skill_id ),'dk_skill')->row_array();
		
		$this->form_validation->set_rules('skill_name', 'skill name', 'required');
        if($this->form_validation->run() == true){ 
        	$skill_id					= $this->input->post('skill_id');
			$data['skill_name'] 			= $this->input->post('skill_name');
	         $data['skill_update_at']        = date('Y-m-d H:i:s');
            if($this->Base_model->_update_query('dk_skill',$data,array('skill_id'=>$skill_id))) {
              $this->session->set_flashdata('success', 'skill have been successfully updated !');
            }else{
                $this->session->set_flashdata('error', 'Some have error ! please try again ');
            }
            redirect('admin/skill');
        }
     
		$this->data['title'] = '';
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/skill/edit', $this->data);
		$this->load->view('admin/includes/_footer');
	}



	//------------------------------------------------------------
	public function delete($id=''){
		$this->rbac->check_operation_access(); // check opration permission
		$skill_id =$this->uri->segment(4);
		$this->data['single'] = $this->Base_model->_single_data_query(array('skill_id'=>$skill_id),'dk_skill')->row();
		if($this->Base_model->_delete_query('dk_skill',array('skill_id'=>$skill_id))) {
		  $this->session->set_flashdata('success','skill skill has been deleted Successfully.');	
		  redirect('admin/skill');
		}
	}

	//-----------------------------------------------------------
	public function skill_status(){
		$this->rbac->check_operation_access(); // check opration permission
	  $skill_id = $this->uri->segment(4);
	  $data['skill_status'] = $this->uri->segment(5) == '1' ? '0' : '1';
	  if($this->Base_model->_update_query('dk_skill',$data,array('skill_id'=>$skill_id))) {
			$this->session->set_flashdata('success', 'skill status has been changed successfully');
			redirect(base_url('admin/skill'));
		}else{
		    $this->session->set_flashdata('errors', 'skill status has not been changed successfully');
			redirect(base_url('admin/skill'));
		}
	}


	


}

?>