<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'libraries/api-libraries/API_Controller.php'; // for load

class Slider extends API_Controller {
    
    public function __construct() {
        parent::__construct();
        
    }
    
    public function index(){
        $this->_apiConfig([
            'methods' => ['GET'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
       
       $results = $this->BaseModel->_ci_data_query(array('slider_status'=>'1'),'dk_slider','slider_id,slider_name,concat("'.base_url().'",slider_url) as slider_url,slider_type,slider_link');
       if($results->num_rows() <= 0 ){
           $this->api_return(array('status' =>false,'error' => 'Data Not Found !'),self::HTTP_OK);exit;
       }
       
       $this->api_return(array('status' =>true,'error' => 'Data Found !','data'=>$results->result()),self::HTTP_OK);exit;
    }
    
    public function banner(){
        $this->_apiConfig([
            'methods' => ['GET'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        
         
       $results = $this->BaseModel->_ci_data_query(array('banner_status'=>'1'),'dk_banner','banner_id,banner_name,concat("'.base_url().'",banner_url) as banner_url,banner_type,banner_text_url');
       
       if($results->num_rows() <= 0 ){
           $this->api_return(array('status' =>false,'error' => 'Data Not Found !'),self::HTTP_OK);exit;
       }
       
       $this->api_return(array('status' =>true,'msg' => 'Data Found !','data'=>$results->result()),self::HTTP_OK);exit;
    }
}