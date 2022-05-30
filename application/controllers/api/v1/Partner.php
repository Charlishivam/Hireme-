<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'libraries/api-libraries/API_Controller.php'; // for load rest controller
class Partner extends API_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function list(){
        $this->_apiConfig([
            'methods' => ['POST'], // 'GET', 'OPTIONS'
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]); 
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->customer_id) || !isset($post->customer_id)){
            $this->api_return(array('status' =>false,'error' => 'Customer ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        $customer_id = $post->customer_id;
        $customer_referral  = $this->CustomerModel->_get_customer_single_column($customer_id,'customer_referral_code');
        
        if(empty($customer_referral)){
            $this->api_return(array('status' =>false,'error' => 'Customer referral code not found !'),self::HTTP_OK);exit;
        }
        
        $results     = $this->ReferralModel->_get_partner_list($customer_referral);
        if($results->num_rows() <= 0){
            $this->api_return(array('status' =>false,'error' => 'Partner not found !'),self::HTTP_OK);exit;
        }
        $this->api_return(array('status' =>true,'error' => 'Partner found !','data'=>$results->result()),self::HTTP_OK);exit;
    }
    
    public function rewards(){
        $this->_apiConfig([
            'methods' => ['POST'], // 'GET', 'OPTIONS'
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]); 
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->customer_id) || !isset($post->customer_id)){
            $this->api_return(array('status' =>false,'error' => 'Customer ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        $customer_id = $post->customer_id;
        $customer_referral  = $this->CustomerModel->_get_customer_single_column($customer_id,'customer_referral_code');
        
        if(empty($customer_referral)){
            $this->api_return(array('status' =>false,'error' => 'Customer referral code not found !'),self::HTTP_OK);exit;
        }
        $balence     = $this->WalletsModel->_get_total_rewards_amount($customer_id,$customer_referral)->row();
        
        $data['balance'] = $balence->balence > 0 ? $balence->balence : '0';
        $data['earn']    = $balence->balence > 0 ? $balence->balence : '0';
        $data['spent']   = $balence->balence > 0 ? $balence->balence : '0';
        
        $this->api_return(array('status' =>true,'error' => 'Data found !','data'=>$data),self::HTTP_OK);exit;
    }
    
    public function rewardsprofile(){
        $this->_apiConfig([
            'methods' => ['POST'], // 'GET', 'OPTIONS'
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]); 
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->customer_id) || !isset($post->customer_id)){
            $this->api_return(array('status' =>false,'error' => 'Customer ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        $customer_id = $post->customer_id;
        $customer_referral  = $this->CustomerModel->_get_customer_single_column($customer_id,'customer_referral_code');
        
        if(empty($customer_referral)){
            $this->api_return(array('status' =>false,'error' => 'Customer referral code not found !'),self::HTTP_OK);exit;
        }
        
        $count     = $this->WalletsModel->_get_total_rewards_count($customer_id,$customer_referral)->row();
        
        
        
        $data['totalpartner'] = $count->count > 0 ? $count->count.' FRIENDS' : '0 FRIENDS';
        
        $record    = $this->BaseModel->_run_query("select * from park_slab_target where slab_target_number >='".($count->count > 0 ? $count->count : 0)."' limit 1")->row();
        $data['nextrewards']  = !empty($record->slab_revenue_coins) ? $record->slab_revenue_coins :'0';
        
        $this->api_return(array('status' =>true,'error' => 'Data found !','data'=>$data),self::HTTP_OK);exit;
    }
    
    public function claimrewards(){
        $this->_apiConfig([
            'methods' => ['POST'], // 'GET', 'OPTIONS'
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]); 
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->customer_id) || !isset($post->customer_id)){
            $this->api_return(array('status' =>false,'error' => 'Customer ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        $customer_id = $post->customer_id;
        $record    = $this->BaseModel->_run_query('select * from park_slab_target');
        foreach($record->result() as $key => $data){
            $record->result()[$key]->slab_is_claim = 1;
        }
        
        if($record->num_rows() <= 0){
            $this->api_return(array('status' =>false,'error' => 'Data not found !'),self::HTTP_OK);exit;
        }
        
        $this->api_return(array('status' =>true,'error' => 'Partner found !','data'=>$record->result()),self::HTTP_OK);exit;
     }
}