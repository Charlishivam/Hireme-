<?php
class Notification extends MY_Controller
{
    function __construct(){

        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();
        $this->load->model('Base_model');
        $this->load->helper('data_helper');
		$this->load->model('admin/Notification_model', 'Notification_model');

	
    }


	public function index() {
        $this->rbac->check_operation_access(); // check opration permission
        $data['records']            = $this->Notification_model->get_all_notification(false);
        $this->Base_model->_get_pagination($data['records']);
        $data["paginetionlinks"]    = $this->pagination->create_links();
        $data['records']            = $this->Notification_model->get_all_notification(true);
        $this->load->view('admin/includes/_header');
        $this->load->view('admin/notification/index', $data);
        $this->load->view('admin/includes/_footer');
    }
	//-----------------------------------------------------------
	public function add(){




		$this->rbac->check_operation_access(); // check opration permission
		$this->form_validation->set_rules('notification_title', 'notification Name', 'required');
        if($this->form_validation->run() == true){ 
         $type                           = $this->input->post('notification_type');
		 $notification_title  			= $this->input->post('notification_title');
         $notification_description 		= $this->input->post('notification_description');
         $notification_create_at  		= date('Y-m-d H:i:s');
          $this->Base_model->__constomdo_uploads('./uploads/notification_image/','notification_image');
	      if(!empty($this->upload->data('file_name'))){
	        $notification_image = base_url('uploads/notification_image/'.$this->upload->data('file_name'));
	      }


	      if($type == '1'){
         	if(!empty($this->input->post('customer_id'))){
         		$service = $this->input->post('customer_id');
         		$rid['notification_title']  = $notification_title;
     			$rid['notification_description'] = $notification_description;
     			$rid['notification_type']   = $type;
     			$rid['notification_create_at']   = $notification_create_at;
     			$rid['notification_image']  = $notification_image;
         		foreach ($service as $service => $service_id) {
         			$rid['notification_user_id']  =  $service_id;
         			$this->Base_model->_inser_query('dk_notification',$rid);
         			
         		}
			}
			  
         }



         if($type == '0'){

         	if(!empty($this->input->post('customer_id'))){
         		$normal = $this->input->post('customer_id');
         		$nor['notification_title']  = $notification_title;
     			$nor['notification_description'] = $notification_description;
     			$nor['notification_type']   = $type;
     			$nor['notification_create_at']   = $notification_create_at;
     			$nor['notification_image']  = $notification_image;
         		foreach ($normal as $normal => $normal_id) {
         			$nor['notification_user_id']  =  $normal_id;
         			$this->Base_model->_inser_query('dk_notification',$nor);
         			
         		}
			}
			  
         }



         if($type == '0'){
			if(!empty($this->input->post('customer_id'))){
		    	$customer_id  =  implode(',',$this->input->post('customer_id'));
				$resultc = $this->Notification_model->get_normal_customer_token($customer_id);
				foreach ($resultc as $iew => $idsew) {
                  	$senderids[] = $idsew['customer_device_token'];
                  }
			}
		}
		if($type == '1'){
			if(!empty($this->input->post('customer_id'))){
				$customer_id  =  implode(',',$this->input->post('customer_id'));
				$result = $this->Notification_model->get_service_customer_token($customer_id);
				
				foreach ($result as $ids => $idss) {
                  	$senderids[] = $idss['customer_device_token'];
                  }
				
		
		    
			}
		}

        if($this->form_validation->run() == true) {
        	if(!empty($senderids)){
			$this->send_push_notification($senderids,$notification_title,$notification_description,$notification_image); 
			}
          $this->session->set_flashdata('success', 'Notification have been successfully created !');
        }else{
            $this->session->set_flashdata('error', 'Some have error ! please try again ');
        }
        redirect('admin/notification');
    }

        $data['service_customer'] = $this->Notification_model->_get_all_service_customer_records();
        $data['normal_customer'] = $this->Notification_model->_get_all_normal_customer_records();
       
        $data['title'] = '';
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/notification/add', $data);
		$this->load->view('admin/includes/_footer');
	}


  

	//------------------------------------------------------------
	public function delete($id=''){
		$this->rbac->check_operation_access(); // check opration permission
		$notification_id =$this->uri->segment(4);
		if($this->Base_model->_delete_query('dk_notification',array('notification_id'=>$notification_id))) {
		  $this->session->set_flashdata('success','Notification has been deleted Successfully.');	
		  redirect('admin/notification');
		}
	}

		//-----------------------------------------------------------


}




	

?>