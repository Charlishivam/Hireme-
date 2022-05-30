<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'libraries/api-libraries/API_Controller.php'; // for load

class Booking extends API_Controller {

    public function __construct() {
        parent::__construct();
    }
    
    public function list($customer_id = null){
        $this->_apiConfig([
            'methods' => ['GET'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        if(empty($customer_id) || !is_numeric($customer_id)){
            $this->api_return(array('status' =>false,'error' => 'Customer ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        $result = $this->BaseModel->_run_query("select park_booking.*,park_customer.customer_fullname,customer_mobile,park_space.parking_name,parking_address,parking_city,parking_time_in,parking_time_out,parking_address2 from park_booking left join park_customer on park_customer.customer_id=park_booking.book_customer_id left join park_space on park_space.parking_id=park_booking.book_parking_id where book_customer_id='".$customer_id."' order by book_id desc");
        if($result->num_rows() <= 0){
            $this->api_return(array('status' =>false,'error' => 'Data not found !'),self::HTTP_OK);exit;
        }
        /*===========data mani pulation=============*/
        /*foreach($result->result() as $key => $data){
        }*/
        
        $this->api_return(array('status' =>true,'error' => 'Data found !','data'=>$result->result()),self::HTTP_OK);exit;
    }
    
    public function details($book_id = null){
        $this->_apiConfig([
            'methods' => ['GET'],
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        if(empty($book_id) || !is_numeric($book_id)){
            $this->api_return(array('status' =>false,'error' => 'Booking ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        $result = $this->BaseModel->_run_query("select park_booking.*,park_customer.customer_fullname,customer_mobile,park_space.parking_name,parking_address,parking_city,parking_time_in,parking_time_out,parking_address2,parking_image,parking_facilities,parking_id from park_booking left join park_customer on park_customer.customer_id=park_booking.book_customer_id left join park_space on park_space.parking_id=park_booking.book_parking_id where book_id='".$book_id."' order by book_id desc");
        if($result->num_rows() <= 0){
            $this->api_return(array('status' =>false,'error' => 'Data not found !'),self::HTTP_OK);exit;
        }
        $single  = $result->row();
        /*=============================image===============================*/
        $imagges = !empty($single->parking_image) ? json_decode($single->parking_image) : array();
        foreach($imagges as $key => $data){
            $imagges[$key]->image = base_url($data->image);
        }
        $single->parking_image = @$imagges;
        $single->parking_single_image = @$imagges[0];
        /*=============================image===============================*/
        
        /*================Vehicle for booked parking=====================*/
        $vehicles = !empty($single->book_vehicle_id) ? json_decode($single->book_vehicle_id) : array();
        foreach($vehicles as $key => $data){
            $vehicles[$key] = $this->BaseModel->_run_query("select park_vehicle_type.vehicle_name,sp_id,sp_vehicle_id,sp_parking_price from park_space_price left join park_vehicle_type on park_vehicle_type.vehicle_id =park_space_price.sp_vehicle_id where sp_id='".$data->sp_id."'")->row();
        }
        $single->parking_vehicles = @$vehicles;
        /*=================Vehicle for booked parking====================*/
        
        /*============================= F ===============================*/
        $single->parking_facilities = $this->BaseModel->_run_query("select park_space_facilities.facilities_id,park_parking_facilities.facilities_name from park_space_facilities left join park_parking_facilities on park_parking_facilities.facilities_id = park_space_facilities.facilities_parking_id where park_space_facilities.facilities_parking_id='".$single->parking_id."'")->result();
        
        /*============================= F ===============================*/
        $single->booking_share_url = base_url('api/v1/booking/details/'.$single->parking_id);
        
        $this->api_return(array('status' =>true,'error' => 'Data found !','data'=>$result->row()),self::HTTP_OK);exit;
    }
    
    public function cancle(){
        $this->_apiConfig([
            'methods' => ['POST'],
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->book_id) || !is_numeric($post->book_id) || !isset($post->book_id)){
            $this->api_return(array('status' =>false,'error' => 'Booking ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->book_cancel_resion) || !is_string($post->book_cancel_resion) || !isset($post->book_cancel_resion)){
            $this->api_return(array('status' =>false,'error' => 'Cancel Resion is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->book_cancel_by) || !is_numeric($post->book_cancel_by) || !isset($post->book_cancel_by)){
            $this->api_return(array('status' =>false,'error' => 'Cancel By is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        $book_id = $post->book_id;
        $checkbooking = $this->BaseModel->_single_data_query(array('book_id'=>$book_id),'park_booking','*');
        
        if($checkbooking->num_rows() <= 0){
            $this->api_return(array('status' =>false,'error' => 'Booking details not found !'),self::HTTP_OK);exit;
        }
        $signle = $checkbooking->row();
        
        if($signle->book_status == 2){
            $this->api_return(array('status' =>false,'error' => 'You cannot cancel this booking This booking is already completed !'),self::HTTP_OK);exit;
        }
        /*========================status manipulation =====================*/
        $olstatus = !empty($signle->book_status_history) ? json_decode($signle->book_status_history) : array();
        $status['remark']         = $post->book_cancel_resion;
        $status['date']           = date('Y-m-d H:i:s');
        $status['status']         = '3';
        $status['display_status'] = 'Booking is canceled !';
        array_push($olstatus,$status);
        /*========================status manipulation =====================*/
        
        $data['book_status_history'] = json_encode($olstatus);
        $data['book_cancel_by']      = $post->book_cancel_by;
        $data['book_status']         = '3';
            
        /*=========================fcm Notification =======================*/
        $bookingdetails = $this->BookingModel->_single_booking_details($book_id);
        $name     = $bookingdetails->customer_fullname;
        $bokingid = $bookingdetails->book_booking_id;
        
        if($post->book_cancel_by == 2){ // for send owner 
            $token    = $bookingdetails->owner_device_token;
            $template = $this->BaseModel->get_notification_template_by_slug("cancel_booking_for_owner");
            $variables['#customer_name']          = $name;
            $variables['#booking_id']             = $bokingid;
			$smsconte              = str_replace(array_keys($variables), array_values($variables), $template['content']);
        }else{  // for send customer 
            $token    = $bookingdetails->customer_device_token;
            $template = $this->BaseModel->get_notification_template_by_slug("cancel_booking_for_user");
            $variables['#customer_name']          = $name;
            $variables['#booking_id']             = $bokingid;
			$smsconte              = str_replace(array_keys($variables), array_values($variables), $template['content']);
        }
        $this->send_push_notification(array($token),$template['regarding'],$smsconte,$template['image']);
        /*=========================fcm Notification =======================*/
        
        /*=========================Refund your amount======================*/
        $this->PaymentModel->_return_booking_amount_or_coins($bokingid,$bookingdetails->book_customer_id);
        /*=========================Refund your amount======================*/
        
        if($this->BaseModel->_update_query('park_booking',$data,array('book_id'=>$book_id))){
            $this->api_return(array('status' =>true,'error' => 'Booking has been successfully cancelled !'),self::HTTP_OK);exit;
        }
        $this->api_return(array('status' =>false,'error' => 'Oops! Something went wrong ! Help us improve your experience by sending an error report  !'),self::HTTP_OK);exit;
    }
    
    public function complete(){
        $this->_apiConfig([
            'methods' => ['POST'],
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->book_id) || !is_numeric($post->book_id) || !isset($post->book_id)){
            $this->api_return(array('status' =>false,'error' => 'Booking ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        $book_id = $post->book_id;
        $checkbooking = $this->BaseModel->_single_data_query(array('book_id'=>$book_id),'park_booking','*');
        
        if($checkbooking->num_rows() <= 0){
            $this->api_return(array('status' =>false,'error' => 'Booking details not found !'),self::HTTP_OK);exit;
        }
        $signle = $checkbooking->row();
        if($signle->book_status == 3){
            $this->api_return(array('status' =>false,'error' => 'You can not complete this booking This booking is already cancelled !'),self::HTTP_OK);exit;
        }
    }
}