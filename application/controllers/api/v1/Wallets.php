<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'libraries/api-libraries/API_Controller.php'; // for load

class Wallets extends API_Controller {
    
    public function __construct() {
        parent::__construct();
        
    }
    
    public function index(){
        $this->_apiConfig([
            'methods' => ['POST'],
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->customer_id) || !isset($post->customer_id) ){
            $this->api_return(array('status' =>false,'error' => 'customer ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        $customer_id = $post->customer_id;
        $offset      = isset($post->offset) && !empty($post->offset) ? $post->offset : 100; 
        $count       = isset($post->count) && !empty($post->count) ? $post->count : 0;
        
        $balence     = $this->WalletsModel->_get_total_wallet_amount($customer_id)->row();
        $balence     = !empty($balence->balence) ? (int)$balence->balence : 0;
        $history     = $this->WalletsModel->_get_wallet_history($customer_id,$offset,$count);
        $coinback    = $this->WalletsModel->_get_total_wallet_coins_back_amount($customer_id)->row();
        
        $coinback    = !empty($coinback->balence) ? (int)$coinback->balence : 0;
        if($history->num_rows() <= 0){
            $this->api_return(array('status' =>true,'error' => 'Wallet Data not found !'),self::HTTP_OK);exit;
        }
        $this->api_return(array('status' =>true,'error' => 'Wallet Data found !','balence'=>$balence,'coin'=>$coinback,'data'=>$history->result()),self::HTTP_OK);exit;
    }
    
    public function alerts(){
        $this->_apiConfig([
            'methods' => ['POST'],
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->customer_id) || !isset($post->customer_id) ){
            $this->api_return(array('status' =>false,'error' => 'customer ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        $customer_id = $post->customer_id;
        $alert_by_you       = $this->WalletsModel->raised_by_you($customer_id)->num_rows();
        $alert_against_you  = $this->WalletsModel->raised_against_you($customer_id)->num_rows();
        $this->api_return(array('status' =>true,'error' => 'Data found !','alert_by_you'=>$alert_by_you,'alert_against_you'=>$alert_against_you),self::HTTP_OK);exit;
    }
}