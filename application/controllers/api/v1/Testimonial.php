<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'libraries/api-libraries/API_Controller.php'; // for load

class Testimonial extends API_Controller {
    
    public function __construct() {
        parent::__construct();
        
        
    }
    
    public function index(){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        
        $post = json_decode(file_get_contents('php://input'));
        
        $offset      = isset($post->offset) && !empty($post->offset) ? $post->offset : 100; 
        $count       = isset($post->count) && !empty($post->count) ? $post->count : 0;
        $records     = $this->TestimonialModel->_get_testimonial_records($offset,$count);
        
        if($records->num_rows() <= 0){
            $this->api_return(array('status' =>false,'error' => 'Testimonial Data not found !'),self::HTTP_OK);exit;
        }
        $this->api_return(array('status' =>true,'error' => 'Testimonial Data found !','data'=>$records->result()),self::HTTP_OK);exit;
    }
    
    public function details(){
        $this->_apiConfig([
            'methods' => ['POST'],
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->testimonial_id) || !isset($post->testimonial_id) ){
            $this->api_return(array('status' =>false,'error' => 'Testimonial ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        $testimonial_id     = $post->testimonial_id; 
        $details     = $this->TestimonialModel->_get_testimonial_records_by_id($testimonial_id);
        
        if($details->num_rows() <= 0){
            $this->api_return(array('status' =>false,'error' => 'Testimonial Data not found !'),self::HTTP_OK);exit;
        }
        $this->api_return(array('status' =>true,'error' => 'Testimonial Data found !','data'=>$details->row()),self::HTTP_OK);exit;
    }
    
}