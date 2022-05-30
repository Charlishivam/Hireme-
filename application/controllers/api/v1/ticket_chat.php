<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'libraries/api-libraries/API_Controller.php'; // for load

class ticket_chat extends API_Controller {

    public function __construct() {
        parent::__construct();
        
    }
    
    public function create(){
        $this->_apiConfig([
            'methods' => ['POST'],
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->customer_id) || !isset($post->customer_id)){
            $this->api_return(array('status' =>false,'error' => 'Customer ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        if(empty($post->message) || !isset($post->message)){
            $this->api_return(array('status' =>false,'error' => 'Message is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        if(empty($post->subject) || !isset($post->subject)){
            $this->api_return(array('status' =>false,'error' => 'Subject is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        $customer_id = $post->customer_id;
        $message     = $post->message;
        $subject     = $post->subject;
        $type        = $post->type;
        $admin_id    = 31;
        
         $customer_details = $this->BaseModel->_single_data_query(array('customer_id'=>$customer_id),'park_customer');
        if($customer_details->num_rows() <= 0 ){
           $this->api_return(array('status' =>false,'error' => 'Customer Does Not Exist !'),self::HTTP_OK);exit;
       }
        $customer_details = $this->BaseModel->_single_data_query(array('customer_id'=>$customer_id),'park_customer');
        if($customer_details->num_rows() <= 0 ){
           $this->api_return(array('status' =>false,'error' => 'Customer Does Not Exist !'),self::HTTP_OK);exit;
       }
       
        $data['user_id']        = $customer_id;
        $data['subject']        = $subject;
        $data['booking_id']     = 0;
        $data['service_id']     = 0;
        $data['rider_id']       = 0;
        $data['type']           = $type;
        $data['admin_id']       = $admin_id;
        $data['created_at']     = date('Y-m-d h:i:s');
        $data['status']         = '0';
        
        if($this->BaseModel->_inser_query('ticket_support',$data)) {
              $last_id = $this->db->insert_id();
              $data['unique_id'] = $this->_ganrate_referral($last_id,'TIC');
              $this->BaseModel->_update_query('ticket_support',$data,array('id'=>$last_id));
              
              $form['ticket_id'] = $last_id;
              $form['from_type'] = 1;
              $form['from_id']   = $customer_id;
              $form['message']   = $message;
              $form['created_at']  = date('Y-m-d h:i:s');
              $this->BaseModel->_inser_query('ticket_chat',$form);
              
              $this->api_return(array('status' =>true,'message' => 'your ticket successfully have been generated !'),self::HTTP_OK);exit;
            }else{
              $this->api_return(array('status' =>false,'error' => 'Oops! Something went wrong ! Help us improve your experience by sending an error report  !'),self::HTTP_OK);exit;
        }
    }
}