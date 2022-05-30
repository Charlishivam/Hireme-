<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'libraries/api-libraries/API_Controller.php'; // for load

class Postconversation extends API_Controller {

    public function __construct() {
        parent::__construct();
    }
    
    public function create(){
        $this->_apiConfig([
            'methods' => ['POST'],
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->dk_post_id) || !isset($post->dk_post_id)){
            $this->api_return(array('status' =>false,'error' => 'Post ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->dk_post_type) || !isset($post->dk_post_type)){
            $this->api_return(array('status' =>false,'error' => 'Post Type is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->dk_customer_id) || !isset($post->dk_customer_id)){
            $this->api_return(array('status' =>false,'error' => 'Customer Id is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->message) || !isset($post->message)){
            $this->api_return(array('status' =>false,'error' => 'Message is empty Or missing !'),self::HTTP_OK);exit;
        }
        $dk_post_id                 = $post->dk_post_id;
        $dk_post_type               = $post->dk_post_type;
        $dk_customer_id             = $post->dk_customer_id;
        $message                    = $post->message;
        $customer_details       = $this->BaseModel->_single_data_query(array('customer_id'=>$dk_customer_id),'dk_customer');
        if($customer_details->num_rows() <= 0 ){
           $this->api_return(array('status' =>false,'error' => 'Customer Does Not Exist !'),self::HTTP_OK);exit;
        }
        if($dk_post_type == '2'):
            $job_post_customer_details = $this->BaseModel->_single_data_query(array('jobpost_id'=>$dk_post_id),'dk_jobpost')->row();
        endif;  
        if($dk_post_type == '1'):
            $job_post_customer_details = $this->BaseModel->_single_data_query(array('service_id'=>$dk_post_id),'dk_service')->row();
        endif; 
        $data['dk_post_id']                     = $dk_post_id;
        $data['dk_post_type']                   = $dk_post_type;
        $data['dk_post_customer_id']            = $job_post_customer_details->customer_id;
        $data['dk_customer_id']                 = $dk_customer_id;
        $data['dk_tickets_create_at']           = date('Y-m-d h:i:s');
        if($this->BaseModel->_inser_query('dk_tickets',$data)) {
               
              $last_id = $this->db->insert_id();
              $datadk_unique['dk_unique_id'] = $this->_ganrate_referral($last_id,'HIC');
              $this->BaseModel->_update_query('dk_tickets',$datadk_unique,array('dk_tickets_id'=>$last_id));
              $form['ticket_id']    = $last_id;
              $form['from_type']    = 1;
              $form['from_id']      = $dk_customer_id;
              $form['message']      = $message;
              $form['created_at']   = date('Y-m-d h:i:s');
              $this->BaseModel->_inser_query('dk_ticket_chat',$form);
              $this->api_return(array('status' =>true,'ticket_id'=>$last_id,'message' => 'your Postconversation successfully have been generated !'),self::HTTP_OK);exit;
            }else{
              $this->api_return(array('status' =>false,'error' => 'Oops! Something went wrong ! Help us improve your experience by sending an error report  !'),self::HTTP_OK);exit;
        }
    }
    
    public function conversationlist(){
        $this->_apiConfig([
            'methods' => ['POST'],
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->customer_id) || !isset($post->customer_id)){
            $this->api_return(array('status' =>false,'error' => 'Customer ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        $customer_id = $post->customer_id;
        $chat_details       = $this->PostconversationModel->_get_ticket_support($customer_id);
        if($chat_details->num_rows() <= 0 ){
           $this->api_return(array('status' =>false,'error' => 'Customer Does Not Exist !'),self::HTTP_OK);exit;
        }
        $this->api_return(array('status' =>true,'message' => 'Data  Found !','data'=>$chat_details->result()),self::HTTP_OK);exit;
    }
    
    public function conversation(){
        $this->_apiConfig([
            'methods' => ['POST'],
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->ticket_id) || !isset($post->ticket_id)){
            $this->api_return(array('status' =>false,'error' => 'Ticket ID is empty Or missing !'),self::HTTP_OK);exit;
        }
       
        $ticket_id          = $post->ticket_id;
        $chat_details       = $this->PostconversationModel->_get_ticket_chat($ticket_id);
        
        if($chat_details->num_rows() <= 0 ){
           $this->api_return(array('status' =>false,'error' => 'Data Not Found !'),self::HTTP_OK);exit;
        }
      
            foreach($chat_details->result() as $keys => $chatdata){
                $form_type = $chatdata->from_type;
                 if($form_type == '1'){
                    $this->db->select("customer_full_name");
                    $this->db->from('dk_customer');
                    $this->db->where('customer_id',$chatdata->from_id);
                    $chat_details->result()[$keys]->name  = $this->db->get()->row()->customer_full_name;
                 }
                 if($form_type == '2'){
                    $this->db->select("customer_full_name");
                    $this->db->from('dk_customer');
                    $this->db->where('customer_id',$chatdata->from_id);
                    $chat_details->result()[$keys]->name  = $this->db->get()->row()->customer_full_name;
                 }
            }
        $this->api_return(array('status' =>true,'message' => 'Data  Found !','data'=>$chat_details->result()),self::HTTP_OK);exit;
    }
    
    public function query(){
        $this->_apiConfig([
            'methods' => ['GET'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
       
       $results = $this->BaseModel->typedetails();
       $this->api_return(array('status' =>true,'message' => 'Data Found !','data'=>$results),self::HTTP_OK);exit;
    }
    
    public function chat(){
        $this->_apiConfig([
            'methods' => ['POST'],
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->ticket_id) || !isset($post->ticket_id)){
            $this->api_return(array('status' =>false,'error' => 'Customer ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->customer_id) || !isset($post->customer_id)){
            $this->api_return(array('status' =>false,'error' => 'Customer ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->message) || !isset($post->message)){
            $this->api_return(array('status' =>false,'error' => 'Message is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        if(empty($post->type) || !isset($post->type)){
            $this->api_return(array('status' =>false,'error' => 'Type is empty Or missing !'),self::HTTP_OK);exit;
        }
        $customer_id        = $post->customer_id;
        $message            = $post->message;
        $ticket_id          = $post->ticket_id;
        $type               = $post->type;
        $customer_details   = $this->BaseModel->_single_data_query(array('customer_id'=>$customer_id),'dk_customer');
        if($customer_details->num_rows() <= 0 ){
           $this->api_return(array('status' =>false,'error' => 'Customer Does Not Exist !'),self::HTTP_OK);exit;
       }
       
        $data['ticket_id']        = $ticket_id;
        $data['from_type']        = $type;
        $data['from_id']          = $customer_id;
        $data['message']          = $message;
        $data['created_at']       = date('Y-m-d H:i:s');
        
        if($this->BaseModel->_inser_query('dk_ticket_chat',$data)) {
              $this->api_return(array('status' =>true,'message' => 'your Postconversation successfully have been generated !'),self::HTTP_OK);exit;
            }else{
              $this->api_return(array('status' =>false,'error' => 'Oops! Something went wrong ! Help us improve your experience by sending an error report  !'),self::HTTP_OK);exit;
        }
    }
    
    
    public function supportnumber(){
        $this->_apiConfig([
            'methods' => ['GET'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $supportnumber       = $this->data['config'];
        if(empty($supportnumber)){
           $this->api_return(array('status' =>false,'error' => 'Data Not Found !'),self::HTTP_OK);exit;
        }
       
       $this->api_return(array('status' =>true,'message' => 'Data Found' ,'data' =>$supportnumber),self::HTTP_OK);exit;
       
        
    }
    
    
    

}