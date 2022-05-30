<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'libraries/api-libraries/API_Controller.php'; // for load

class Vehicletransfer extends API_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->data['vehicletransfer'] = 'uploads/customer_vehicle_transfer/';
        
       // $this->data['config']['book_pre_fix']  = "PMV";
        
        
       
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
        //$trans_customer_device_token = $post->trans_customer_device_token;
        //$trans_customer_device_name = $post->trans_customer_device_name;
        
        
        $checkvehicleID    = $this->BaseModel->_single_data_query(array('veh_id'=>$tran_vehicle_id),'park_vehicle','*');
        if(empty($checkvehicleID)){
            $this->api_return(array('status' =>false,'error' => 'This vehicle is not exist!'),self::HTTP_OK);exit;
        }
       
      
        
     
        $checkvehicle    = $this->BaseModel->_single_data_query(array('veh_id'=>$tran_vehicle_id,'veh_transfer_status'=>1),'park_vehicle','*');
        if($checkvehicle->num_rows() > 0){
            $this->api_return(array('status' =>false,'error' => 'This Vehicle is already transfer !'),self::HTTP_OK);exit;
        }
        
       
        /*====================check vehicle end=========================*/
        if(!empty($post->tran_customer_id) && isset($post->tran_customer_id)){
            $data['tran_customer_id'] = $post->tran_customer_id;
        }
        if(!empty($post->tran_vehicle_id) && isset($post->tran_vehicle_id)){
            $data['tran_vehicle_id'] = $post->tran_vehicle_id;
        }
        if(!empty($post->tran_new_customer_id) && isset($post->tran_new_customer_id)){
            $data['tran_new_customer_id'] = $post->tran_new_customer_id;
        }
        
        
        if(!empty($post->tran_mobile_number) && isset($post->tran_mobile_number)){
            $data['tran_mobile_number'] = $post->tran_mobile_number;
        }
        
        // $data['trans_customer_device_token']               = $trans_customer_device_token;
        // $data['trans_customer_device_name']               = $trans_customer_device_name;
        $data['tran_date']                                = date('Y-m-d', strtotime($post->tran_date));
        $data['tran_create_at']                    = date('Y-m-d h:i:s');
        
        
        if(!empty($post->tran_proof_id) && isset($post->tran_proof_id)){
            $path = $this->data['vehicletransfer'];
            $file_0 = $this->BaseModel->_upload_Base64_image($post->tran_proof_id,$path);
            $data['tran_proof_id']      = $path.$file_0;
        }
        
        
        
        
        
      
        
      
        
        /*============================otp ===========================*/
        $is_sent_otp = 0;
        $otp_text    = '';
        if($tran_mobile_number){
            $is_sent_otp = 0;
            $otp_text    = rand(111111,999999);
            $ownermobile = @$post->tran_mobile_number;
            $data['trans_customer_otp']             = $otp_text;
            $data['trans_customer_otp_verified '] = '0';
            $template_customer = $this->BaseModel->get_template_by_slug("otp");
            
            if(!empty($template_customer)){
                $variables['#OTP']          =  $otp_text;
				$variables['#message_key']  =  'Message';
				$smsconte              = str_replace(array_keys($variables), array_values($variables), $template_customer['content']);
				$this->_send_sms($ownermobile,$smsconte,$template_customer['template_id']);
            }
        }
        /*============================otp ===========================*/
        $lastparkid = $this->BaseModel->_inser_query('park_vehicle_transfer',$data); 
       
        if(!empty($lastparkid)){
            $this->api_return(array('status' =>true,'error' => 'Your vehicle has been transferred successfully !','is_sent_otp'=>$is_sent_otp,'otp_text'=>$otp_text,'transfer_id'=>$lastparkid),self::HTTP_OK);exit;
        }
        
       // echo $this->db->last_query(); die();
        $this->api_return(array('status' =>false,'error' => 'Some have server error in vehicle transferred !'),self::HTTP_OK);exit;
    }
    
    
    public function check_transfer_customer_otp(){
        $this->_apiConfig([
            'methods' => ['POST'],
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        
        if(empty($post->transfer_id) || !isset($post->transfer_id)){
            $this->api_return(array('status' =>false,'error' => 'Transfer Id is empty Or missing !'),self::HTTP_OK);exit;
        }
        
       
        if(empty($post->trans_customer_otp) || !isset($post->trans_customer_otp)){
            $this->api_return(array('status' =>false,'error' => 'OTP is empty Or missing !'),self::HTTP_OK);exit;
        } 
        
        $transfer_id              = $post->transfer_id;
        $otp                      = $post->trans_customer_otp;
        $checkopt = $this->BaseModel->_ci_data_query(array('transfer_id'=>$transfer_id),'park_vehicle_transfer','*');
        $single = $checkopt->row();
        if($single->trans_customer_otp == $otp && strlen($otp) == 6){
            $data['trans_customer_otp_verified']         = '1';
            $data['tran_status']                         = '1';
            $this->BaseModel->_update_query('park_vehicle_transfer',$data,array('transfer_id'=>$transfer_id));
            $vehicle['veh_transfer_status'] = '1';
            $this->BaseModel->_update_query('park_vehicle',$vehicle,array('veh_id'=>$single->tran_vehicle_id));
            
            $this->api_return(array('status' =>true,'error' => 'Your one time password successfully match  !'),self::HTTP_OK);exit;
        }else{
            $this->api_return(array('status' =>false,'error' => 'You Enter wrong OTP !'),self::HTTP_OK);exit;
        }
    }
    
    public function get_all_customer(){
        
         $this->_apiConfig([
            'methods' => ['POST'],
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->customer_id) || !isset($post->customer_id)){
            $this->api_return(array('status' =>false,'error' => 'Customer ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        $customer_id = $post->customer_id;
        $result = $this->VehicletransferModel->_get_all_customer_records($customer_id);
        if($result){
            $this->api_return(array('status' =>true,'error' => 'Data found !','data'=>$result),self::HTTP_OK);exit;
        }else{
            $this->api_return(array('status' =>true,'error' => 'Data not found!'),self::HTTP_OK);exit;
        }
    
    
    
         
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
    
    
    
    
   
    
    
    
    
}