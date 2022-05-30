<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'libraries/api-libraries/API_Controller.php'; // for load

class Parking extends API_Controller {

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
        if(empty($post->parking_name) || !isset($post->parking_name)){
            $this->api_return(array('status' =>false,'error' => 'Parking name is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->parking_description) || !isset($post->parking_description)){
            $this->api_return(array('status' =>false,'error' => 'Parking description is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->parking_address) || !isset($post->parking_address)){
            $this->api_return(array('status' =>false,'error' => 'Parking address is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(!empty($post->parking_address2) && isset($post->parking_address2)){
            $data['parking_address2'] = $post->parking_address2;
        }
        if(empty($post->parking_city) || !isset($post->parking_city)){
            $this->api_return(array('status' =>false,'error' => 'Parking City is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->parking_price) || !isset($post->parking_price) || !is_array($post->parking_price)){
            $this->api_return(array('status' =>false,'error' => 'Parking price is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->parking_flat_no) || !isset($post->parking_flat_no)){
            $this->api_return(array('status' =>false,'error' => 'Parking Flat No. is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->parking_landmark) || !isset($post->parking_landmark)){
            $this->api_return(array('status' =>false,'error' => 'Parking landmark is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->parking_facilities) || !isset($post->parking_facilities) || !is_array($post->parking_facilities)){
            $this->api_return(array('status' =>false,'error' => 'Parking facilities is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->parking_image) || !isset($post->parking_image) || !is_array($post->parking_image)){
            $this->api_return(array('status' =>false,'error' => 'Parking Images is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->parking_latitude) || !isset($post->parking_latitude)){
            $this->api_return(array('status' =>false,'error' => 'Parking latitude is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->parking_longitude) || !isset($post->parking_longitude)){
            $this->api_return(array('status' =>false,'error' => 'Parking longitude is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->parking_zipcode) || !isset($post->parking_zipcode)){
            $this->api_return(array('status' =>false,'error' => 'Parking Zipcode is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->parking_start_time) || !isset($post->parking_start_time)){
            $this->api_return(array('status' =>false,'error' => 'Parking Start time is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->parking_close_time) || !isset($post->parking_close_time)){
            $this->api_return(array('status' =>false,'error' => 'Parking Close time is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        if(!empty($post->parking_image)){
            $images = array();
            foreach($post->parking_image as $key => $value){
                $path = 'uploads/parking_space/';
                $file = $this->BaseModel->_upload_Base64_image($value->image,$path);
                $post->parking_image[$key]->image = $path.$file;
            }
            $images = $post->parking_image;
            unset($post->parking_image);
            $data['parking_image']      = json_encode($images);
        }
        
        
        $data['parking_price']      = json_encode($post->parking_price);
        $data['customer_id']        = $post->customer_id;
        $data['parking_name']       = $post->parking_name;
        $data['parking_description']= $post->parking_description;
        $data['parking_address']    = $post->parking_address;
        $data['parking_city']       = $post->parking_city;
        $data['parking_flat_no']    = $post->parking_flat_no;
        $data['parking_landmark']   = $post->parking_landmark;
        $data['parking_latitude']   = $post->parking_latitude;
        $data['parking_longitude']  = $post->parking_longitude;
        $data['parking_space_available']  = $post->parking_space_available;
        $data['parking_zipcode']    = $post->parking_zipcode;
        $data['parking_create_at']  = date('Y-m-d H:i:s');
        $data['parking_time_in']    = date('H:i',strtotime($post->parking_start_time));
        $data['parking_time_out']   = date('H:i',strtotime($post->parking_close_time));
        $data['parking_facilities'] = json_encode($post->parking_facilities);
        
        $result       = $this->BaseModel->_run_query("select * from park_space order by parking_id desc limit 1")->row();
        $parkingid    = $this->data['config']['park_pre_fix'].sprintf("%05d",@$result->parking_id);
        $data['parking_number'] = $parkingid;
        if($id = $this->BaseModel->_inser_query('park_space',$data)){
            $parkingcount = $this->BaseModel->_single_data_query(array('customer_id'=>$customer_id),'park_space','*')->num_rows();
            if(!empty($this->data['config']['register_parking_cashback']) && $this->data['config']['register_parking_cashback'] > 0 && $parkingcount <=0 ){
                $amounts = $this->data['config']['register_parking_cashback'];
                $descriotion = "You receive ".$amounts ." for add first parking !";
                $this->WalletsModel->_use_wallet($post->customer_id ,"PARKING".$id, $amounts,$descriotion,'1');
            }
            /*for parking parking_price data manipulation and save */
            $amtdata = array();
            foreach($post->parking_price as $key => $value){
                $amdata['sp_vehicle_id']    = $value->vehicle_id;
                $amdata['sp_parking_price'] = $value->vehicle_parking_amount;
                $amdata['sp_create_at']     = date('Y-m-d H:i:s');
                $amdata['sp_space_id']      = $id;
                array_push($amtdata,$amdata);
            }
            $this->db->insert_batch('park_space_price',$amtdata);
            
            /*for parking facilities data manipulation and save */
            $facilitiesarray = array();
            foreach($post->parking_facilities as $key => $value){
                $facilities['facilities_type_id']         = $value->facilities_id;
                $facilities['facilities_create_at']  = date('Y-m-d H:i:s');
                $facilities['facilities_parking_id'] = $id;
                
                array_push($facilitiesarray,$facilities);
            }
            $this->db->insert_batch('park_space_facilities',$facilitiesarray);
            
            $this->api_return(array('status' =>true,'error' => 'Parking successfully added !'),self::HTTP_OK);exit;
        }else{
            $this->api_return(array('status' =>false,'error' => 'Oops! Something went wrong ! Help us improve your experience by sending an error report  !'),self::HTTP_OK);exit;
        }
    }
    
    public function list(){
        $this->_apiConfig([
            'methods' => ['POST'],
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->customer_id) || !isset($post->customer_id)){
            $this->api_return(array('status' =>false,'error' => 'Customer ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        $customer_id = $post->customer_id;
        $result = $this->BaseModel->_run_query("select * from park_space where customer_id='".$customer_id."' order by parking_id desc");
        if($result->num_rows() > 0){
            
            foreach($result->result() as $key => $data){
                $images = !empty($data->parking_image) ? json_decode($data->parking_image) : array();
                foreach($images as $keys => $img){
                  $images[$keys]->image = base_url($img->image);
                }
                $result->result()[$key]->parking_image = $images;
                $result->result()[$key]->parking_single_image = @$images[0]->image;
                $result->result()[$key]->parking_price = $this->BaseModel->_run_query("select park_vehicle_type.vehicle_name,sp_id,sp_vehicle_id,sp_parking_price from park_space_price left join park_vehicle_type on park_vehicle_type.vehicle_id =park_space_price.sp_vehicle_id where sp_space_id='".$data->parking_id."'")->result();
                
                $result->result()[$key]->parking_facilities = $this->BaseModel->_run_query("select park_space_facilities.facilities_id,facilities_name from park_space_facilities left join park_parking_facilities on park_parking_facilities.facilities_id = park_space_facilities.facilities_type_id where facilities_parking_id='".$data->parking_id."'")->result();
            }
            
            $this->api_return(array('status' =>true,'error' => 'Data found !','data'=>$result->result()),self::HTTP_OK);exit;
        }else{
            $this->api_return(array('status' =>true,'error' => 'Data not found!'),self::HTTP_OK);exit;
        }
    }
    
    public function details($parking_id = null){
        if(empty($parking_id) || !is_numeric($parking_id)){
            $this->api_return(array('status' =>true,'error' => 'Parking ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        //parking_id 
        $result = $this->BaseModel->_run_query("select * from park_space where parking_id='".$parking_id."'  limit 1");
        if($result->num_rows() > 0){
            foreach($result->result() as $key => $data){
                
                $images = !empty($data->parking_image) ? json_decode($data->parking_image) : array();
                foreach($images as $keys => $img){
                  $images[$keys]->image = base_url($img->image);
                }
                
                $result->result()[$key]->parking_image = $images;
                $result->result()[$key]->parking_price = $this->BaseModel->_run_query("select park_vehicle_type.vehicle_name,sp_id,sp_vehicle_id,sp_parking_price from park_space_price left join park_vehicle_type on park_vehicle_type.vehicle_id =park_space_price.sp_vehicle_id where sp_space_id='".$data->parking_id."'")->result();
                $result->result()[$key]->parking_shere_url = base_url('api/v1/parking/details/'.$data->parking_id);
        /*============================= F ===============================*/
        $result->result()[$key]->parking_facilities = $this->BaseModel->_run_query("select park_space_facilities.facilities_id,park_parking_facilities.facilities_name from park_space_facilities left join park_parking_facilities on park_parking_facilities.facilities_id = park_space_facilities.facilities_type_id where park_space_facilities.facilities_parking_id='".$data->parking_id."'")->result();
        /*============================= F ===============================*/
            }
            $this->api_return(array('status' =>true,'error' => 'Data found !','data'=>$result->row()),self::HTTP_OK);exit;
        }else{
            $this->api_return(array('status' =>true,'error' => 'Data not found!'),self::HTTP_OK);exit;
        }
    }
    
    public function updateimage(){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->parking_id) || !isset($post->parking_id)){
            $this->api_return(array('status' =>false,'error' => 'Parking ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        if(!isset($post->image_position)){
            $this->api_return(array('status' =>false,'error' => 'Parking Image Position is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        if(empty($post->image_data ) || !isset($post->image_data)){
            $this->api_return(array('status' =>false,'error' => 'Parking Image is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        $parking_id = $post->parking_id;
        $position = $post->image_position;
        
        $result = $this->BaseModel->_run_query("select parking_image from park_space where parking_id='".$parking_id."'");
        
        if($result->num_rows() <= 0 ){
            $this->api_return(array('status' =>false,'error' => 'Oops! Something went wrong ! Help us improve your experience by sending an error report  !'),self::HTTP_OK);exit;
        }
        $signle    = $result->row(); 
        
        if(empty($signle->parking_image) || $signle->parking_image == null){
            $path = 'uploads/parking_space/';
            $file = $this->BaseModel->_upload_Base64_image($post->image_data,$path);
            $oldimages = array(array('image'=>$path.$file));
        }else{
            //if images already exist or records
           $signle    = $result->row(); 
           $oldimages = !empty($signle->parking_image) ? json_decode($signle->parking_image):array();
           $signleimage = @$oldimages[$position]->image;
           
           $path = 'uploads/parking_space/';
           $file = $this->BaseModel->_upload_Base64_image($post->image_data,$path);
            
           if(!empty(@$signleimage)){
               @unlink($signleimage);
           }
           
           foreach($oldimages as $key => $img){
               if($key == $position){
                   @$oldimages[$key]->image = $path.$file;
               }else{
                   @$oldimages[$key]->image = @$img->image;
               }
           }
        }
        
        if($this->BaseModel->_update_query('park_space',array('parking_image'=>json_encode($oldimages)),array('parking_id'=>$parking_id))){
            $this->api_return(array('status' =>true,'error' => 'Images successfully updated !'),self::HTTP_OK);exit;
        }else{
            $this->api_return(array('status' =>false,'error' => 'Oops! Something went wrong ! Help us improve your experience by sending an error report  !'),self::HTTP_OK);exit;
        }
    }
    
    public function addmoreimage(){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->parking_id) || !isset($post->parking_id)){
            $this->api_return(array('status' =>false,'error' => 'Parking ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->image_data ) || !isset($post->image_data)){
            $this->api_return(array('status' =>false,'error' => 'Parking Image is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        $parking_id = $post->parking_id;
        $result = $this->BaseModel->_run_query("select parking_image from park_space where parking_id='".$parking_id."'");
        if($result->num_rows() <= 0 ){
            $this->api_return(array('status' =>false,'error' => 'Oops! Something went wrong ! Help us improve your experience by sending an error report  !'),self::HTTP_OK);exit;
        }
        
        $signle    = $result->row();
        if(empty($signle->parking_image) || $signle->parking_image == null){
            $path = 'uploads/parking_space/';
            $file = $this->BaseModel->_upload_Base64_image($post->image_data,$path);
            $oldimages = array(array('image'=>$path.$file));
        }else{
           $path = 'uploads/parking_space/';
           $file = $this->BaseModel->_upload_Base64_image($post->image_data,$path);
           $oldimages = !empty($signle->parking_image) ? json_decode($signle->parking_image):array();
           array_push($oldimages,array('image'=>$path.$file)); 
        }
        
        if($this->BaseModel->_update_query('park_space',array('parking_image'=>json_encode($oldimages)),array('parking_id'=>$parking_id))){
            $this->api_return(array('status' =>true,'error' => 'Images successfully added !'),self::HTTP_OK);exit;
        }else{
            $this->api_return(array('status' =>false,'error' => 'Oops! Something went wrong ! Help us improve your experience by sending an error report  !'),self::HTTP_OK);exit;
        }
    }
    
    public function facilities(){
        $this->_apiConfig([
            'methods' => ['GET'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $result = $this->BaseModel->_run_query("select facilities_id,facilities_name from park_parking_facilities order by facilities_id desc");
        if($result->num_rows() <= 0 ){
            $this->api_return(array('status' =>true,'error' => 'Data Not found !'),self::HTTP_OK);exit;
        }
        $this->api_return(array('status' =>true,'error' => 'Data found !','data'=>$result->result()),self::HTTP_OK);exit;
    }
    
    public function update(){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->parking_id) || !isset($post->parking_id)){
            $this->api_return(array('status' =>false,'error' => 'Parking ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->parking_name) || !isset($post->parking_name)){
            $this->api_return(array('status' =>false,'error' => 'Parking name is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->parking_description) || !isset($post->parking_description)){
            $this->api_return(array('status' =>false,'error' => 'Parking description is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->parking_address) || !isset($post->parking_address)){
            $this->api_return(array('status' =>false,'error' => 'Parking address is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(!empty($post->parking_address2) && isset($post->parking_address2)){
            $data['parking_address2'] = $post->parking_address2;
        }
        if(empty($post->parking_city) || !isset($post->parking_city)){
            $this->api_return(array('status' =>false,'error' => 'Parking City is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->parking_price) || !isset($post->parking_price) || !is_array($post->parking_price)){
            $this->api_return(array('status' =>false,'error' => 'Parking price is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->parking_flat_no) || !isset($post->parking_flat_no)){
            $this->api_return(array('status' =>false,'error' => 'Parking Flat No. is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->parking_landmark) || !isset($post->parking_landmark)){
            $this->api_return(array('status' =>false,'error' => 'Parking landmark is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->parking_facilities) || !isset($post->parking_facilities) || !is_array($post->parking_facilities)){
            $this->api_return(array('status' =>false,'error' => 'Parking facilities is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->parking_latitude) || !isset($post->parking_latitude)){
            $this->api_return(array('status' =>false,'error' => 'Parking latitude is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->parking_longitude) || !isset($post->parking_longitude)){
            $this->api_return(array('status' =>false,'error' => 'Parking longitude is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->parking_zipcode) || !isset($post->parking_zipcode)){
            $this->api_return(array('status' =>false,'error' => 'Parking Zipcode is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        $parking_id = $post->parking_id;
        $data['parking_price']      = json_encode($post->parking_price);
        $data['customer_id']        = $post->customer_id;
        $data['customer_id']        = $post->customer_id;
        $data['parking_name']       = $post->parking_name;
        $data['parking_description']= $post->parking_description;
        $data['parking_address']    = $post->parking_address;
        $data['parking_city']       = $post->parking_city;
        $data['parking_flat_no']    = $post->parking_flat_no;
        $data['parking_landmark']   = $post->parking_landmark;
        $data['parking_latitude']   = $post->parking_latitude;
        $data['parking_longitude']  = $post->parking_longitude;
        $data['parking_zipcode']    = $post->parking_zipcode;
        $data['parking_create_at']  = date('Y-m-d H:i:s');
        $data['parking_status']     = '0';
        
        if($this->BaseModel->_update_query('park_space',$data,array('parking_id'=>$parking_id))){
            /*for parking parking_price data manipulation and save */
            $amtdata = array();
            foreach($post->parking_price as $key => $value){
                $amdata['sp_vehicle_id']    = $value->vehicle_id;
                $amdata['sp_parking_price'] = $value->vehicle_parking_amount;
                $amdata['sp_update_at']     = date('Y-m-d H:i:s');
                $amdata['sp_space_id']      = $parking_id;
                $this->BaseModel->_update_query('park_space_price',$amdata,array('sp_id'=>$value->sp_id));
            }
            
            /*for parking facilities data manipulation and save */
            $facilitiesarray = array();
            foreach($post->parking_facilities as $key => $value){
                $facilities['facilities_type_id']         = $value->facilities_id;
                $facilities['facilities_update_at']  = date('Y-m-d H:i:s');
                $facilities['facilities_parking_id'] = $parking_id;
                $this->BaseModel->_update_query('park_space_facilities',$facilities,array('facilities_id'=>$value->old_facilities_id));
            }
            
            $this->api_return(array('status' =>true,'error' => 'Parking successfully updated !'),self::HTTP_OK);exit;
        }else{
            $this->api_return(array('status' =>false,'error' => 'Oops! Something went wrong ! Help us improve your experience by sending an error report  !'),self::HTTP_OK);exit;
        }
    }
    
    public function search(){
        $this->_apiConfig([
            'methods' => ['POST'],
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->parking_latitude) || !isset($post->parking_latitude)){
            $this->api_return(array('status' =>false,'error' => 'Parking latitude is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->parking_longitude) || !isset($post->parking_longitude)){
            $this->api_return(array('status' =>false,'error' => 'Parking longitude is empty Or missing !'),self::HTTP_OK);exit;
        }
        $parking_radius = 1;//km 
        if(!empty($post->parking_radius) && isset($post->parking_radius)){
            $parking_radius = $post->parking_radius;
        }
        
        $parking_lat = $post->parking_latitude;
        $parking_lan = $post->parking_longitude;
        $findfarking = $this->ParkingModel->_find_parking_by_lat_lan($parking_lat,$parking_lan,$parking_radius);
        $is_find     = 0;
        
        if($findfarking->num_rows() <= 0){
           $this->api_return(array('status' =>true,'true' => 'Parking Not Found !','is_find'=>$is_find,'data'=>$findfarking->result()),self::HTTP_OK);exit;
        }
        
        foreach($findfarking->result() as $key => $data){
            $images = !empty($data->parking_image) ? json_decode($data->parking_image) : array();
            foreach($images as $keys => $img){
              $images[$keys]->image = base_url($img->image);
            }
            
            $findfarking->result()[$key]->parking_image      = $images;
            $findfarking->result()[$key]->parking_facilities = $this->BaseModel->_run_query("select park_space_facilities.facilities_id,park_parking_facilities.facilities_name from park_space_facilities left join park_parking_facilities on park_parking_facilities.facilities_id = park_space_facilities.facilities_parking_id where park_space_facilities.facilities_parking_id='".$data->parking_id."'")->result();
            $findfarking->result()[$key]->parking_price      = $this->BaseModel->_run_query("select park_vehicle_type.vehicle_name,sp_id,sp_vehicle_id,sp_parking_price from park_space_price left join park_vehicle_type on park_vehicle_type.vehicle_id =park_space_price.sp_vehicle_id where sp_space_id='".$data->parking_id."'")->result();
            $findfarking->result()[$key]->parking_shere_url  = base_url('api/v1/parking/details/'.$data->parking_id);
        }
        $is_find  = 1;
        $this->api_return(array('status' =>true,'true' => 'Parking found !','is_find'=>$is_find,'data'=>$findfarking->result()),self::HTTP_OK);exit;
    }
    
    public function book(){
        $this->_apiConfig([
            'methods' => ['POST'],
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post  = json_decode(file_get_contents('php://input'));
        
        $today = strtotime(date('Y-m-d H:i'));
        
        if(empty($post->booking_start_date) || !isset($post->booking_start_date)){
            $this->api_return(array('status' =>false,'error' => 'Booking date ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        if(strtotime($post->booking_start_date) < $today){
            $this->api_return(array('status' =>false,'error' => $post->booking_start_date.' Start date is not valid please check Or missing !'),self::HTTP_OK);exit;
        }
        
        if(strtotime($post->booking_stop_date) < $today){
            $this->api_return(array('status' =>false,'error' => $post->booking_stop_date.' End date is not valid please check Or missing !'),self::HTTP_OK);exit;
        }
         
        if(empty($post->parking_id) || !isset($post->parking_id)){
            $this->api_return(array('status' =>false,'error' => 'Parking ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->booking_customer_id) || !isset($post->booking_customer_id)){
            $this->api_return(array('status' =>false,'error' => 'Parking ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->parking_vehicle_type) || !isset($post->parking_vehicle_type) || !is_array($post->parking_vehicle_type)){
            $this->api_return(array('status' =>false,'error' => 'Parking vehicle type is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->booking_payment_mode) || !isset($post->booking_payment_mode)){
            $this->api_return(array('status' =>false,'error' => 'Payment mode is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        if(empty($post->booking_type) || !isset($post->booking_type)){
            $this->api_return(array('status' =>false,'error' => 'Booking type empty Or missing !'),self::HTTP_OK);exit;
        }
        
        $parking_id          = $post->parking_id;
        $booking_customer_id = $post->booking_customer_id;
        $vehicle_type        = $post->parking_vehicle_type;
        $booking_type        = $post->booking_type;
        $bookmincoin         = $post->booking_amount;
        /*===============================check configration of minimumm amount==========================================*/
        $wallet      = $this->WalletsModel->_get_total_wallet_amount($booking_customer_id)->row();
        $totalwallet = $this->_canvert_coin_to_cash($wallet->balence);
        if($bookmincoin > $totalwallet){
            //$this->api_return(array('status' =>false,'error' => 'Minimum allowed wallet balance is exceeded. please recharge your wallet and try again !'),self::HTTP_OK);exit;
        }
        /*===============================check configration of minimumm amount==========================================*/
        
        
        $result = $this->BaseModel->_run_query("select * from park_booking order by book_id desc limit 1")->row();
        $bookingid    = $this->data['config']['book_pre_fix'].sprintf("%05d",@$result->book_id);
        
        $result = $this->BaseModel->_run_query("select parking_name,parking_address,parking_latitude,parking_longitude from park_space where parking_id='".$parking_id."' and parking_status='1' order by parking_id desc");
        
        if($result->num_rows() <= 0){
            $this->api_return(array('status' =>false,'error' => 'Parking details not found !'),self::HTTP_OK);exit;
        }
        $single = $result->row();
        
        $amount = $bookmincoin;
        /*foreach($post->parking_vehicle_type as $key => $value){
            $vehiclewise = $this->BaseModel->_run_query("select * from park_space_price where sp_id='".$value->sp_id."'")->row();
            $amount+= @$vehiclewise->sp_parking_price * $post->booking_slot_minauets;
        }*/
        
        $data['book_parking_id']    = $parking_id;
        $data['book_vehicle_id']    = json_encode($vehicle_type);
        $data['book_customer_id']   = $booking_customer_id;//This is booking person
        $data['book_create_at']     = date('Y-m-d H:i:s');
        $data['book_pay_mode']      = '0';
        $data['book_amount']        = $amount;
        $data['book_parking_type']  = $booking_type;
        $data['book_booking_id']    = $bookingid;
        
        $data['book_discount_amount']= @$post->booking_discount_amount;
        $data['book_coupon_code']    = @$post->booking_coupon_code;
        $data['book_coupon_id']      = @$post->booking_coupon_id;
        
        $data['book_pay_mode']      = $post->booking_payment_mode;
        $data['book_booked_time']   = $post->booking_slot_minauets;
        $data['book_status_history']= json_encode([array('remark'=>'Parking booked !','date'=>date('Y-m-d H:i:s'),'status'=>'0','display_status'=>'Booking is pending !')]);
        
        if($booking_type == 1){
            $data['book_parking_start']  = date('Y-m-d H:i',strtotime($post->booking_start_date));
            $data['book_parking_end']    = date('Y-m-d H:i',strtotime($post->booking_stop_date));
        }else{
            $data['book_parking_start']  = date('Y-m-d H:i',strtotime($post->booking_start_date));
            $data['book_parking_end']    = date('Y-m-d H:i',strtotime($post->booking_stop_date));
        }
        
        if($this->BaseModel->_inser_query('park_booking',$data)){
            /*==========================payment===========================*/
            if($post->booking_payment_mode == 3){
                //use for wallet coins
                $this->PaymentModel->_payment_create($this->_canvert_coin_to_cash($amount),$amount,$bookingid,' Parking booked !');
            }else if($post->booking_payment_mode == 2){
                //use for online
                $this->PaymentModel->_payment_create($amount,$this->_canvert_cash_to_coin($amount),$bookingid,' Parking booked !');
            }
            /*==========================payment===========================*/
            $this->api_return(array('status' =>true,'error' => 'Parking place successfully booked !','bookingid'=>$bookingid),self::HTTP_OK);exit;
        }else{
            $this->api_return(array('status' =>false,'error' => 'Oops! Something went wrong ! Help us improve your experience by sending an error report  !'),self::HTTP_OK);exit;
        }
    }
    
    public function todayslots(){
        $this->_apiConfig([
            'methods' => ['POST'],
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post  = json_decode(file_get_contents('php://input'));
        
        if(empty($post->booking_slot_minutes) || !isset($post->booking_slot_minutes)){
            $this->api_return(array('status' =>false,'error' => 'Slots difference ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->parking_id) || !isset($post->parking_id)){
            $this->api_return(array('status' =>false,'error' => 'Parking ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        
        $parking_id = $post->parking_id;
        $result = $this->BaseModel->_run_query("select parking_no_of_space,parking_time_in,parking_time_out from park_space where parking_id='".$parking_id."' and parking_status='1' order by parking_id desc");
        if($result->num_rows() <= 0){
            $this->api_return(array('status' =>false,'error' => 'Parking details not found !'),self::HTTP_OK);exit;
        }
        
        $intervel = $post->booking_slot_minutes;
        $startdate = date('Y-m-d');
        $stopdates = date('Y-m-d H:i:s',strtotime("+".$intervel." minutes"));
        
        $single   = $result->row();
        
        $parkingstart = date("H:i",strtotime($single->parking_time_in));
        $parkingclose = date("H:i",strtotime($single->parking_time_out));
        
        /*check total slots book*/
        $result = $this->BaseModel->_run_query("select 
                DATE_FORMAT(book_parking_start,'%T') as book_parking_start,
                DATE_FORMAT(book_parking_end,'%T') as book_parking_end 
                from park_booking where book_parking_id='".$parking_id."' 
                and book_checked_out is null and (book_parking_start between '".$startdate."' and '".$stopdates."') or 
                book_parking_id='".$parking_id."' and book_checked_out is null and (book_parking_end between '".$startdate."' and '".$stopdates."') ");
        /* print_r($this->db->last_query());exit;*/
        /*check total slots free for booking*/
        $countbookslots = $result->num_rows();
        $totalspace     = $single->parking_no_of_space;
        $totalfreespace = $totalspace-$countbookslots;
        
        if(strtotime($single->parking_time_in) >= time() ){
           $current  = $parkingstart;
        }else{
           $current  = date('H:i'); 
        }
    
        $slots = $this->get_time_slots($intervel,$current,$parkingclose);
        
        if(empty($slots)){
            $this->api_return(array('status' =>false,'error' => 'Parking slots are not currently available, please check again after !'),self::HTTP_OK);exit;
        }
        
        $slotsarray = array();
        foreach($slots as $key => $value){
            array_push($slotsarray,array('slot_start_time'=>$value['slot_start_time'],'slot_end_time'=>$value['slot_end_time']));
        }
        
        $this->api_return(array('status' =>true,'error' => 'Parking available !','data'=>$slotsarray,'totat_vehicle_space'=>$totalfreespace),self::HTTP_OK);exit;
    }
    
    
    public function parking_lat_log(){
        $this->_apiConfig([
            'methods' => ['GET'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
       $results = $this->BaseModel->_ci_data_query(array('parking_status'=>'1'),'park_space','parking_id,parking_name,parking_latitude,parking_longitude');
       
       
       
       
       
       if($results->num_rows() <= 0 ){
           $this->api_return(array('status' =>false,'message' => 'Data Not Found !'),self::HTTP_OK);exit;
       }
       $this->api_return(array('status' =>true,'message' => 'Data Found !','data'=>$results->result()),self::HTTP_OK);exit;
    }
    
    
    
    public function parkinglist(){
        $this->_apiConfig([
            'methods' => ['GET'],
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        
        $result = $this->BaseModel->_run_query("select * from park_space where parking_status='1' order by parking_id desc");
        if($result->num_rows() > 0){
            
            foreach($result->result() as $key => $data){
                $images = !empty($data->parking_image) ? json_decode($data->parking_image) : array();
                foreach($images as $keys => $img){
                  $images[$keys]->image = base_url($img->image);
                }
                $result->result()[$key]->parking_image = $images;
                $result->result()[$key]->parking_single_image = @$images[0]->image;
                $result->result()[$key]->parking_price = $this->BaseModel->_run_query("select park_vehicle_type.vehicle_name,sp_id,sp_vehicle_id,sp_parking_price from park_space_price left join park_vehicle_type on park_vehicle_type.vehicle_id =park_space_price.sp_vehicle_id where sp_space_id='".$data->parking_id."'")->result();
                
                $result->result()[$key]->parking_facilities = $this->BaseModel->_run_query("select park_space_facilities.facilities_id,facilities_name from park_space_facilities left join park_parking_facilities on park_parking_facilities.facilities_id = park_space_facilities.facilities_type_id where facilities_parking_id='".$data->parking_id."'")->result();
            }
            
            $this->api_return(array('status' =>true,'error' => 'Data found !','data'=>$result->result()),self::HTTP_OK);exit;
        }else{
            $this->api_return(array('status' =>true,'error' => 'Data not found!'),self::HTTP_OK);exit;
        }
    }
    
    public function timinglist(){
        $this->_apiConfig([
            'methods' => ['GET'],
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        
        $data = array(
            array('time_key'=>'15','time_value'=>'15 Minutes'),
            array('time_key'=>'30','time_value'=>'30 Minutes'),
            array('time_key'=>'60','time_value'=>'1 Hour')
            );
        $this->api_return(array('status' =>true,'error' => 'Timing data found!','data'=>$data),self::HTTP_OK);exit;
    }
}

