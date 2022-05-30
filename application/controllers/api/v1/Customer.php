<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'libraries/api-libraries/API_Controller.php'; // for load

class Customer extends API_Controller {

    public function __construct() {
        parent::__construct();
        
    }
    
    public function details($customer_id = null){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->customer_id) || !isset($post->customer_id)){
            $this->api_return(array('status' =>false,'error' => 'Customer ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        
        $check = $this->BaseModel->_ci_data_query(array('customer_id'=>$post->customer_id),'dk_customer','*,concat("'.base_url().'",customer_image) as customer_image');
        
        
        
        if($check->num_rows() <= 0){
            $this->api_return(array('status' =>false,'error' => 'Data not Found !'),self::HTTP_OK);exit;
        }
        $signle = $check->row();
        
        
        $this->api_return(array('status' =>true,'msg' => 'Data Found !','data'=>$signle),self::HTTP_OK);exit;
    }
    
    /*
    |Profile Picture update 
    |single image updated for customer 
    */
    public function photoupdate(){
       $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]); 
        
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->customer_id) || !isset($post->customer_id)){
            $this->api_return(array('status' =>false,'error' => 'Customer ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->customer_image) || !isset($post->customer_image)){
            $this->api_return(array('status' =>false,'error' => 'Customer image is empty Or missing !'),self::HTTP_OK);exit;
        }
        $customer_id    = $post->customer_id;
        $customer_image = $post->customer_image;
        $path           = 'uploads/customer/';
        $file = $this->BaseModel->_upload_Base64_image($customer_image,$path);
        //remove old image 
        $image = $this->BaseModel->_single_data_query(array('customer_id'=>$customer_id),'dk_customer','customer_image')->row();
        if(!empty($image->customer_image) && !empty($file)){
            @unlink($image->customer_image);
        }
        if($this->BaseModel->_update_query('dk_customer',array('customer_image'=>$path.$file),array('customer_id'=>$customer_id))){
            $this->api_return(array('status' =>true,'msg' => 'Profile picture have been successfully updated !'),self::HTTP_OK);exit;
        }else{
            $this->api_return(array('status' =>false,'error' => 'Oops! Something went wrong ! Help us improve your experience by sending an error report  !'),self::HTTP_OK);exit;
        }
    }
    
    
    /*
    |Profile details update 
    |details updated for customer 
    */
    public function update(){
       $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]); 
        
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->customer_id) || !isset($post->customer_id)){
            $this->api_return(array('status' =>false,'error' => 'Customer ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        
        
        $customer_id    = $post->customer_id;
        
        if(!empty($post->customer_email) && isset($post->customer_email)){
            $data['customer_email'] = $post->customer_email;
        }
        
        if(!empty($post->customer_first_name) && isset($post->customer_first_name)){
            $data['customer_first_name'] = $post->customer_first_name;
            $data['customer_full_name'] .= $post->customer_first_name;
        }
        if(!empty($post->customer_last_name) && isset($post->customer_last_name)){
            $data['customer_last_name']  = $post->customer_last_name;
            $data['customer_full_name'] .= ' '.$post->customer_last_name;
        }
        
        if(!empty($post->customer_dob) && isset($post->customer_dob)){
            $data['customer_dob']  = $post->customer_dob;
        }
        
        if(!empty($post->customer_gender) && isset($post->customer_gender)){
            $data['customer_gender']  = $post->customer_gender;
        }
        
        if(!empty($post->customer_description) && isset($post->customer_description)){
            $data['customer_description']  = $post->customer_description;
        }
        
        if(!empty($post->customer_work_experience) && isset($post->customer_work_experience)){
            $data['customer_work_experience']  = $post->customer_work_experience;
        }
        if(!empty($post->customer_address1) && isset($post->customer_address1)){
            $data['customer_address1']  = $post->customer_address1;
        }
        
        if(!empty($post->customer_address2) && isset($post->customer_address2)){
            $data['customer_address2']  = $post->customer_address2;
        }
        if(!empty($post->customer_pincode) && isset($post->customer_pincode)){
            $data['customer_pincode']  = $post->customer_pincode;
        }
        
        if(!empty($post->customer_state) && isset($post->customer_state)){
            $data['customer_state']  = $post->customer_state;
        }
        if(!empty($post->customer_city) && isset($post->customer_city)){
            $data['customer_city']  = $post->customer_city;
        }
        
      
        
        
        if(!empty($post->customer_lat) && isset($post->customer_lat)){
            $data['customer_lat']  = $post->customer_lat;
        }
        if(!empty($post->customer_long) && isset($post->customer_long)){
            $data['customer_long']  = $post->customer_long;
        }
        
        $data['customer_update_at']  = date("Y-m-d H:i:s");
        if($this->BaseModel->_update_query('dk_customer',$data,array('customer_id'=>$customer_id))){
            
        
            $this->api_return(array('status' =>true,'msg' => 'Profile  have been successfully updated !'),self::HTTP_OK);exit;
        }else{
            $this->api_return(array('status' =>false,'error' => 'Oops! Something went wrong ! Help us improve your experience by sending an error report  !'),self::HTTP_OK);exit;
        }
    }
    
    
    
    
}