<?php
class Staff extends MY_Controller
{
    function __construct(){

        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();

		$this->load->model('admin/Staff_model', 'Staff_model');
    }


	//-----------------------------------------------------------
	public function index(){

		$data['title'] = '';
		$data['records'] = $this->Staff_model->get_all_Staff();
        //print_r($data); die;
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/staff/index', $data);
		$this->load->view('admin/includes/_footer');
	}

	//-----------------------------------------------------------
	public function add(){

		$this->rbac->check_operation_access(); // check opration permission
        $this->load->library('upload');
		if($this->input->post('submit')){
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('dob', 'Date Of Birth', 'trim');
			$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
			$this->form_validation->set_rules('role_id', 'Staff Role', 'trim');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/Staff/add'),'refresh');
			}
			else{
			    
			    $data = array(
					'role_id' => $this->input->post('role_id'),
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'dob' => $this->input->post('dob'),
					'mobile' => $this->input->post('mobile'),
					'email' => $this->input->post('email'),
					'gender' => $this->input->post('gender'),
					'create_date' => date('Y-m-d H:i:s')
				);
				
			    if($_FILES['staff_img']['size'] > 0){
                    $_FILES['staff_img']['name']    =   time().$_FILES['staff_img']['name'];
                    $config['upload_path'] = './uploads/staffimage';
                    $config['allowed_types'] = 'gif|jpeg|jpg|png';
                    // $config['max_size'] = 2000;
                    // $config['max_width'] = 1500;
                    // $config['max_height'] = 1500;
                    $this->upload->initialize($config);
                
                    if(!$this->upload->do_upload('staff_img')){
                        echo $this->upload->display_errors('<p>', '</p>');
                        //$this->session->set_flashdata('errors', 'Image Required');
    				}else{
    				    $data['staff_image'] = $_FILES['staff_img']['name'];
    				}
			    }
			    
				$data = $this->security->xss_clean($data);
				$result = $this->Staff_model->add_staff($data);
				if($result){
					$this->session->set_flashdata('success', 'Staff has been added successfully!');
					redirect(base_url('admin/staff'));
				}
			}
		}
		else{
			$data['title'] = '';
			$data['staff_roles'] = $this->Staff_model->all_staff_roles();
            //print_r($data); die;
			$this->load->view('admin/includes/_header');
			$this->load->view('admin/staff/add', $data);
			$this->load->view('admin/includes/_footer');
		}
	}

	//-----------------------------------------------------------
	public function edit($id=0){

		$this->rbac->check_operation_access(); // check opration permission
        $this->load->library('upload');
		if($this->input->post('submit')){
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('dob', 'Date Of Birth', 'trim');
			$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
			$this->form_validation->set_rules('role_id', 'Staff Role', 'trim');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/staff/edit/'.$id),'refresh');
			}
			else{
			    
			    $data = array(
					'role_id' => $this->input->post('role_id'),
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'dob' => $this->input->post('dob'),
					'mobile' => $this->input->post('mobile'),
					'email' => $this->input->post('email'),
					'gender' => $this->input->post('gender'),
					'update_date' => date('Y-m-d H:i:s')
				);
			    
			    if($_FILES['staff_img']['size'] > 0){
                $_FILES['staff_img']['name']    =   time().$_FILES['staff_img']['name'];
                $config['upload_path'] = './uploads/staffimage';
                $config['allowed_types'] = 'gif|jpeg|jpg|png';
                // $config['max_size'] = 2000;
                // $config['max_width'] = 1500;
                // $config['max_height'] = 1500;
                $this->upload->initialize($config);
                
                    if(!$this->upload->do_upload('staff_img')){
                        //echo $this->upload->display_errors('<p>', '</p>');
    				}else{
    				    $data['staff_image'] = $_FILES['staff_img']['name'];
    				}
			    }
			    
			    
				$data = $this->security->xss_clean($data);
				$result = $this->Staff_model->edit_staff($data, $id);
				$result = true;
				if($result){
					$this->session->set_flashdata('success', 'Staff has been updated successfully');
					redirect(base_url('admin/staff'));
				}
			}
		}
		else{
			$data['title'] = '';
			$data['record'] = $this->Staff_model->get_staff_by_id($id);
			$data['staff_roles'] = $this->Staff_model->all_staff_roles();
			$this->load->view('admin/includes/_header');
			$this->load->view('admin/staff/edit', $data);
			$this->load->view('admin/includes/_footer');
		}
	}

	//------------------------------------------------------------
	public function delete($id=''){

		$this->rbac->check_operation_access(); // check opration permission

		$this->Staff_model->delete_staff($id);

		$this->session->set_flashdata('msg','Staff has been deleted Successfully.');	
		redirect('admin/staff');
	}

	//-----------------------------------------------------------
	public function change_status(){

		$this->rbac->check_operation_access(); // check opration permission

		$this->admin_roles->change_status();
	}


}

?>