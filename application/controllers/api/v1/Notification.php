<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'libraries/api-libraries/API_Controller.php'; // for load

class Notification extends API_Controller {

    public function __construct() {
        parent::__construct();
        
    }
    
    public function list(){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->customer_id) || !isset($post->customer_id)){
            $this->api_return(array('status' =>false,'error' => 'Customer ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        $result = $this->BaseModel->_ci_data_query(array('notification_user_id'=>$post->customer_id,'notification_status'=>'1'),'dk_notification','*');
        if($result->num_rows() <= 0){
            $this->api_return(array('status' =>false,'error' => 'Data Not Found !'),self::HTTP_OK);exit;
        }
        $this->api_return(array('status' =>true,'error' => 'Data Found !','data'=>$result->result()),self::HTTP_OK);exit;
        }
    
    public function details($notification_id){
        $this->_apiConfig([
            'methods' => ['GET'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        
        if(empty($notification_id)){
        $this->api_return(array('status' =>false,'error' => 'Notification ID  is empty Or missing !'),self::HTTP_OK);exit;
        }
        $result = $this->BaseModel->_ci_data_query(array('notification_id'=>$notification_id,'notification_status'=>'1'),'dk_notification','*');
        if($result->num_rows() <= 0){
        $this->api_return(array('status' =>false,'error' => 'Data Not Found !'),self::HTTP_OK);exit;
        }
        $this->api_return(array('status' =>true,'error' => 'Data Found !','data'=>$result->row()),self::HTTP_OK);exit;
    }
}