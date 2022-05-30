<?php

defined('BASEPATH') or exit('No direct script access allowed');

class HelpSupport extends MY_Controller{

    function __construct(){
        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();
        $this->load->model('Base_model');
		$this->load->model('admin/HelpSupport_model', 'HelpSupport_model');
		//$this->load->model('admin/bookings_model', 'bookings_model');
    }

	//-----------------------------------------------------		
	public function index(){

		$this->rbac->check_operation_access(); // check opration permission
		$data['title'] = 'Help Desk';
		$data['ticket'] = $this->HelpSupport_model->getAllQuery();

		//echo "<pre>"; print_r($data['ticket']); echo "<pre>"; die(); 


		$this->load->view('admin/includes/_header');
		$this->load->view('admin/help_support/index', $data);
		$this->load->view('admin/includes/_footer');
	}
	
	public function repply(){
	    $id=$this->uri->segment(4);
	    $data['chat']=$this->HelpSupport_model->getChat($id);
	    $data['title'] = 'repply';
		$data['ticket'] = $this->HelpSupport_model->get_all_booking_query();
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/help_support/repply', $data);
		$this->load->view('admin/includes/_footer');
	}
	
	public function chatRepply(){
	   $ticket_id=$this->input->post('ticket_id');
	   $message=$this->input->post('message');
	   $data=$this->HelpSupport_model->chatRepply($ticket_id,$message);
	   echo json_encode($data);
	}

	public function add() {

		

        $this->rbac->check_operation_access(); // check opration permission
        $this->form_validation->set_rules('user_id', 'Customer Id', 'required');
        if($this->form_validation->run() == true){
            
        	$data['user_id']        = $this->input->post('user_id');
        	$data['type']    	    = $this->input->post('type');
        	$data['booking_id']    	= 0;
        	$data['service_id']    	= 0;
        	$data['rider_id']    	= 0;
        	$data['admin_id']    	= 31;
        	$data['created_at'] 	= date('Y-m-d H:i:s');
        	
        	$this->Base_model->_inser_query('ticket_support',$data);
        	$last_id = $this->db->insert_id();
            $uniqueticket['unique_id']  = $this->_ganrate_ticket($last_id,'TIC');
            $this->Base_model->_update_query('ticket_support',$uniqueticket,array('id'=>$last_id));

        	$chat['ticket_id'] 	    = $last_id;
        	$chat['from_type'] 	    = 1;
        	$chat['from_id'] 	    = $this->input->post('user_id');
        	$chat['message'] 	    = $this->input->post('message');
        	$chat['created_at'] 	= date('Y-m-d H:i:s');
        	
        	if($this->Base_model->_inser_query('ticket_chat',$chat)) {
                $this->session->set_flashdata('success', 'New Ticket have been successfully created !');
            } else {
                $this->session->set_flashdata('error', 'Some have error ! please try again ');
            }
            redirect('admin/HelpSupport');
        }
        $this->data['allcustomer'] = $this->HelpSupport_model->_get_all_customer_records();
        // print_r($data1['result']);die;
        $this->load->view('admin/includes/_header');
        $this->load->view('admin/help_support/add', $this->data);
        $this->load->view('admin/includes/_footer');
    }

        public function update_ticket_status(){
	        $this->rbac->check_operation_access(); 
	        $this->form_validation->set_rules('support_id', 'Ticket Id', 'required');
	        if($this->form_validation->run() == true){ 
	              $support_id            = $this->input->post('support_id');
	              $data['status']        = $this->input->post('status');
	              $data['updated_at']    = date('Y-m-d H:i:s');
	            if($this->Base_model->_update_query('ticket_support',$data,array('id'=>$support_id))) {
	              $this->session->set_flashdata('success', 'Ticket Status have been successfully updated !');
	            }else{
	                $this->session->set_flashdata('error', 'Some have error ! please try again ');
	            }
	            redirect($_SERVER['HTTP_REFERER']);
	        }
    }



		
	
	
	

}
