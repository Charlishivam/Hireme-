<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'libraries/api-libraries/API_Controller.php'; // for load

class Vehicletransfer extends API_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->data['vehicletransfer'] = 'uploads/customer_vehicle_transfer/';
        $this->data['config']['book_pre_fix']  = "PMV";
        
        
       
    }

    public function create(){
        $this->_apiConfig([
            'methods' => ['POST'],
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->tran_customer_id) || !isset($post->tran_customer_id)){
            $this->api_return(array('status' =>false,'error' => 'Customer ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        
        if(empty($post->tran_vehicle_id) || !isset($post->tran_vehicle_id)){
            $this->api_return(array('status' =>false,'error' => 'Transfer Vehicle ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        
        if(empty($post->tran_new_customer_id) || !isset($post->tran_new_customer_id)){
            $this->api_return(array('status' =>false,'error' => 'New Customer is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        
        if(empty($post->tran_mobile_number) || !isset($post->tran_mobile_number)){
            $this->api_return(array('status' =>false,'error' => 'New Customer Mobile Number is empty Or missing !'),self::HTTP_OK);exit;
        }
     
        $tran_new_customer_id  = $post->tran_new_customer_id;
        $tran_customer_id  = $post->tran_customer_id;
        $tran_vehicle_id = $post->tran_vehicle_id;
        $tran_mobile_number = $post->tran_mobile_number;
      
        
        $checknewcustomer = $this->BaseModel->_single_data_query(array('customer_id'=>$tran_new_customer_id),'park_customer','*');
        if($checknewcustomer->num_rows() > 0){
            $this->api_return(array('status' =>false,'error' => 'This Customer is not exits !'),self::HTTP_OK);exit;
        }
        /*====================check vehicle end=========================*/
        if(!empty($post->tran_customer_id) && isset($post->tran_customer_id)){
            $data['tran_customer_id'] = $post->$tran_customer_id;
        }
        if(!empty($post->tran_vehicle_id) && isset($post->tran_vehicle_id)){
            $data['tran_vehicle_id'] = $post->$tran_vehicle_id;
        }
        if(!empty($post->tran_new_customer_id) && isset($post->tran_new_customer_id)){
            $data['tran_new_customer_id'] = $post->tran_new_customer_id;
        }
        
        
        if(!empty($post->tran_mobile_number) && isset($post->tran_mobile_number)){
            $data['tran_mobile_number'] = $post->tran_mobile_number;
        }
        
        $data['tran_date']               = date('Y-m-d', strtotime($post->tran_date));
        $data['tran_create_at']          = date('Y-m-d h:i:s');
        
        
        if(!empty($post->tran_proof_id) && isset($post->tran_proof_id)){
            $path = $this->data['vehicletransfer'];
            $file_0 = $this->BaseModel->_upload_Base64_image($post->tran_proof_id,$path);
            $data['tran_proof_id']      = $path.$file_0;
        }
      
        
      
        
        /*============================otp ===========================*/
        $is_sent_otp = 0;
        $otp_text    = '';
        if($post->tran_mobile_number){
            $is_sent_otp = 0;
            $otp_text    = rand(111111,999999);
            $ownermobile = @$post->tran_mobile_number;
            $data['trans_customer_otp']             = $otp_text;
            $data['trans_customer_otp_verified '] = '0';
            $template_customer = $this->BaseModel->get_template_by_slug("otp");
            if(!empty($template_customer)){
                $variables['#OTP']          =  $otp_text;
				$variables['#message_key']  =  'Testing Purpose';
				$smsconte              = str_replace(array_keys($variables), array_values($variables), $template_customer['content']);
				$this->_send_sms($ownermobile,$smsconte,$template_customer['template_id']);
            }
        }
        /*============================otp ===========================*/
        $lastparkid = $this->BaseModel->_inser_query('park_vehicle_transfer',$data); 
       
        if(!empty($lastparkid)){
            $this->api_return(array('status' =>true,'error' => 'Your vehicle has been transferred successfully !','is_sent_otp'=>$is_sent_otp,'otp_text'=>$otp_text,'transfer_id'=>$lastparkid),self::HTTP_OK);exit;
        }
        $this->api_return(array('status' =>false,'error' => 'Some have server error in vehicle transferred !'),self::HTTP_OK);exit;
    }
    
    
    public function check_owner_otp(){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->veh_id) || !isset($post->veh_id)){
            $this->api_return(array('status' =>false,'error' => 'Vehicle ID is empty Or missing !'),self::HTTP_OK);exit;
        } 
        if(empty($post->otp_text) || !isset($post->otp_text)){
            $this->api_return(array('status' =>false,'error' => 'OTP is empty Or missing !'),self::HTTP_OK);exit;
        } 
        
        $veh_id     = $post->veh_id;
        $otp        = (int)$post->otp_text;
        
        $checkopt = $this->BaseModel->_ci_data_query(array('veh_id'=>$veh_id),'park_vehicle','*');
        
        if($checkopt->num_rows() <= 0){
            $this->api_return(array('status' =>false,'error' => 'Vehicle data not found !'),self::HTTP_OK);exit;
        }
        
        $single = $checkopt->row();
        if($single->veh_otp == $otp && strlen($otp) == 6){
            $data['veh_otp_is_verified']         = '1';
            $this->BaseModel->_update_query('park_vehicle',$data,array('veh_id'=>$veh_id));
            
            $this->api_return(array('status' =>true,'error' => 'Your one time password successfully match  !'),self::HTTP_OK);exit;
        }else{
            $this->api_return(array('status' =>false,'error' => 'You Enter wrong OTP !'),self::HTTP_OK);exit;
        }
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
        $customer_id  = $post->customer_id;
        $result = $this->BaseModel->_run_query("select * from park_vehicle where veh_customer_id='".$customer_id."'");
        if($result->num_rows() <= 0 ){
            $this->api_return(array('status' =>true,'error' => 'Data not found !'),self::HTTP_OK);exit;
        }
        
        foreach($result->result() as $key => $data){
            $vehicals = !empty($data->veh_image) ? json_decode($data->veh_image) : array(); 
            
            foreach($vehicals as $keys => $val){
                $vehicals[$keys]->url = base_url($val->url);
            }
            $result->result()[$key]->veh_single_image = $vehicals[0]->url;
            $result->result()[$key]->veh_image = $vehicals;
        }
        $this->api_return(array('status' =>true,'error' => 'Data found !','data'=>$result->result()),self::HTTP_OK);exit;
    }
    
    public function details($veh_id = null){
       $this->_apiConfig([
            'methods' => ['GET'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($veh_id) || !is_numeric($veh_id)){
            $this->api_return(array('status' =>false,'error' => 'Vehicle List ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        $result = $this->BaseModel->_run_query("select * from park_vehicle where veh_id='".$veh_id."'");
        
        if($result->num_rows() <= 0 ){
            $this->api_return(array('status' =>true,'error' => 'Data not found !'),self::HTTP_OK);exit;
        }
        $result->row()->document = $this->BaseModel->_run_query("select doc_id,doc_name,doc_number,concat('".base_url()."',doc_image) as doc_image from park_documents where doc_status='1' and doc_vehicle_id='".$veh_id."' group by doc_number order by doc_id")->result();
        
        $vehicals = !empty($result->row()->veh_image) ? json_decode($result->row()->veh_image) : array(); 
        foreach($vehicals as $key => $val){
            $vehicals[$key]->url = base_url($val->url);
        }
        $result->row()->veh_image = $vehicals; 
        $result->row()->veh_shere = base_url('api/v1/vehicle/details/'.$result->row()->veh_id);
        
        $this->api_return(array('status' =>true,'error' => 'Data found !','data'=>$result->row()),self::HTTP_OK);exit;
    }
    
    public function type(){
        $this->_apiConfig([
            'methods' => ['GET'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $result = $this->BaseModel->_run_query("select vehicle_id,vehicle_name,concat('".base_url('uploads/vehicle/')."',vehicle_image) as vehicle_image from park_vehicle_type");
        if($result->num_rows() <= 0 ){
            $this->api_return(array('status' =>true,'error' => 'Data Not found !'),self::HTTP_OK);exit;
        }
        $this->api_return(array('status' =>true,'error' => 'Data found !','data'=>$result->result()),self::HTTP_OK);exit;
    }
    
    public function updateimage(){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->veh_id) || !isset($post->veh_id)){
            $this->api_return(array('status' =>false,'error' => 'Parking ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        if(!isset($post->image_position)){
            $this->api_return(array('status' =>false,'error' => 'Parking Image Position is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        if(empty($post->image_data ) || !isset($post->image_data)){
            $this->api_return(array('status' =>false,'error' => 'Parking Image is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        $veh_id   = $post->veh_id;
        $position = $post->image_position;
        
        $result = $this->BaseModel->_run_query("select * from park_vehicle where veh_id='".$veh_id."'");
        
        if($result->num_rows() <= 0 ){
            $this->api_return(array('status' =>false,'error' => 'Oops! Something went wrong ! Help us improve your experience by sending an error report  !'),self::HTTP_OK);exit;
        }
        $signle    = $result->row(); 
        
        if(empty($signle->veh_image) || $signle->veh_image == null){
            $path = $this->data['parkingdoc'];
            $file = $this->BaseModel->_upload_Base64_image($post->image_data,$path);
            $oldimages = array(array('url'=>$path.$file));
        }else{
            //if images already exist or records
           $signle    = $result->row(); 
           $oldimages = !empty($signle->veh_image) ? json_decode($signle->veh_image):array();
           $signleimage = @$oldimages[$position]->url;
           
           $path = $this->data['parkingdoc'];
           $file = $this->BaseModel->_upload_Base64_image($post->image_data,$path);
            
           if(!empty(@$signleimage)){
               @unlink($signleimage);
           }
           
           foreach($oldimages as $key => $img){
               if($key == $position){
                   @$oldimages[$key]->url = $path.$file;
               }else{
                   @$oldimages[$key]->url = @$img->url;
               }
           }
        }
        
        if($this->BaseModel->_update_query('park_vehicle',array('veh_image'=>json_encode($oldimages)),array('veh_id'=>$veh_id))){
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
        if(empty($post->veh_id) || !isset($post->veh_id)){
            $this->api_return(array('status' =>false,'error' => 'Parking ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->image_data ) || !isset($post->image_data)){
            $this->api_return(array('status' =>false,'error' => 'Parking Image is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        $veh_id = $post->veh_id;
        $result = $this->BaseModel->_run_query("select * from park_vehicle where veh_id='".$veh_id."'");
        if($result->num_rows() <= 0 ){
            $this->api_return(array('status' =>false,'error' => 'Oops! Something went wrong ! Help us improve your experience by sending an error report  !'),self::HTTP_OK);exit;
        }
        
        $signle    = $result->row();
        if(empty($signle->veh_image) || $signle->veh_image == null){
            $path = $this->data['parkingdoc'];
            $file = $this->BaseModel->_upload_Base64_image($post->image_data,$path);
            $oldimages = array(array('url'=>$path.$file));
        }else{
           $path = $this->data['parkingdoc'];
           $file = $this->BaseModel->_upload_Base64_image($post->image_data,$path);
           $oldimages = !empty($signle->parking_image) ? json_decode($signle->parking_image):array();
           array_push($oldimages,array('url'=>$path.$file)); 
        }
        
        if($this->BaseModel->_update_query('park_vehicle',array('veh_image'=>json_encode($oldimages)),array('veh_id'=>$veh_id))){
            $this->api_return(array('status' =>true,'error' => 'Images successfully added !'),self::HTTP_OK);exit;
        }else{
            $this->api_return(array('status' =>false,'error' => 'Oops! Something went wrong ! Help us improve your experience by sending an error report  !'),self::HTTP_OK);exit;
        }
    }
    
    public function update(){
        $this->_apiConfig([
            'methods' => ['POST'],
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->veh_id) || !isset($post->veh_id)){
            $this->api_return(array('status' =>false,'error' => 'Vehicle ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        if(empty($post->vehicle_owener_type) || !isset($post->vehicle_owener_type)){
            $this->api_return(array('status' =>false,'error' => 'Owener type is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        if(empty($post->vehicle_name) || !isset($post->vehicle_name)){
            $this->api_return(array('status' =>false,'error' => 'Vehicle Name is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->vehicle_model) || !isset($post->vehicle_model)){
            $this->api_return(array('status' =>false,'error' => 'Vehicle Model  is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->vehicle_brand) || !isset($post->vehicle_brand)){
            $this->api_return(array('status' =>false,'error' => 'Vehicle Brand is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        if(empty($post->vehicle_description) || !isset($post->vehicle_description)){
            $this->api_return(array('status' =>false,'error' => 'Vehicle Description is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        if(empty($post->vehicle_year) || !isset($post->vehicle_year)){
            $this->api_return(array('status' =>false,'error' => 'Year is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->vehicle_fuel_type) || !isset($post->vehicle_fuel_type)){
            $this->api_return(array('status' =>false,'error' => 'Fuel type is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        if(empty($post->vehicle_driven) || !isset($post->vehicle_driven)){
            $this->api_return(array('status' =>false,'error' => 'KM. Driven type is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        
        $customer_id  = $post->customer_id;
    
        if(!empty($post->vehicle_owner_name) && isset($post->vehicle_owner_name)){
            $data['veh_owner_name'] = $post->vehicle_owner_name;
        }
        if(!empty($post->vehicle_owner_mobile) && isset($post->vehicle_owner_mobile)){
            $data['veh_owner_register_number'] = $post->vehicle_owner_mobile;
        }
        
        $data['veh_name']           = $post->vehicle_name;
        $data['veh_relation']       = $post->vehicle_owener_type;
        $data['veh_model_name']     = $post->vehicle_model;
        $data['veh_make_model_year']= $post->vehicle_year;
        $data['veh_update_at']      = date('Y-m-d h:i:s');
        $data['veh_brand']          = $post->vehicle_brand;
        $data['veh_description']    = $post->vehicle_description;
        $data['veh_fuel_type']      = $post->vehicle_fuel_type;
        $data['veh_driven']         = $post->vehicle_driven;
        
        if($this->BaseModel->_update_query('park_vehicle',$data,array('veh_id'=>$veh_id))){
            $this->api_return(array('status' =>true,'error' => 'Registered Vehicle updated !'),self::HTTP_OK);exit;
        }
        $this->api_return(array('status' =>false,'error' => 'Some have server error in vehicle registered !'),self::HTTP_OK);exit;
    }
    
    /*
    |update document one by one
    |update doc and replace old document 
    */
    public function updatedoc(){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->doc_id) || !isset($post->doc_id)){
            $this->api_return(array('status' =>false,'error' => 'Document ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->doc_image) || !isset($post->doc_image)){
            $this->api_return(array('status' =>false,'error' => 'Document Image is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->doc_name) || !isset($post->doc_name)){
            $this->api_return(array('status' =>false,'error' => 'Document Name is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->doc_number) || !isset($post->doc_number)){
            $this->api_return(array('status' =>false,'error' => 'Document number is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->doc_expiry) || !isset($post->doc_expiry)){
            $this->api_return(array('status' =>false,'error' => 'Document Expiry is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        $doc_id = $post->doc_id;
        $path = $this->data['parkingdoc'];
        $file = $this->BaseModel->_upload_Base64_image($post->doc_image,$path);
        
        $data['doc_update_at'] = date('Y-m-d H:i:s');
        $data['doc_name']      = $post->doc_name;
        $data['doc_image']     = $path.$file;
        $data['doc_number']    = $post->doc_number; 
        $data['doc_update_at'] = date('Y-m-d H:i:s');
        $data['doc_expirydate']= date('Y-m-d',strtodate($post->doc_expiry));
        $data['doc_status']    = '0';
        
        if($this->BaseModel->_update_query('park_documents',$data,array('doc_id'=>$doc_id))){
            $this->api_return(array('status' =>true,'error' => 'Document updated !'),self::HTTP_OK);exit;
        }
        $this->api_return(array('status' =>false,'error' => 'Oops! Something went wrong ! Help us improve your experience by sending an error report  !'),self::HTTP_OK);exit;
    }
    
    /*
    |add more document one by one
    |add more document 
    */
    public function addmoredoc(){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->veh_id) || !isset($post->veh_id)){
            $this->api_return(array('status' =>false,'error' => 'Vehicle ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->doc_image) || !isset($post->doc_image)){
            $this->api_return(array('status' =>false,'error' => 'Document Image is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->doc_name) || !isset($post->doc_name)){
            $this->api_return(array('status' =>false,'error' => 'Document Name is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->doc_number) || !isset($post->doc_number)){
            $this->api_return(array('status' =>false,'error' => 'Document number is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->doc_expiry) || !isset($post->doc_expiry)){
            $this->api_return(array('status' =>false,'error' => 'Document Expiry is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        $veh_id = $post->veh_id;
        $result = $this->BaseModel->_run_query("select * from park_documents where doc_vehicle_id='".$veh_id."' and doc_number='".$post->doc_number."'");
        
        if($result->num_rows() > 0){
            $this->api_return(array('status' =>false,'error' => 'This Document Already exists !'),self::HTTP_OK);exit;
        }
        
        $path = $this->data['parkingdoc'];
        $file = $this->BaseModel->_upload_Base64_image($post->doc_image,$path);
        
        $data['doc_name']      = $post->doc_name;
        $data['doc_image']     = $path.$file;
        $data['doc_number']    = $post->doc_number; 
        $data['doc_create_at'] = date('Y-m-d H:i:s');
        $data['doc_status']    = '0';
        $data['doc_vehicle_id'] = $post->veh_id;
        if($this->BaseModel->_inser_query('park_documents',$data)){
            $this->api_return(array('status' =>true,'error' => 'New Document successfully added !'),self::HTTP_OK);exit;
        }
        $this->api_return(array('status' =>false,'error' => 'Oops! Something went wrong ! Help us improve your experience by sending an error report  !'),self::HTTP_OK);exit;
    }
    
    public function search(){
        $this->_apiConfig([
            'methods' => ['POST'],
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->veh_registration_number) || !isset($post->veh_registration_number)){
            $this->api_return(array('status' =>false,'error' => 'Vehicle Registration number is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        $registration = $post->veh_registration_number;
        $result = $this->BaseModel->_run_query("select park_vehicle.*,
        COALESCE(park_vehicle.veh_owner_register_number,'') as veh_owner_register_number,
        COALESCE(park_vehicle.veh_owner_name,'') as veh_owner_name,
        COALESCE(park_customer.customer_fullname,'') as customer_fullname,
        COALESCE(park_customer.customer_mobile,'') as customer_mobile,
        COALESCE(park_customer.customer_alt_mobile,'') as customer_alt_mobile,
        COALESCE(park_customer.customer_emr1_mobile,'') as customer_emr1_mobile,
        COALESCE(park_customer.customer_emr2_mobile,'') as customer_emr2_mobile,
        COALESCE(park_customer.customer_image,'') as customer_image from park_vehicle left join park_customer on park_customer.customer_id =park_vehicle.veh_customer_id where veh_registration_number='".$registration."' and veh_status='1' ");
        if($result->num_rows() <= 0 ){
            $this->api_return(array('status' =>false,'error' => 'Vehicle Details Not found !'),self::HTTP_OK);exit;
        }
        
        $vehicals = !empty($result->row()->veh_image) ? json_decode($result->row()->veh_image) : array(); 
        foreach($vehicals as $key => $val){
            $vehicals[$key]->url = base_url($val->url);
        }
        
        $result->row()->veh_image = $vehicals; 
        $result->row()->single_image = @$vehicals[0]->url; 
        $result->row()->veh_shere = base_url('api/v1/vehicle/details/'.$result->row()->veh_id);
        $this->api_return(array('status' =>true,'error' =>'Vehicle Details found !','data'=>$result->row()),self::HTTP_OK);exit;
        
    }
}