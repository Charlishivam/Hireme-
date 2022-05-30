<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'libraries/api-libraries/API_Controller.php'; // for load rest controller

class Referral extends API_Controller {

    public function __construct() {
        parent::__construct();
        
    }
    
    public function customer(){
       $this->_apiConfig([
            'methods' => ['POST'], // 'GET', 'OPTIONS'
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]); 
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->customer_id) || !isset($post->customer_id)){
            $this->api_return(array('status' =>false,'error' => 'Customer ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        $customer_id = $post->customer_id;
        $refferal    = $this->ReferralModel->_get_referral_code_by_id($customer_id);
        //print_r($this->data['config']);exit;
        $message = array();
        if(!empty($this->data['config']['referral_cashback_coin_self']) && isset($this->data['config']['referral_cashback_coin_self']) && $this->data['config']['referral_cashback_coin_self'] > 0){
            $msg['msg'] = "Gift and get ".$this->data['config']['referral_cashback_coin_self']." coins on every referral registration. ";
            array_push($message,$msg);
        }
        // if(!empty($this->data['config']['alert_subcription_validity_self']) && isset($this->data['config']['alert_subcription_validity_self']) && $this->data['config']['alert_subcription_validity_self'] > 0){
        //     $msg['msg'] = $this->data['config']['alert_subcription_validity_self']." Days expiry and renewal alerts.";
        //     array_push($message,$msg);
        // }
        // if(!empty($this->data['config']['vehivle_buyer_inquiry_count_self']) && isset($this->data['config']['vehivle_buyer_inquiry_count_self']) && $this->data['config']['vehivle_buyer_inquiry_count_self'] > 0){
        //     $msg['msg'] = $this->data['config']['vehivle_buyer_inquiry_count_self']." Vehicle buyer inquery.";
        //     array_push($message,$msg);
        // }
        // if(!empty($this->data['config']['report_alert_count_self']) && isset($this->data['config']['report_alert_count_self']) && $this->data['config']['report_alert_count_self'] > 0){
        //     $msg['msg'] = $this->data['config']['report_alert_count_self']." Reporting alerts. (All services valid for 30 days ) ";
        //     array_push($message,$msg);
        // }
        
        if($refferal->num_rows() <= 0 ){
            $this->api_return(array('status' =>false,'error' => 'Referral Code Not Found!'),self::HTTP_OK);exit;
        }
        
        
        $refferal->row()->customer_referral_message   = $message;
        //$refferal->row()->customer_referral_message = $this->data['config']['referral_message_partner'];
        $this->api_return(array('status' =>true,'error' => 'Referral Code Found !','data'=>$refferal->row()),self::HTTP_OK);exit;
    }
}