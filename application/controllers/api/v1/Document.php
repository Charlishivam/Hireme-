<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'libraries/api-libraries/API_Controller.php'; // for load rest controller
class Document extends API_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->data['document'] = 'uploads/doc/';
    }
    
    public function aadhaar(){
        $this->_apiConfig([
            'methods' => ['POST'], // 'GET', 'OPTIONS'
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);

        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->adhaarfront) && !isset($post->adhaarfront)){
            $this->api_return(array('status' =>false,'error' => 'Aadhaar Card Front Picture Missing Or empty !'),self::HTTP_OK);exit;
        }
        if(empty($post->adhaarback) && !isset($post->adhaarback)){
            $this->api_return(array('status' =>false,'error' => 'Aadhaar Card Back Picture Missing Or empty !'),self::HTTP_OK);exit;
        }
        if(empty($post->aadhaar_no) && !isset($post->aadhaar_no)){
            $this->api_return(array('status' =>false,'error' => 'Aadhaar Card Number Missing Or empty !'),self::HTTP_OK);exit;
        }
        if(strlen($post->aadhaar_no) <> 12 || !is_numeric($post->aadhaar_no)){
            $this->api_return(array('status' =>false,'error' => 'Invalid Aadhaar Number.'.$post->aadhaar_no.'!'),self::HTTP_OK);exit;
        }
        if(empty($post->customer_id) || !isset($post->customer_id)){
            $this->api_return(array('status' =>false,'error' => 'Customer ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        /*pan card verification and save data */
        
        $customer_id = $post->customer_id;
        $aadhaar_no  = $post->aadhaar_no;
        $checkaadhar = $this->BaseModel->_single_data_query(array('cust_number'=>$post->aadhaar_no,'customer_id'=>$customer_id),'park_customer_documents','*');
        if($checkaadhar->num_rows() > 0){
            $this->api_return(array('status' =>false,'error' => 'This Aadhaar number '.$post->aadhaar_no.' is already exist !!'),self::HTTP_OK);exit;
        }
        
        $file_0 = $this->BaseModel->_upload_Base64_image($post->adhaarfront,$this->data['document']);
        $data[0]['cust_image']         = $this->data['document'].$file_0;
        $data[0]['doc_name_type']      = '1';
        $data[0]['cust_status']        = '0';
        $data[0]['cust_create_at']     = date('Y-m-d H:i:s');
        $data[0]['customer_id']        = $customer_id;
        $data[0]['cust_name']          = 'Adhaar front';
        $data[0]['cust_number']        = $aadhaar_no;
        
        $file_1 = $this->BaseModel->_upload_Base64_image($post->adhaarback,$this->data['document']);
        $data[1]['cust_image']         = $this->data['document'].$file_0;
        $data[1]['doc_name_type']      = '1';
        $data[1]['cust_status']        = '0';
        $data[1]['cust_create_at']     = date('Y-m-d H:i:s');
        $data[1]['customer_id']        = $customer_id;
        $data[1]['cust_name']          = 'Adhaar Back';
        $data[1]['cust_number']        = $aadhaar_no;

        /*adhar card online verification*/
        $otpdata['client_id']       = 0;
        $otpdata['otp_sent']        = 0;
        $otpdata['valid_aadhaar']   = 0;
        
        if(@$this->data['config']['doc_verification_enable'] == 1 && @$this->data['config']['aadhaar_verification_enable'] == 1){
            $token  = $this->data['config']['doc_verification_token'];
            $apiurl = $this->data['config']['doc_verification_api_url'].'/aadhaar-v2/generate-otp';
            $datas['id_number'] = $aadhaar_no;
            $response = $this->_ex_curl(json_encode($datas),$token,$apiurl);
            $response = json_decode($response);
            
            if($response->status_code == 200 && $response->success == 1){
                $otpdata['client_id']       = $response->data->client_id;
                $otpdata['otp_sent']        = $response->data->otp_sent == true ? 1 : 0;
                $otpdata['valid_aadhaar']   = $response->data->valid_aadhaar == true ? 1 : 0;
            }else{
                $data[0]['cust_reason']          = @$response->message;
                $data[1]['cust_reason']          = @$response->message;
            }
        }
        /*old image remove from directroy*/
        $olddata = $this->BaseModel->_single_data_query(array('doc_name_type'=>'1','customer_id'=>$customer_id),'park_customer_documents','*');
        foreach($olddata->result() as $keys => $img){
            @unlink($img->cust_image);
            $data['cust_update_at']     = date('Y-m-d H:i:s');
            $this->BaseModel->_update_query('park_customer_documents',$data[$keys],array('customer_id'=>$customer_id,'doc_id'=>$img->doc_id));
        }

        if($olddata->num_rows() <= 0){ 
            $this->db->insert_batch('park_customer_documents',$data);
            $this->api_return(array('status' =>true,'error' => 'Aadhaar Card has been successfully uploaded !','data'=>$otpdata),self::HTTP_OK); 
        }else{
            $this->api_return(array('status' =>true,'error' => 'Aadhaar Card has been successfully uploaded !','data'=>$otpdata),self::HTTP_OK); 
        }
    }
    
    public function dl(){
        $this->_apiConfig([
            'methods' => ['POST'], // 'GET', 'OPTIONS'
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);

        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->dl_img) && !isset($post->dl_img)){
            $this->api_return(array('status' =>false,'error' => 'Driving License Document Missing Or empty !'),self::HTTP_OK);exit;
        }
        if(empty($post->dl_number) && !isset($post->dl_number)){
            $this->api_return(array('status' =>false,'error' => 'Driving License No Number Missing Or empty !'),self::HTTP_OK);exit;
        }
        if(empty($post->customer_id) || !isset($post->customer_id)){
            $this->api_return(array('status' =>false,'error' => 'Customer ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        /*pan card verification and save data */
        $customer_id = $post->customer_id;
        $dl_number   = $post->dl_number;
        $checkaadhar = $this->BaseModel->_single_data_query(array('cust_number'=>$dl_number,'customer_id'=>$customer_id),'park_customer_documents','*');
        if($checkaadhar->num_rows() > 0){
            $this->api_return(array('status' =>false,'error' => 'This Dl number '.$dl_number.' is already exist !!'),self::HTTP_OK);exit;
        }
        
        $file_0 = $this->BaseModel->_upload_Base64_image($post->dl_img,$this->data['document']);
        $data['cust_image']         = $this->data['document'].$file_0;
        $data['doc_name_type']      = '2';
        $data['cust_status']        = '0';
        $data['cust_create_at']     = date('Y-m-d H:i:s');
        $data['customer_id']        = $customer_id;
        $data['cust_name']          = 'DL';
        $data['cust_number']        = $dl_number;

        /*DL card online verification*/
        
        if(@$this->data['config']['doc_verification_enable'] == 1 && @$this->data['config']['aadhaar_verification_enable'] == 1){
            $token  = $this->data['config']['doc_verification_token'];
            $apiurl = $this->data['config']['doc_verification_api_url'].'/aadhaar-v2/generate-otp';
            $datas['id_number'] = $aadhaar_no;
            $response = $this->_ex_curl(json_encode($datas),$token,$apiurl);
            $response = json_decode($response);
            if($response->status_code == 200 && $response->success == 1){
                $data['cust_status']          = '1';
            }else{
                $data['cust_reason']          = @$response->message;
            }
        }
        /*old image remove from directroy*/
        $olddata = $this->BaseModel->_single_data_query(array('doc_name_type'=>'2','customer_id'=>$customer_id),'park_customer_documents','*');
        foreach($olddata->result() as $keys => $img){
            @unlink($img->cust_image);
            $data['cust_update_at']     = date('Y-m-d H:i:s');
            $this->BaseModel->_update_query('park_customer_documents',$data,array('customer_id'=>$customer_id,'doc_id'=>$img->doc_id));
        }

        if($olddata->num_rows() <= 0){ 
            $this->db->insert('park_customer_documents',$data);
            $this->api_return(array('status' =>true,'error' => 'Driving License has been successfully uploaded !'),self::HTTP_OK); 
        }else{
            $this->api_return(array('status' =>true,'error' => 'Driving License has been successfully uploaded !'),self::HTTP_OK); 
        }
    }
    
    
    
    public function poa(){
        $this->_apiConfig([
            'methods' => ['POST'], // 'GET', 'OPTIONS'
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);

        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->poa_image) && !isset($post->poa_image)){
            $this->api_return(array('status' =>false,'error' => 'Driving License Document Missing Or empty !'),self::HTTP_OK);exit;
        }
        if(empty($post->customer_id) || !isset($post->customer_id)){
            $this->api_return(array('status' =>false,'error' => 'Customer ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        /*pan card verification and save data */
        $customer_id = $post->customer_id;

        
        $file_0 = $this->BaseModel->_upload_Base64_image($post->poa_image,$this->data['document']);
        $data['cust_image']         = $this->data['document'].$file_0;
        $data['doc_name_type']      = '3';
        $data['cust_status']        = '0';
        $data['cust_create_at']     = date('Y-m-d H:i:s');
        $data['customer_id']        = $customer_id;
        $data['cust_name']          = 'POA';

        /*old image remove from directroy*/
        $olddata = $this->BaseModel->_single_data_query(array('doc_name_type'=>'3','customer_id'=>$customer_id),'park_customer_documents','*');
        foreach($olddata->result() as $keys => $img){
            @unlink($img->cust_image);
            $data['cust_update_at']     = date('Y-m-d H:i:s');
            $this->BaseModel->_update_query('park_customer_documents',$data,array('customer_id'=>$customer_id,'doc_id'=>$img->doc_id));
        }

        if($olddata->num_rows() <= 0){ 
            $this->db->insert('park_customer_documents',$data);
            $this->api_return(array('status' =>true,'error' => 'proof of address documents has been successfully uploaded !'),self::HTTP_OK); 
        }else{
            $this->api_return(array('status' =>true,'error' => 'proof of address documents has been successfully uploaded !'),self::HTTP_OK); 
        }
    }
    
    public function aadhaar_submit_otp(){
        $this->_apiConfig([
            'methods' => ['POST'], // 'GET', 'OPTIONS'
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->customer_id) || !isset($post->customer_id)){
            $this->api_return(array('status' =>false,'error' => 'Customer ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->otp) && !isset($post->otp)){
            $this->api_return(array('status' =>false,'error' => 'Aadhaar One Time Password Missing Or empty !'),self::HTTP_OK);exit;
        }
        if(empty($post->client_id) && !isset($post->client_id)){
            $this->api_return(array('status' =>false,'error' => 'Aadhaar Client ID Missing Or empty !'),self::HTTP_OK);exit;
        }

        $msg = 'Aadhaar Card not verified !';
        $customer_id = $post->customer_id;
        $data['cust_status']   = '0';
        if(@$this->data['config']['doc_verification_enable'] == 1){
            $token  = $this->data['config']['doc_verification_token'];
            $apiurl = $this->data['config']['doc_verification_api_url'].'/aadhaar-v2/submit-otp';
            $datas['client_id']     = $post->client_id;
            $datas['otp']           = $post->otp;
            $response = $this->_ex_curl(json_encode($datas),$token,$apiurl);
            $response = json_decode($response);
            if($response->status_code == 200 && $response->success == 1){

                $data['cust_status']   = '1';
                $msg = 'Aadhaar Card has been successfully verified !';
            }
        }
        $data['cust_reason']   = @$response->message;
        if($this->BaseModel->_update_query('park_customer_documents',$data,array('customer_id'=>$customer_id,'doc_name_type'=>'1'))){ 
            $this->api_return(array('status' =>true,'error' => $msg),self::HTTP_OK); 
        }else{
            $this->api_return(array('status' =>false,'error' => 'Some have server error !'),self::HTTP_OK); 
        }
    }
    
    function _ex_curl($data,$token,$url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);    
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-GB; rv:1.9.2) Gecko/20100115 Firefox/3.6 (.NET CLR 3.5.30729)");
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Authorization: Bearer ' . $token));
        // get stringified data/output. See CURLOPT_RETURNTRANSFER
        $excute = curl_exec($ch);
        // get info about the request
        $info = curl_getinfo($ch);
        // close curl resource to free up system resources
        curl_close($ch);
        return $excute ;
    }
}