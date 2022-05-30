<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'libraries/api-libraries/API_Controller.php'; // for load

class Feedback extends API_Controller {

    public function __construct() {
        parent::__construct();
        $this->data['config']['book_pre_fix'] = 'PMP';
        $this->data['config']['park_pre_fix'] = "PMS";
    }
    
    public function create(){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->customer_id) || !isset($post->customer_id)){
            $this->api_return(array('status' =>false,'error' => 'Customer ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        //0 means Vehicle Owner 1 means Vehicle Operator 2 means Hired Vehicle
        if(!isset($post->alert_id)){
            $this->api_return(array('status' =>false,'error' => 'Alert Id is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        
        $rating = $post->feedback_rating;
        
        if($rating >= 5){
            $this->api_return(array('status' =>false,'error' => 'You cant give more than 5 ratings !'),self::HTTP_OK);exit;
        }
        
        if(!empty($post->customer_id) && isset($post->customer_id)){
            $data['feedback_customer_id']    = $post->customer_id;
        }
        if(!empty($post->alert_id) && isset($post->alert_id)){
            $data['feedback_alert_id']= $post->alert_id;
        }
        
        $data['feedback_text']           = $post->feedback_text;
        $data['feedback_rating']         = $rating;
        $data['feedback_create_at']      = date('Y-m-d h:i:s');
        $lastparkid = $this->BaseModel->_inser_query('park_feedback',$data); 
        
       
    
        if(!empty($lastparkid)){
            $this->api_return(array('status' =>true,'msg' => 'Your Feedback is Successfully Raised !','feedback_id'=>$lastparkid),self::HTTP_OK);exit;
        }
        $this->api_return(array('status' =>false,'error' => 'Your Feedback Successfully Raise has not happened !'),self::HTTP_OK);exit;
    }
    
    
    public function upcoming_review_rating(){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->customer_id) || !isset($post->customer_id)){
            $this->api_return(array('status' =>false,'error' => 'Customer ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        $rating = $post->upcoming_review_rating;
        
        if(empty($rating)){
            $this->api_return(array('status' =>false,'error' => 'It is necessary to fill your rating !'),self::HTTP_OK);exit;
        }
        
        if($rating >= 5){
            $this->api_return(array('status' =>false,'error' => 'You cant give more than 5 ratings !'),self::HTTP_OK);exit;
        }
        
        if(!empty($post->customer_id) && isset($post->customer_id)){
            $data['upcoming_review_customer_id']    = $post->customer_id;
        }
        
        
        $data['upcoming_review_name']           = $post->upcoming_review_name;
        $data['upcoming_review_rating']         = $rating;
        $data['upcoming_review_create_at']      = date('Y-m-d h:i:s');
        $lastparkid = $this->BaseModel->_inser_query('park_upcoming_review',$data); 
        
       
    
        if(!empty($lastparkid)){
            $this->api_return(array('status' =>true,'msg' => 'Your Request is Submited !','feedback_id'=>$lastparkid),self::HTTP_OK);exit;
        }
        
        $this->api_return(array('status' =>false,'error' => 'Your Request is Not Submited !'),self::HTTP_OK);exit;
    }
    
}

