<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'libraries/api-libraries/API_Controller.php'; // for load
class Coupon extends API_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $this->_apiConfig([
            'methods' => ['GET'],
             'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        
        $records     = $this->BaseModel->_single_data_query(array('status'=>'1'),'park_coupon')->result_array();
        
        if(empty($records)){
            $this->api_return(array('status' =>false,'error' => 'Coupon Data not found !'),self::HTTP_OK);exit;
        }
      
        $this->api_return(array('status' =>true,'error' => 'Coupon Data found !','data'=>$records),self::HTTP_OK);exit;
    }
    
    public function apply(){
        $this->_apiConfig([
            'methods' => ['POST'],
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post  = json_decode(file_get_contents('php://input'));
        if(empty($post->coupon_code) || !isset($post->coupon_code)){
            $this->api_return(array('status' =>false,'error' => 'Coupon code is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->booking_amoount) || !isset($post->booking_amoount)){
            $this->api_return(array('status' =>false,'error' => 'Booking amoount is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        $coupon_code     = $post->coupon_code;
        $booking_amoount = $post->booking_amoount;
        
        $records     = $this->BaseModel->_single_data_query(array('status'=>'1','coupon_code'=>$coupon_code),'park_coupon');
        if($records->num_rows() <= 0){
            $this->api_return(array('status' =>false,'error' => 'Coupon data not found !'),self::HTTP_OK);exit;
        }
        
        $row   = $records->row();
        $today = strtotime(date('Y-m-d'));
        
        if($row->minimum_order_amount > $booking_amoount){
            $this->api_return(array('status' =>false,'error' => 'Coupon applied amount not eligible !'),self::HTTP_OK);exit;
        }
        
        if($today >= strtotime($row->valid_upto)){
            $this->api_return(array('status' =>false,'error' => 'Discount code has been expired !'),self::HTTP_OK);exit;
        }
        
        $discount_amount = 0;
        if($row->coupon_type ='PERCENT'){
            $discount_amount = $booking_amoount / 100 * $row->coupon_discount;
        }else{
            $discount_amount = $row->coupon_discount;
        }
        
        $data['discount_amount'] = $discount_amount;
        $data['booking_amount']  = $booking_amoount-$discount_amount;
        $data['discount_code']   = $coupon_code;
        $this->api_return(array('status' =>true,'error' => 'Applied !','data'=>$data),self::HTTP_OK);exit;
    }
}