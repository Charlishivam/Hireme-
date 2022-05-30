<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'libraries/api-libraries/API_Controller.php'; // for load

class Faq extends API_Controller {
    
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
        $records     = $this->FaqModel->_get_faq_records($offset,$count);
        
        foreach($records->result() as $key => $value){
            $records->result()[$key]->knowedge_answer_home =  strip_tags($value->knowedge_answer_home);
        }
        
        if($records->num_rows() <= 0){
            $this->api_return(array('status' =>false,'error' => 'Faq Data not found !'),self::HTTP_OK);exit;
        }
        $this->api_return(array('status' =>true,'error' => 'Faq Data found !','data'=>$records->result()),self::HTTP_OK);exit;
    }
    
    public function details(){
        $this->_apiConfig([
            'methods' => ['POST'],
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->knowedge_id) || !isset($post->knowedge_id) ){
            $this->api_return(array('status' =>false,'error' => 'Faq ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        $knowedge_id     = $post->knowedge_id; 
        $details         = $this->FaqModel->_get_faq_records_by_id($knowedge_id);
        
        if($details->num_rows() <= 0){
            $this->api_return(array('status' =>false,'error' => 'Faq Data not found !'),self::HTTP_OK);exit;
        }
        $this->api_return(array('status' =>true,'error' => 'Faq Data found !','data'=>$details->row()),self::HTTP_OK);exit;
    }
    
}