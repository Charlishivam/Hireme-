<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'libraries/api-libraries/API_Controller.php'; // for load

class Category extends API_Controller {
    
    public function __construct() {
        parent::__construct();
        
    }
    
    public function index(){
        $this->_apiConfig([
            'methods' => ['GET'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $records     = $this->CategoryModel->_get_category_records();
        if(empty($records)){
            $this->api_return(array('status' =>false,'error' => 'Category Data not found !'),self::HTTP_OK);exit;
        }
        $this->api_return(array('status' =>true,'error' => 'Category Data found !','data'=>$records),self::HTTP_OK);exit;
    }
    
    public function subcategory(){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->category_id) || !isset($post->category_id)){
            $this->api_return(array('status' =>false,'error' => 'Category ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        $records     = $this->CategoryModel->_get_subcategory_records($post->category_id);
        if(empty($records)){
            $this->api_return(array('status' =>false,'error' => 'Subcategory Data not found !'),self::HTTP_OK);exit;
        }
        $this->api_return(array('status' =>true,'error' => 'Subcategory Data found !','data'=>$records),self::HTTP_OK);exit;
    }
    
    
    
}