<?php
class StaffRole extends MY_Controller
{
    function __construct(){

        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();

		$this->load->model('admin/StaffRole_model', 'StaffRole_model');
    }


	//-----------------------------------------------------------
	public function index(){

		$data['title'] = '';
		$data['records'] = $this->StaffRole_model->get_all_staff_roles();

		$this->load->view('admin/includes/_header');
		$this->load->view('admin/staff_role/index', $data);
		$this->load->view('admin/includes/_footer');
	}

	//-----------------------------------------------------------
	public function add(){

		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
			$this->form_validation->set_rules('role_name', 'Staff Role Name', 'trim|required');
			$this->form_validation->set_rules('status', 'Staff Role Status', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/StaffRole/add'),'refresh');
			}
			else{
			    
			    $data = array(
					'role_name' => $this->input->post('role_name'),
					'status'    => $this->input->post('status'),
					'create_date' => date('Y-m-d H:i:s')
				);
				
			    
				$data = $this->security->xss_clean($data);
				$result = $this->StaffRole_model->add_staff_role($data);
				if($result){
					$this->session->set_flashdata('success', 'Staff Role has been added successfully!');
					redirect(base_url('admin/StaffRole'));
				}
			}
		}
		else{
			$data['title'] = '';
			$this->load->view('admin/includes/_header');
			$this->load->view('admin/staff_role/add', $data);
			$this->load->view('admin/includes/_footer');
		}
	}

	//-----------------------------------------------------------
	public function edit($id=0){

		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
			$this->form_validation->set_rules('role_name', 'Staff Role Name', 'trim|required');
			$this->form_validation->set_rules('status', 'Staff Role Status', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/StaffRole/edit/'.$id),'refresh');
			}
			else{
			    
			    $data = array(
					'role_name' => $this->input->post('role_name'),
					'status'    => $this->input->post('status'),
					'update_date' => date('Y-m-d H:i:s')
				);
			    
			    
				$data = $this->security->xss_clean($data);
				$result = $this->StaffRole_model->edit_staff_role($data, $id);
				$result = true;
				if($result){
					$this->session->set_flashdata('success', 'Staff Role has been updated successfully');
					redirect(base_url('admin/StaffRole'));
				}
			}
		}
		else{
			$data['title'] = '';
			$data['record'] = $this->StaffRole_model->get_staff_role_by_id($id);
			$this->load->view('admin/includes/_header');
			$this->load->view('admin/staff_role/edit', $data);
			$this->load->view('admin/includes/_footer');
		}
	}

	//------------------------------------------------------------
	public function delete($id=''){

		$this->rbac->check_operation_access(); // check opration permission

		$this->StaffRole_model->delete_staff_role($id);

		$this->session->set_flashdata('msg','Staff Role has been deleted Successfully.');	
		redirect('admin/StaffRole');
	}

	//-----------------------------------------------------------
	public function change_status(){

		$this->rbac->check_operation_access(); // check opration permission

		$this->admin_roles->change_status();
	}


}

?>