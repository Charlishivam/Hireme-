<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();
		$this->load->model('admin/user_model', 'user_model');

	}

	//-----------------------------------------------------------
	// public function index(){

	// 	$this->load->view('admin/includes/_header');
	// 	$this->load->view('admin/users/user_list');
	// 	$this->load->view('admin/includes/_footer');
	// }

	public function index(){
		 
		
		$data['result']=$this->user_model->allUser();
			$this->load->view('admin/includes/_header');
		 	$this->load->view('admin/users/index',$data);
		 	$this->load->view('admin/includes/_footer');
		 }
	


	//-----------------------------------------------------------
	function change_status()
	{   
		$id=$this->uri->segment(4);
		$status=$this->uri->segment(5);
		$sts="";
		if($status==0){ $sts=1;}else{ $sts=0; }
		
		$sql="UPDATE `customer` SET `status`='$sts' WHERE `customer_id`='$id'";
		$query=$this->db->query($sql);
		if($query){


			$this->session->set_flashdata('success','Status Chnage Succssfully !!');
			redirect('admin/Users','refresh');
		}else{

			$this->session->set_flashdata('errors','Status Not Change !!');
			redirect('admin/Users','refresh');
		}
	}



	//---------------------------------------------------------------
	public function add(){
		
		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
			$this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
			$this->form_validation->set_rules('mobile_no', 'Number', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/users/add'),'refresh');
			}
			else{
				$data = array(
					'username' => $this->input->post('username'),
					'firstname' => $this->input->post('firstname'),
					'lastname' => $this->input->post('lastname'),
					'email' => $this->input->post('email'),
					'mobile_no' => $this->input->post('mobile_no'),
					'address' => $this->input->post('address'),
					'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->user_model->add_user($data);
				if($result){
					$this->session->set_flashdata('success', 'User has been added successfully!');
					redirect(base_url('admin/users'));
				}
			}
		}
		else{
			$this->load->view('admin/includes/_header');
			$this->load->view('admin/users/user_add');
			$this->load->view('admin/includes/_footer');
		}
		
	}

	//---------------------------------------------------------------
	public function edit($id = 0){

		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
			
			$this->form_validation->set_rules('firstname', 'firstname', 'trim|required');
			$this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
			$this->form_validation->set_rules('mobile_no', 'Number', 'trim|required');
			$this->form_validation->set_rules('status', 'Status', 'trim|required');
			$this->form_validation->set_rules('wallet', 'wallet', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('admin/users/edit/'.$id),'refresh');
			}
			else{
				$data = array(
					
					'first_name' => $this->input->post('firstname'),
					
					'last_name' => $this->input->post('lastname'),
					'full_name' =>$this->input->post('firstname').' '.$this->input->post('lastname'),
					'email' => $this->input->post('email'),
					'mobile' => $this->input->post('mobile_no'),
					
					'wallet' => $this->input->post('wallet'),
					'status' => $this->input->post('status'),
					'update_date' => date('Y-m-d : h:m:s'),
				);
				
				$data = $this->security->xss_clean($data);
				$result = $this->user_model->edit_user($data, $id);
				if($result){
					$this->session->set_flashdata('success', 'User has been updated successfully!');
					redirect(base_url('admin/users'));
				}
			}
		}
		else{
			$data['user'] = $this->user_model->get_user_by_id($id);
			
			$this->load->view('admin/includes/_header');
			$this->load->view('admin/users/user_edit', $data);
			$this->load->view('admin/includes/_footer');
		}
	}

	//---------------------------------------------------------------
	public function delete($id = 0)
	{
		$this->rbac->check_operation_access(); // check opration permission
		
		$this->db->delete('customer', array('customer_id' => $id));
		$this->session->set_flashdata('success', 'Use has been deleted successfully!');
		redirect(base_url('admin/users'));
	}




	public function wallet()
	{
	    $id=$this->uri->segment(4);


	     //echo "<pre>"; print_r($id); echo "</pre>"; die();
	     
        $data['wallet'] = $this->user_model->get_wallet_by_id($id);
        $data['details'] = $this->user_model->get_details($id);
		
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/users/view_wallet', $data);
		$this->load->view('admin/includes/_footer');
	}
	public function transaction()
	{

	    $id=$this->input->post('id');
	    $description=$this->input->post('received_for');
	    $amountval=$this->input->post('amount');
	    $type=$this->input->post('type');
	   

	    if($type == 1){

	    	$amount = $amountval;
	    	$wallet_sum         = $this->user_model->_get_user_wallet_records($id);
	    	$total              = $wallet_sum->add_amount - $wallet_sum->minus_amount;
	    	$balance            = $total + $amount;

	    }

	    if($type == 2){

	    	$amount = $amountval;
	    	$wallet_sum         = $this->user_model->_get_user_wallet_records($id);
	    	$total              = $wallet_sum->add_amount - $wallet_sum->minus_amount;
	    	$balance            = $total - $amount;
	    	
	    	
	    }


	    $data=array(
	        'user_id'=>$id,
	        'user_type'=>1,	
	        'amount'=>$amount,
	        'transaction_id'=>uniqid(),
	        'transaction_type'=>$type,
	        'status'=>1,
	        'balance'=>$balance,
	        'description'=>$description
	        );


	    $result  = $this->user_model->transaction($data);
    	if($result){
				$this->session->set_flashdata('success', 'Transaction has been added successfully!');
				redirect($_SERVER['HTTP_REFERER']);
		}else{

			$this->session->set_flashdata('success', 'Transaction has been added successfully!');
				redirect($_SERVER['HTTP_REFERER']);
		}
	    
	}


	public function view()
	{
	    $id=$this->uri->segment(4);
        $data['wallet'] = $this->user_model->get_wallet_by_id($id);
        $data['single'] = $this->user_model->get_user_details_by_id($id);

        $total = $this->user_model->_get_user_wallet_records($id);
        $data['wallet_sum'] = $total->add_amount - $total->minus_amount;
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/users/user_view', $data);
		$this->load->view('admin/includes/_footer');
	}


	public function details($id=''){

		$this->rbac->check_operation_access(); // check opration permission
		$data['title'] = '';



        $this->load->view('admin/includes/_header');
        $this->load->view('admin/users/user_booking_view', $data);
        $this->load->view('admin/includes/_footer');
	}


	public function get_address_by_customer()
    {
        $this->data['address'] = $this->user_model->get_add_by_customer($this->input->post('user_id'));
        echo(json_encode($this->data['address']));
    }













	public function addaddress(){


		
		
		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){

			//echo "<pre>"; print_r($_POST); echo "<pre>"; die();
			
			$this->form_validation->set_rules('customer_id', 'customer_id', 'trim|required');
			$this->form_validation->set_rules('name', 'name', 'trim|required');
			$this->form_validation->set_rules('phone', 'phone', 'trim|required');
			$this->form_validation->set_rules('address', 'address', 'trim|required');


			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/users/user_order_booking'),'refresh');
				
			}
			else{
				$data = array(
					'user_id' => $this->input->post('customer_id'),
					'name' => $this->input->post('name'),
					'phone' => $this->input->post('phone'),
					'address' => $this->input->post('address'),
					'pincode' => $this->input->post('pincode'),
					'lng' => $this->input->post('lng'),
					'lat' => $this->input->post('lat'),
					'create_at' => date('Y-m-d : h:m:s'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->user_model->add_address($data);
				if($result){
					$this->session->set_flashdata('success', 'Address has been added successfully!');
					redirect(base_url('admin/users/user_order_booking'),'refresh');
				}
			}
		}
	
	}


	public function docadd()
	{

		echo "<pre>"; print_r($_POST); echo "</pre>"; 
		echo "<pre>"; print_r($_FILES); echo "</pre>"; die();



		$this->form_validation->set_rules('user_id', 'user id', 'trim|required');
		if ($this->form_validation->run() == true) {



			
			/*adhar card Upload */
			$this->BaseModel->__constomdo_uploads('./front-end/images/vendor/', 'aadhar');
			if ($this->upload->data('file_name')) {
				$adharimage['doc_type']		= 'Aadhar';
				$adharimage['doc_create_at'] = date('Y-m-d H:i:s');
				$adharimage['doc_admin_id'] = $this->data['userdetails']->admin_id;
				$adharimage['doc_name'] 	= $this->upload->data('file_name');
				$this->BaseModel->_inser_query('tbl_documents', $adharimage);
			}

			/*pan card Upload */
			$this->BaseModel->__constomdo_uploads('./front-end/images/vendor/', 'pancard');
			if ($this->upload->data('file_name')) {
				$pancard['doc_type']		= 'Pan';
				$pancard['doc_create_at'] = date('Y-m-d H:i:s');
				$pancard['doc_admin_id'] = $this->data['userdetails']->admin_id;
				$pancard['doc_name'] = $this->upload->data('file_name');
				$this->BaseModel->_inser_query('tbl_documents', $pancard);
			}
			redirect('vendor');
		}
		$this->load->view('vendor/setup-vendor-page', $this->data);
	}



	    	//-----------------------------------------------------------
	// public function docadd(){

		 
	// 	 echo "<pre>"; print_r($_FILES); echo "</pre>"; die();

	//   // now code for add product category
	// 	$this->rbac->check_operation_access(); // check opration permission
	// 	$this->form_validation->set_rules('vehicle_name', 'vehicle Name', 'required');

 //        if($this->form_validation->run() == true){ 


 //        	/*adhar card Upload */
	// 		$this->BaseModel->__constomdo_uploads('./uploads/images/user/', 'aadhar');
	// 		if ($this->upload->data('file_name')) {
	// 			$adharimage['doc_type']		= 'Aadhar';
	// 			$adharimage['doc_create_at'] = date('Y-m-d H:i:s');
	// 			$adharimage['doc_admin_id'] = $this->data['userdetails']->admin_id;
	// 			$adharimage['doc_name'] 	= $this->upload->data('file_name');
	// 			$this->BaseModel->_inser_query('tbl_documents', $adharimage);
	// 		}

	// 		/*pan card Upload */
	// 		$this->BaseModel->__constomdo_uploads('./uploads/images/user/', 'pancard');
	// 		if ($this->upload->data('file_name')) {
	// 			$pancard['doc_type']		= 'Pan';
	// 			$pancard['doc_create_at'] = date('Y-m-d H:i:s');
	// 			$pancard['doc_admin_id'] = $this->data['userdetails']->admin_id;
	// 			$pancard['doc_name'] = $this->upload->data('file_name');
	// 			$this->BaseModel->_inser_query('tbl_documents', $pancard);
	// 		}


	// 		/*pan card Upload */
	// 		$this->BaseModel->__constomdo_uploads('./uploads/images/user/', 'driving');
	// 		if ($this->upload->data('file_name')) {
	// 			$driving['doc_type']		= 'driving';
	// 			$driving['doc_create_at'] = date('Y-m-d H:i:s');
	// 			$driving['doc_admin_id'] = $this->data['userdetails']->admin_id;
	// 			$driving['doc_name'] = $this->upload->data('file_name');
	// 			$this->BaseModel->_inser_query('tbl_documents', $driving);
	// 		}




 //              $data['vehicle_name'] = $this->input->post('vehicle_name');
 //              $data['vehicle_create_at']        = date('Y-m-d H:i:s');
              



              
 //            if($this->Base_model->_inser_query('vehicle_type',$data)) {
 //              $this->session->set_flashdata('success', 'vehicle have been successfully created !');
 //            }else{
 //                $this->session->set_flashdata('error', 'Some have error ! please try again ');
 //            }
 //            redirect('admin/vehicle');
 //        }
       

 //        $data['title'] = '';
	// 	$this->load->view('admin/includes/_header');
	// 	$this->load->view('admin/vehicle/add', $data);
	// 	$this->load->view('admin/includes/_footer');
	// }








}





?>
