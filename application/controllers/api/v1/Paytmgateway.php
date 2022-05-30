<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Paytmgateway extends CI_Controller {
    
    
    public function __construct()
    {
        parent::__construct();
        header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
        header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed
        // $this->methods['index_get']['limit'] = 500;
        $this->load->model('api-v1/CustomerModel');
        $this->load->library('paytmchecksum');
        $this->load->model("api-v1/SettingsModel");
        $this->load->database();
        date_default_timezone_set('Asia/Calcutta');
    }
    
    
    public function index()
    {
        $params = json_decode(trim(file_get_contents('php://input')), TRUE);
        $customer_id  = filter_var($params['customer_id'], FILTER_SANITIZE_NUMBER_INT);
       // $amount       = filter_var($params['amount'], FILTER_SANITIZE_NUMBER_FLOAT);
        $amount       = $params['amount'];
        $orderId      = 'ORDERID_'.rand(100000,999999);
        $type         = filter_var($params['type'], FILTER_SANITIZE_NUMBER_INT);
        if (isset($params['customer_id']) && !empty($params['customer_id'])) 
        {
            $settings  =  $this->SettingsModel->getsettings();
           
            foreach ($settings as $site_settings) 
            {
                if($site_settings['setting_key'] == 'paytm_merchant_mid')
                {
                    $mid = $site_settings['setting_value'];
                }
                if($site_settings['setting_key'] == 'paytm_merchant_key')
                {
                    $mkey = $site_settings['setting_value'];
                }
            }
            
            $mid = (!empty($mid)?$mid:"Parkin17640879739230");
            $mkey = (!empty($mkey)?$mkey:"CC3bM8g7yC#Jl1By");
             
          
            
            $paytmParams = array();
            $paytmParams["body"] = array(
                "requestType" => "Payment",
                "mid" => $mid,
                "websiteName" => "WEBSTAGING",
                "orderId" => $orderId,
                "callbackUrl" => "https://securegw-stage.paytm.in/theia/paytmCallback?ORDER_ID=" . $orderId,
                "txnAmount" => array(
                    "value" => $amount,
                    "currency" => "INR",
                ),
                "userInfo" => array(
                    "custId" => $customer_id,
                ),
            );
             
            $checksum = $this->paytmchecksum->generateSignature(json_encode($paytmParams["body"], JSON_UNESCAPED_SLASHES), $mkey); 
            $paytmParams["head"] = array(
                "signature" => $checksum
            );

            $post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);
            $result = $this->callCurl($mid,$orderId,$post_data,$type);
            
            
            $data = json_decode(trim($result, TRUE));
            
            
            $reponseMsg = $data->body->resultInfo->resultMsg;
            $signature = $data->head->signature;
            $txnToken  = $data->body->txnToken;
           
            if($signature && $txnToken)
            {
                $response['status']         = true;
                //$response['respMsg']        = $reponseMsg;
                $response['message']        = 'Authorization successfully !';
                $response['mid']            = $mid;
                $response['callbackUrl']    = $paytmParams["body"]['callbackUrl'];
                $response['orderid']        = $orderId;
                $response['amount']         = $amount;
                $response['token']          = $txnToken;
                $response['sig']            = $signature;
                echo json_encode($response);
            }
            else
            {
                $response['status']      = false;
                $response['message']      = "Unauthorized user !";
                echo json_encode($response);

            }

           

        }
        else
        {
            $response['status']       = false;
            $response['message']      = "Please Provide maindatory data !";
            echo json_encode($response);
    
        }
        
    }
    
    // check status of paytm 
    public function checkStatus()
    {
        $params = json_decode(trim(file_get_contents('php://input')), TRUE);
        $orderid       = $params['orderid'];
        $type          = filter_var($params['type'], FILTER_SANITIZE_NUMBER_INT);
        
        
        if(empty($params['customer_id'])){
            $response['status']       = false;
            $response['message']      = "Please Provide customer_id!";
            echo json_encode($response); exit;
        }
        
        if(empty($params['amount'])){
            $response['status']       = false;
            $response['message']      = "Please Provide amount!";
            echo json_encode($response); exit;
        }
        
        
        $customer_id    = $params['customer_id'];
        $amount         = $params['amount']; 
           

        if (isset($params['orderid']) && !empty($params['orderid'])) 
        {
            $settings  =  $this->SettingsModel->getsettings();
           
            foreach ($settings as $site_settings) 
            {
                if($site_settings['setting_key'] == 'paytm_merchant_mid')
                {
                    $mid = $site_settings['setting_value'];
                }
                if($site_settings['setting_key'] == 'paytm_merchant_key')
                {
                    $mkey = $site_settings['setting_value'];
                }
            }
            
            $mid = (!empty($mid)?$mid:"Parkin17640879739230");
            $mkey = (!empty($mkey)?$mkey:"CC3bM8g7yC#Jl1By");
            
            
            
            $paytmParams = array();
            $paytmParams["body"] = array(
                "mid" => $mid,
                "orderId" => $orderid,
            );

            $checksum = $this->paytmchecksum->generateSignature(json_encode($paytmParams["body"], JSON_UNESCAPED_SLASHES), $mkey); 
            
            $paytmParams["head"] = array(
                "signature" => $checksum
            );
            
            $post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);
           
            $result = $this->callStatusCurl($post_data,$type);
            
             //print_r($result); exit;
            $data = json_decode(trim($result, TRUE));
            
            //print_r($data); exit;
            $signature = $data->head->signature;
            $txnId  = $data->body->txnId;
            $reponseMsg = $data->body->resultInfo->resultMsg;
            $resultStatus = $data->body->resultInfo->resultStatus;
           
            if($signature && $txnId && $resultStatus =='TXN_SUCCESS')
            {
                $status       = '1';
                $response['status']       = true;
                $response['message']      = "Payment done successfully !";
                $response['txn_status']   = $resultStatus;
                $response['orderid']      = $orderid;
                $response['response_data']  = $data;
                echo json_encode($response);
            }
            else
            {
                $status       = '0';
                $response['status']       = false;
                $response['message']      = "Payment not done try again !";
                echo json_encode($response);
            }
             
           
            $datas['wallet_customer_id'] = $params['customer_id'];
            $datas['wallets_amount'] = $params['amount']*100;
            $datas['wallets_transaction_id'] = $orderid;
            $datas['wallets_transaction_type'] = '1';
            $datas['wallets_description'] = 'Debit amount from customer';
            $datas['wallets_date_time'] = date('Y-m-d H:i:s A');
            $datas['wallets_type'] = '1';
            $datas['wallets_status'] = $status;
            $datas['wallets_create_at'] = date('Y-m-d H:i:s A');
            $this->db->insert("park_wallets",$datas);
            //echo $this->db->last_query(); exit;
        }
        else
        {
            $response['status']         = false;
            $response['message']    = "Please Provide maindatory data !";
            echo json_encode($response);
                
        }
        

    }

    public function callCurl($mid,$orderId,$post_data,$type)
    {
        if($type=='1')
        {
            // Production
            $url = "https://securegw.paytm.in/theia/api/v1/initiateTransaction?mid=" . $mid . "&orderId=". $orderId;

        }
        else
        {
            // Staging
            $url = "https://securegw-stage.paytm.in/theia/api/v1/initiateTransaction?mid=" . $mid . "&orderId=" . $orderId;
        }
        
       
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        $response = curl_exec($ch);
         //print_r($response); exit;
      return $response;
    }

    //
    public function callStatusCurl($post_data,$type)
    {
        if($type=='1')
        {
            // Production
            $url = "https://securegw.paytm.in/v3/order/status";

        }
        else
        {
            // Staging
            $url = "https://securegw-stage.paytm.in/v3/order/status";
        }
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $response = curl_exec($ch);
        
        //print_r($response); exit;
        return $response;
    }
    
    
}

