<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'libraries/api-libraries/API_Controller.php'; // for load

class Blogs extends API_Controller {
    
    public function __construct() {
        parent::__construct();
        
        
    }
    
    public function index(){
        $this->_apiConfig([
            'methods' => ['POST'],
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        
        $post = json_decode(file_get_contents('php://input'));
        
        $offset      = isset($post->offset) && !empty($post->offset) ? $post->offset : 100; 
        $count       = isset($post->count) && !empty($post->count) ? $post->count : 0;
        $records     = $this->BlogsModel->_get_blogs_records($offset,$count);
        if($records->num_rows() <= 0){
            $this->api_return(array('status' =>false,'error' => 'Blogs Data not found !'),self::HTTP_OK);exit;
        }
        foreach($records->result() as $key => $data ){
           $records->result()[$key]->blog_create_at = date('M Y',strtotime($data->blog_create_at));
        }
        $this->api_return(array('status' =>true,'error' => 'Blogs Data found !','data'=>$records->result()),self::HTTP_OK);exit;
    }
    
    public function details(){
        $this->_apiConfig([
            'methods' => ['POST'],
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->blog_id) || !isset($post->blog_id) ){
            $this->api_return(array('status' =>false,'error' => 'Blog ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        $blog_id     = $post->blog_id; 
        $details     = $this->BlogsModel->_get_blogs_records_by_id($blog_id);
        
        if($details->num_rows() <= 0){
            $this->api_return(array('status' =>false,'error' => 'Blogs Data not found !'),self::HTTP_OK);exit;
        }
        $this->api_return(array('status' =>true,'error' => 'Blogs Data found !','data'=>$details->row()),self::HTTP_OK);exit;
    }
    
}