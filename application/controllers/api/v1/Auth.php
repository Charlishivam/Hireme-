<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'libraries/api-libraries/API_Controller.php'; // for load

class Auth extends API_Controller {

    public function __construct() {
        parent::__construct();
        
    }
    
    public function index(){
        echo "Testing";
    }
    
    
    
    public function checkuser(){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->mobile) || !isset($post->mobile)){
            $this->api_return(array('status' =>false,'error' => 'User name is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->message_key) || !isset($post->message_key)){
            $this->api_return(array('status' =>false,'error' => 'Message Key is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->device_token) || !isset($post->device_token)){
            $this->api_return(array('status' =>false,'error' => 'Firbase Device token is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        
        $fcmtoken   = $post->device_token;
        $mobile     = $post->mobile;
        $messagekey = $post->message_key;
        
        $checkauth = $this->BaseModel->_ci_data_query(array('customer_mobile'=>$mobile,'customer_status'=>'1'),'dk_customer','*');
        if($checkauth->num_rows() > 0){
            /*========================Otp======================*/
            $data['customer_otp'] = rand(111111,999999);
            $data['customer_device_token'] = $fcmtoken;
            $this->BaseModel->_update_query('dk_customer',$data,array('customer_mobile'=>$mobile));
            
            $template_customer = $this->BaseModel->get_template_by_slug("otp");
            if(!empty($template_customer)){
                $variables['#OTP']          =  $data['customer_otp'];
				$variables['#message_key']  =  $messagekey;
				$smsconte              = str_replace(array_keys($variables), array_values($variables), $template_customer['content']);
				$this->_send_sms($mobile,$smsconte,$template_customer['template_id']);
            }
            /*========================Otp======================*/
            
            $is_exist    = '1'; 
            $is_update   = '0'; 
            $this->api_return(array('status' =>true,'error' => 'One time password has been sent successfully your register number +91-'.$mobile.' !','otp'=>$data['customer_otp'],'is_exist'=>$is_exist,'is_update'=>$is_update),self::HTTP_OK);exit;
        }else{
            $is_exist    = '0'; 
            $is_update   = '0';  
            $this->api_return(array('status' =>true,'error' => 'Incorrect mobile number Or this mobile number is not register here  !','is_exist'=>$is_exist,'is_update'=>$is_update),self::HTTP_OK);exit;
        }
    }
    
    public function createuser(){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->mobile) || !isset($post->mobile)){
            $this->api_return(array('status' =>false,'error' => 'User mobile is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->first_name) || !isset($post->first_name) && !is_string($post->first_name)){
            $this->api_return(array('status' =>false,'error' => 'User first name is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->message_key) || !isset($post->message_key)){
            $this->api_return(array('status' =>false,'error' => 'Message Key is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->device_token) || !isset($post->device_token)){
            $this->api_return(array('status' =>false,'error' => 'Firbase Device token is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        
        
        $fcmtoken   = $post->device_token;
        $mobile     = $post->mobile;
        $messagekey = $post->message_key;
        
        $checkauth = $this->BaseModel->_ci_data_query(array('customer_mobile'=>$mobile),'dk_customer','*');
        
        if($checkauth->num_rows() <= 0){
            
            $data['customer_otp']         = '123456';//rand(111111,999999);
            $data['customer_device_token']= $fcmtoken;
            //$data['customer_type']        = $post->customer_type;
            $data['customer_mobile']      = $mobile;
            $data['customer_email']       = isset($post->email) ? $post->email : '';
            $data['customer_first_name']   = $post->first_name;
            $data['customer_last_name']    = isset($post->last_name) ? $post->last_name : '';
            $data['customer_full_name']    = $data['customer_first_name'].' '.$data['customer_last_name'];
            $data['customer_create_at']   = date('Y-m-d H:i:s');
            $lastid = $this->BaseModel->_inser_query('dk_customer',$data);
            
            //echo $this->db->last_query(); die();
            
            
            
            /*========================Otp for sms======================*/
            $template_customer = $this->BaseModel->get_template_by_slug("otp");
            if(!empty($template_customer)){
                $variables['#OTP']          =  $data['customer_otp'];
				$variables['#message_key']  =  $messagekey;
				$smsconte              = str_replace(array_keys($variables), array_values($variables), $template_customer['content']);
				$this->_send_sms($mobile,$smsconte,$template_customer['template_id']);
            }
            /*========================Otp for sms======================*/
            
            $is_exist    = '0'; 
            $is_update   = '0'; 
            $this->api_return(array('status' =>true,'msg' => 'One time password has been sent successfully your register number +91-'.$mobile.' !','otp'=>$data['customer_otp'],'is_exist'=>$is_exist,'is_update'=>$is_update),self::HTTP_OK);exit;
        }else{
            $is_exist    = '1'; 
            $is_update   = '0'; 
            $this->api_return(array('status' =>false,'error' => 'This mobile number already registered !','is_exist'=>$is_exist,'is_update'=>$is_update),self::HTTP_OK);exit;
        }
    }
    
    public function checkuserotp(){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->mobile) || !isset($post->mobile)){
            $this->api_return(array('status' =>false,'error' => 'User mobile is empty Or missing !'),self::HTTP_OK);exit;
        } 
        if(empty($post->otp) || !isset($post->otp)){
            $this->api_return(array('status' =>false,'error' => 'OTP is empty Or missing !'),self::HTTP_OK);exit;
        } 
        $mobile     = $post->mobile;
        $otp        = (int)$post->otp;
        
        $is_exist    = '0'; 
        $checkauth = $this->BaseModel->_ci_data_query(array('customer_mobile'=>$mobile),'dk_customer','customer_otp,customer_id');
        
        if($checkauth->num_rows() <= 0){
            $this->api_return(array('status' =>false,'error' => 'Customer data not found !'),self::HTTP_OK);exit;
        }
        
        $single = $checkauth->row();
        if($single->customer_otp == $otp && strlen($otp) == 6){
            $data['customer_verified']         = '1';
            $this->BaseModel->_update_query('dk_customer',$data,array('customer_mobile'=>$mobile));
            
            
           $this->api_return(array('status' =>true,'error' => 'Your one time password successfully match  !','customer_id'=>$single->customer_id),self::HTTP_OK);exit;
            
        }else{
            $this->api_return(array('status' =>false,'is_exist'=>$is_exist,'error' => 'You Enter wrong OTP !'),self::HTTP_OK);exit;
        }
    }
    
    public function resendotp(){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->mobile) || !isset($post->mobile)){
            $this->api_return(array('status' =>false,'error' => 'User mobile is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->otp_for) || !isset($post->otp_for)){
            $this->api_return(array('status' =>false,'error' => 'One type is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->device_token) || !isset($post->device_token)){
            $this->api_return(array('status' =>false,'error' => 'Firbase Device token is empty Or missing !'),self::HTTP_OK);exit;
        }
        $mobile     = $post->mobile;
        $otp_for    = $post->otp_for;
        $fcmtoken   = $post->device_token;
        
        $checkauth = $this->BaseModel->_ci_data_query(array('customer_mobile'=>$mobile),'dk_customer','customer_otp');
        
        if($otp_for == 1 && $checkauth->num_rows() > 0){
            
            $data['customer_otp']         = '123456';//rand(111111,999999);
            $data['customer_device_token']= $fcmtoken;
            $this->BaseModel->_update_query('dk_customer',$data,array('customer_mobile'=>$mobile));
            
            /*========================Otp======================*/
            $template_customer = $this->BaseModel->get_template_by_slug("otp");
            if(!empty($template_customer)){
                $variables['#OTP']          =  $data['customer_otp'];
				$variables['#message_key']  =  $messagekey;
				$smsconte              = str_replace(array_keys($variables), array_values($variables), $template_customer['content']);
				$this->_send_sms($mobile,$smsconte,$template_customer['template_id']);
            }
           
            /*========================Otp======================*/
            $this->api_return(array('status' =>true,'msg' => 'One time password has been resent successfully your register number +91-'.$mobile.' !','otp'=>$data['customer_otp']),self::HTTP_OK);exit;
        }else{
            $this->api_return(array('status' =>false,'error' => 'This otp type is not configured !'),self::HTTP_OK);exit;
        }
    }
    
    public function logout(){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->customer_id) || !isset($post->customer_id)){
            $this->api_return(array('status' =>false,'error' => 'User ID is empty Or missing !'),self::HTTP_OK);exit;
        } 
        $customer_id = $post->customer_id;
        
        $data['customer_device_token'] = null;
        if($this->BaseModel->_update_query('dk_customer',$data,array('customer_id'=>$customer_id))){
            $this->api_return(array('status' =>true,'msg' => 'Successfully Log out  !'),self::HTTP_OK);exit;
        }else{
            $this->api_return(array('status' =>false,'error' => 'Some have server error !'),self::HTTP_OK);exit;
        }
    }
    
    public function cheackusertype(){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->customer_id) || !isset($post->customer_id)){
            $this->api_return(array('status' =>false,'error' => 'User ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        if(!isset($post->customer_type)){
            $this->api_return(array('status' =>false,'error' => 'User Type is empty Or missing !'),self::HTTP_OK);exit;
        } 
        $customer_id = $post->customer_id;
        
        $data['customer_type'] = $post->customer_type;
        if($this->BaseModel->_update_query('dk_customer',$data,array('customer_id'=>$customer_id))){
            $this->api_return(array('status' =>true,'msg' => 'Successfully Submit  !'),self::HTTP_OK);exit;
        }else{
            $this->api_return(array('status' =>false,'error' => 'Some have server error !'),self::HTTP_OK);exit;
        }
    }
}