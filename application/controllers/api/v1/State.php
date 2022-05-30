<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'libraries/api-libraries/API_Controller.php'; // for load

class State extends API_Controller {
    
    public function __construct() {
        parent::__construct();
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");
        
    }
    
    public function state_single_record(){
        $this->_apiConfig([
            'methods' => ['POST'],
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        $state_id    = $post->state_id;
        $records     = $this->StateModel->_get_single_state_records($state_id);
        if(empty($records)){
            $this->api_return(array('status' =>false,'message' => 'State Data not found !'),self::HTTP_OK);exit;
        }
        $this->api_return(array('status' =>true,'message' => 'State Data found !','data'=>$records),self::HTTP_OK);exit;
    }
    
    public function get_single_country_records(){
        $this->_apiConfig([
            'methods' => ['POST'],
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        $country_id    = $post->country_id;
        $records       = $this->StateModel->_get_single_country_records($country_id);
        if(empty($records)){
            $this->api_return(array('status' =>false,'message' => 'Country Data not found !'),self::HTTP_OK);exit;
        }
        $this->api_return(array('status' =>true,'message' => 'Country Data found !','data'=>$records),self::HTTP_OK);exit;
    }
    
    public function index(){
        $this->_apiConfig([
            'methods' => ['GET'],
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $records     = $this->StateModel->_get_state_records();
        if(empty($records)){
            $this->api_return(array('status' =>false,'message' => 'State Data not found !'),self::HTTP_OK);exit;
        }
        $this->api_return(array('status' =>true,'message' => 'State Data found !','data'=>$records),self::HTTP_OK);exit;
    }
    
    public function country_list(){
        $this->_apiConfig([
            'methods' => ['GET'],
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $records     = $this->StateModel->_get_country_records();
        if(empty($records)){
            $this->api_return(array('status' =>false,'message' => 'Country Data not found !'),self::HTTP_OK);exit;
        }
        $this->api_return(array('status' =>true,'message' => 'Country Data found !','data'=>$records),self::HTTP_OK);exit;
    }
    
    public function country_create(){
        $this->_apiConfig([
            'methods' => ['POST'],
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->country_name) || !isset($post->country_name)){
            $this->api_return(array('status' =>false,'message' => 'Please Give any keyword !'),self::HTTP_OK);exit;
        }
        $data['country_name']             = $post->country_name;
        $data['country_code']             = $post->country_code;
        $data['country_create_at']        = date('Y-m-d H:i:s');

        if($this->BaseModel->_inser_query('dk_country',$data)){
            $insert_id = $this->db->insert_id();
            $this->api_return(array('status' =>true,'country_id' =>$insert_id,'message' => 'Country successfully added !'),self::HTTP_OK);exit;
        }else{
            $this->api_return(array('status' =>false,'message' => 'Oops! Something went wrong ! Help us improve your experience by sending an error report  !'),self::HTTP_OK);exit;
        }
    }
    
    
    
    public function create(){
        $this->_apiConfig([
            'methods' => ['POST'],
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->state_name) || !isset($post->state_name)){
            $this->api_return(array('status' =>false,'message' => 'Please Give any keyword !'),self::HTTP_OK);exit;
        }
        $data['state_name']             = $post->state_name;
        $data['state_create_at']       = date('Y-m-d H:i:s');

        if($this->BaseModel->_inser_query('dk_state',$data)){
            $insert_id = $this->db->insert_id();
            $this->api_return(array('status' =>true,'state_id' =>$insert_id,'message' => 'State successfully added !'),self::HTTP_OK);exit;
        }else{
            $this->api_return(array('status' =>false,'message' => 'Oops! Something went wrong ! Help us improve your experience by sending an error report  !'),self::HTTP_OK);exit;
        }
    }
    
    public function country_update(){
        $this->_apiConfig([
            'methods' => ['POST'],
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        $country_id                       = $post->country_id;
        $data['country_name']             = $post->country_name;
        $data['country_code']             = $post->country_code;
        $data['country_update_at']        = date('Y-m-d H:i:s');
        
       if($this->BaseModel->_update_query('dk_country',$data,array('country_id'=>$country_id))){
            $this->api_return(array('status' =>true,'message' => 'Country successfully updated !'),self::HTTP_OK);exit;
        }else{
            $this->api_return(array('status' =>false,'message' => 'Oops! Something went wrong ! Help us improve your experience by sending an error report  !'),self::HTTP_OK);exit;
        }
    }
    
    public function update(){
        $this->_apiConfig([
            'methods' => ['POST'],
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        $state_id                       = $post->state_id;
        $data['state_id']               = $post->state_id;
        $data['state_name']             = $post->state_name;
        $data['state_create_at']        = date('Y-m-d H:i:s');
        
       if($this->BaseModel->_update_query('dk_state',$data,array('state_id'=>$state_id))){
            $this->api_return(array('status' =>true,'message' => 'State successfully updated !'),self::HTTP_OK);exit;
        }else{
            $this->api_return(array('status' =>false,'message' => 'Oops! Something went wrong ! Help us improve your experience by sending an error report  !'),self::HTTP_OK);exit;
        }
    }  
    
    public function city(){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->state_id) || !isset($post->state_id)){
            $this->api_return(array('status' =>false,'error' => 'State ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        $records     = $this->StateModel->_get_city_records($post->state_id);
        if(empty($records)){
            $this->api_return(array('status' =>false,'error' => 'City Data not found !'),self::HTTP_OK);exit;
        }
        $this->api_return(array('status' =>true,'error' => 'City Data found !','data'=>$records),self::HTTP_OK);exit;
    }
    
    public function locality(){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->city_id) || !isset($post->city_id)){
            $this->api_return(array('status' =>false,'error' => 'State ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        $records     = $this->StateModel->_get_locality_records($post->city_id);
        if(empty($records)){
            $this->api_return(array('status' =>false,'error' => 'Locality Data not found !'),self::HTTP_OK);exit;
        }
        $this->api_return(array('status' =>true,'error' => 'Locality Data found !','data'=>$records),self::HTTP_OK);exit;
    }
    
    
    
}