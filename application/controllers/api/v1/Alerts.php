<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'libraries/api-libraries/API_Controller.php'; // for load

class Alerts extends API_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function list(){
        $this->_apiConfig([
            'methods' => ['GET'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        
        $records = $this->BaseModel->_run_query('select alert_id,alert_text,alert_type,alerts_amount,alert_is_paid from park_alerts where alert_status="1" order by alert_text asc');
        if($records->num_rows() <= 0){
            $this->api_return(array('status' =>false,'error' => 'Data Not found !'),self::HTTP_OK);exit;
        }
        $this->api_return(array('status' =>true,'error' => 'Data found !','data'=>$records->result()),self::HTTP_OK);exit;
    }
    
    public function uploadproof(){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->customer_id) || !isset($post->customer_id) ){
            $this->api_return(array('status' =>false,'error' => 'Customer ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->proof_image) || !isset($post->proof_image) || !is_array($post->proof_image)){
            $this->api_return(array('status' =>false,'error' => 'Proof Image is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->registration_no) || !isset($post->registration_no) ){
            $this->api_return(array('status' =>false,'error' => 'Registration No is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->vehicle_id) || !isset($post->vehicle_id) ){
            $this->api_return(array('status' =>false,'error' => 'Vehicle ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->alert_type_id) || !isset($post->alert_type_id) ){
            $this->api_return(array('status' =>false,'error' => 'Alert Type ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        $vehicle_id = $post->vehicle_id;
        $record    = $this->BaseModel->_run_query('select * from park_vehicle pv left join park_customer pc on pc.customer_id = pv.veh_customer_id where veh_id="'.$vehicle_id.'" limit 1');
        if($record->num_rows() <= 0){
            $this->api_return(array('status' =>false,'error' => 'Vehicle Customer details is empty !'),self::HTTP_OK);exit;
        }
        
        $single      = $record->row();
        $proof_image = $post->proof_image;
        $proof_array = array();
        $front_image = $this->BaseModel->_upload_Base64_image($proof_image[0]->front_image,$this->data['proofpath']);
        $back_image  = $this->BaseModel->_upload_Base64_image($proof_image[1]->back_image,$this->data['proofpath']);
        $left_image  = $this->BaseModel->_upload_Base64_image($proof_image[2]->left_image,$this->data['proofpath']); 
        $right_image = $this->BaseModel->_upload_Base64_image($proof_image[3]->right_image,$this->data['proofpath']);
        
        $proof_array = [
            array('front_image' =>$this->data['proofpath'].$front_image),
            array('back_image'  =>$this->data['proofpath'].$back_image),
            array('left_image'  =>$this->data['proofpath'].$left_image),
            array('right_image' =>$this->data['proofpath'].$right_image),
            ];
            
        $data['alert_customer_id']              = $single->customer_id;
        $data['alert_proof_image']              = json_encode($proof_array);
        $data['alert_create_at']                = date('Y-m-d H:i:s');
        $data['alert_customer_by']              = $post->customer_id;
        $data['alert_vehicle_id']               = $post->vehicle_id;
        $data['alert_type']                     = '1';
        $data['alert_type_id']                  = $post->alert_type_id;
        $data['alert_vehicle_registration_no']  = $post->registration_no;
        $data['alert_status']                   = '0';
        $data['alert_status_history']           = json_encode([array('remark'=>'Proof Uploads','date'=>date('Y-m-d H:i:s'),'status'=>'0')]);
        $data['alert_job_status']               = '0';
        $data['alert_job_status_history']       = json_encode([array('remark'=>'Proof Uploads','date'=>date('Y-m-d H:i:s'),'status'=>'0')]);
        
        if($last = $this->BaseModel->_inser_query('park_alerts_reached',$data)){
            $this->api_return(array('status' =>true,'error' => 'Proof submitted !','alert_id'=>$last),self::HTTP_OK);exit;
        }else{
            $this->api_return(array('status' =>false,'error' =>'Oops! Something went wrong ! Help us improve your experience by sending an error report  !'),self::HTTP_OK);exit;
        }
    }
    /*
    |Make payment and send alert auto 
    |Send alert by sms and puch notification
    |Reporting alert 
    */
    public function makepay(){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);  
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->alert_id) || !isset($post->alert_id) ){
            $this->api_return(array('status' =>false,'error' => 'Proof ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        $alert_id  = $post->alert_id;
        $record    = $this->BaseModel->_run_query('select * from park_alerts_reached par left join park_alerts pa on pa.alert_id = par.alert_type_id where par.alert_id="'.$alert_id.'" limit 1');
        if($record->num_rows() <= 0){
            $this->api_return(array('status' =>false,'error' => 'Proof details is empty !'),self::HTTP_OK);exit;
        }
        $single = $record->row(); 
        $alertamount = $single->alerts_amount;
        $customer_id = $single->alert_customer_id;
        
        /*=================check payment for wallets start code===============*/
        $totalbalence = $this->WalletsModel->_get_total_wallet_amount_active_date($single->alert_customer_id);
        $totalalerts  = $this->WalletsModel->_alert_check_customer($single->alert_customer_id);
        $is_alert     = 0;
        $is_wallet    = 0;
        
        /*if(($totalalerts <= 0 && $totalbalence <= 0) || $alertamount == 0 ){
            $this->api_return(array('status' =>false,'error' => 'Your balance is exceeds !','is_alert'=>$is_alert,'is_wallet'=>$is_wallet,'total_wallet'=>$totalbalence,'total_alert'=>$totalalerts),self::HTTP_OK);exit;
        }*/
        /*$totalalerts is low balence */
        //if(($totalalerts > 0 || $totalbalence ) || $alertamount == 0){
            $alerts['alerts_customer_id'] = $customer_id;
            $alerts['alerts_count']       = 1;
            $alerts['alerts_type']        = '1';
            $alerts['alerts_create_at']   = date('Y-m-d H:i:s');
            $alerts['alerts_status']      = '1';
            $alerts['alerts_total_days']  =  0;
            $alerts['alerts_statement']   = '0';
            $alerts['alerts_description'] = "Alert sent !";
            $alerts['alerts_start_at']    = date('Y-m-d H:i:s');
            $alerts['alerts_stop_at']     = date('Y-m-d H:i:s');
            $this->BaseModel->_inser_query('park_customer_alerts',$alerts);
        /*}else if($totalbalence >= $alertamount || $alertamount == 0){
            $this->WalletsModel->_use_wallet($customer_id ,'ALS'.$alert_id, $alertamount,"Alert sent !",'2');
        }else{
            $this->api_return(array('status' =>false,'error' => 'Your balance is exceeds !','is_alert'=>$is_alert,'is_wallet'=>$is_wallet,'total_wallet'=>$totalbalence,'total_alert'=>$totalalerts),self::HTTP_OK);exit;
        }*/
        
        
        /*=================check payment for wallets close code===============*/
        $job_status       = array();
        $alert_status     = array();
        $alert_status = !empty($single->alert_status_history) ? json_decode($single->alert_status_history) : array();
        $job_status   = !empty($single->alert_job_status_history) ? json_decode($single->alert_job_status_history) : array();
        array_push($job_status,array('remark'=>'Alert send !','date'=>date('Y-m-d H:i:s'),'status'=>'1'));
        array_push($alert_status,array('remark'=>'Payemnt Complete !','date'=>date('Y-m-d H:i:s'),'status'=>'1'));
        
        $data['alert_status']                   = '1';
        $data['alert_status_history']           = json_encode($alert_status);
        $data['alert_job_status']               = '1';
        $data['alert_job_status_history']       = json_encode($job_status);
        
        if($this->BaseModel->_update_query('park_alerts_reached',$data,array('alert_id'=>$alert_id))){
            /*========================send alert by sms========================*/
            /*$template_customer = $this->BaseModel->get_template_by_slug("otp");
            if(!empty($template_customer)){
                $tokens  = array($this->CustomerModel->_get_customer_single_column($single->alert_customer_by,'customer_mobile'));
                $variables['#OTP']          =  $data['customer_otp'];
				$smsconte                   = str_replace(array_keys($variables), array_values($variables), $template_customer['content']);
				$this->_send_sms($mobile,$smsconte,$template_customer['template_id']);
            }*/
            /*=================================================================*/
            /*========================send alert by fcm========================*/
            //TO
            $tokens  = array($this->CustomerModel->_get_customer_single_column($customer_id,'customer_device_token'));
            $title   = $single->alert_text;
            $content = $single->alert_text;
            $image   = base_url($single->alert_proof_image);
            $this->_send_alert_by_fcm($tokens,$title,$content,$image,$customer_id);
            //From
            $tokens  = array($this->CustomerModel->_get_customer_single_column($single->alert_customer_by,'customer_device_token'));
            $title   = $single->alert_text;
            $content = $single->alert_text;
            $image   = base_url($single->alert_proof_image);
            $this->_send_alert_by_fcm($tokens,$title,$content,$image,$single->alert_customer_by);
            /*=================================================================*/
            $this->api_return(array('status' =>true,'error' => 'Alert have been successfully sent !','alert_id'=>$alert_id),self::HTTP_OK);exit;
        }else{
            $this->api_return(array('status' =>false,'error' =>'Oops! Something went wrong ! Help us improve your experience by sending an error report  !'),self::HTTP_OK);exit;
        }
    }
    
    public function emergencycontact(){
        $this->_apiConfig([
            'methods' => ['POST'],
            //'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);  
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->alert_id) || !isset($post->alert_id) ){
            $this->api_return(array('status' =>false,'error' => 'Alert ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        $alert_id = $post->alert_id;
        $record    = $this->BaseModel->_run_query('select * from park_alerts_reached par left join park_alerts pa on pa.alert_id = par.alert_type_id left join park_customer pc on pc.customer_id = par.alert_customer_id where par.alert_id="'.$alert_id.'" limit 1');
        if($record->num_rows() <= 0){
            $this->api_return(array('status' =>false,'error' => 'Proof details is empty !'),self::HTTP_OK);exit;
        }  
        $single = $record->row(); 
        $return['customer_sos_number']  = "100";
        $return['customer_mobile']      = $single->customer_mobile;
        $return['customer_emr1_mobile'] = $single->customer_emr1_mobile;
        $return['customer_emr2_mobile'] = $single->customer_emr2_mobile;
        
        if($record->num_rows() <= 0){
            $this->api_return(array('status' =>false,'error' => 'Emergency Contact details is empty !'),self::HTTP_OK);exit;
        }
        $this->api_return(array('status' =>true,'error' => 'Contact details found !','data'=>$return),self::HTTP_OK);exit;
    }
    
    public function helpuploadproof(){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->customer_id) || !isset($post->customer_id) ){
            $this->api_return(array('status' =>false,'error' => 'Customer ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->proof_image) || !isset($post->proof_image) || !is_array($post->proof_image)){
            $this->api_return(array('status' =>false,'error' => 'Proof Image is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->registration_no) || !isset($post->registration_no) ){
            $this->api_return(array('status' =>false,'error' => 'Registration No is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->vehicle_id) || !isset($post->vehicle_id)){
           $this->api_return(array('status' =>false,'error' => 'Vehicle id is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        if(!empty($post->alert_type_id) && isset($post->alert_type_id) ){
            $data['alert_type_id']                  = $post->alert_type_id;
        }
        
        
        $vehicle_id = $post->vehicle_id;
        $record    = $this->BaseModel->_run_query('select * from park_vehicle pv left join park_customer pc on pc.customer_id = pv.veh_customer_id where veh_id="'.$vehicle_id.'" limit 1');
        if($record->num_rows() <= 0){
            $this->api_return(array('status' =>false,'error' => 'Vehicle Customer details is empty !'),self::HTTP_OK);exit;
        }
        $single = $record->row();
        
        $proof_image = $post->proof_image;
        $proof_array = array();
        $front_image = $this->BaseModel->_upload_Base64_image($proof_image[0]->front_image,$this->data['proofpath']);
        $back_image  = $this->BaseModel->_upload_Base64_image($proof_image[1]->back_image,$this->data['proofpath']);
        $left_image  = $this->BaseModel->_upload_Base64_image($proof_image[2]->left_image,$this->data['proofpath']); 
        $right_image = $this->BaseModel->_upload_Base64_image($proof_image[3]->right_image,$this->data['proofpath']);
        
        $proof_array = [
            array('front_image' =>$this->data['proofpath'].$front_image),
            array('back_image'  =>$this->data['proofpath'].$back_image),
            array('left_image'  =>$this->data['proofpath'].$left_image),
            array('right_image' =>$this->data['proofpath'].$right_image),
            ];
        
        $data['alert_customer_id']              = $single->customer_id;
        $data['alert_proof_image']              = json_encode($proof_array);
        $data['alert_create_at']                = date('Y-m-d H:i:s');
        $data['alert_type']                     = '0';
        $data['alert_customer_by']              = $post->customer_id;
        $data['alert_vehicle_id']               = $post->vehicle_id;
        $data['alert_vehicle_registration_no']  = $post->registration_no;
        $data['alert_status']                   = '0';
        $data['alert_status_history']           = json_encode([array('remark'=>'Proof Uploads','date'=>date('Y-m-d H:i:s'),'status'=>'0')]);
        $data['alert_job_status']               = '0';
        $data['alert_job_status_history']       = json_encode([array('remark'=>'Proof Uploads','date'=>date('Y-m-d H:i:s'),'status'=>'0')]);
        
        if($last = $this->BaseModel->_inser_query('park_alerts_reached',$data)){
            $this->api_return(array('status' =>true,'error' => 'Proof submitted !','alert_id'=>$last),self::HTTP_OK);exit;
        }else{
            $this->api_return(array('status' =>false,'error' =>'Oops! Something went wrong ! Help us improve your experience by sending an error report  !'),self::HTTP_OK);exit;
        }
    }
    
    public function helpmakepay(){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);  
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->alert_id) || !isset($post->alert_id) ){
            $this->api_return(array('status' =>false,'error' => 'Proof ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        $alert_id = $post->alert_id;
        $record    = $this->BaseModel->_run_query('select * from park_alerts_reached par left join park_alerts pa on pa.alert_id = par.alert_type_id where par.alert_id="'.$alert_id.'" limit 1');
        if($record->num_rows() <= 0){
            $this->api_return(array('status' =>false,'error' => 'Proof details is empty !'),self::HTTP_OK);exit;
        }
        $single = $record->row(); 
        $customer_id = $single->alert_customer_id;
        
        /*=================check payment for wallets start code===============*/
        $totalalerts  = $this->WalletsModel->_helping_alert_check_customer($customer_id);
        $is_alert     = 0;
        $is_wallet    = 0;
        /*if($totalalerts <= 0 ){
            $this->api_return(array('status' =>false,'error' => 'Your balance is exceeds !','is_alert'=>$is_alert,'is_wallet'=>$is_wallet,'total_wallet'=>$totalbalence,'total_alert'=>$totalalerts),self::HTTP_OK);exit;
        }
        if($totalalerts > 0){*/
            $alerts['alerts_customer_id'] = $customer_id;
            $alerts['alerts_count']       = 1;
            $alerts['alerts_type']        = '0';
            $alerts['alerts_create_at']   = date('Y-m-d H:i:s');
            $alerts['alerts_status']      = '1';
            $alerts['alerts_total_days']  =  0;
            $alerts['alerts_statement']   = '0';
            $alerts['alerts_description'] = "Alert sent !";
            $alerts['alerts_start_at']    = date('Y-m-d H:i:s');
            $alerts['alerts_stop_at']     = date('Y-m-d H:i:s');
            $this->BaseModel->_inser_query('park_customer_alerts',$alerts);
        /*}*/
        
        
        /*=================check payment for wallets close code===============*/
        $job_status       = array();
        $alert_status     = array();
        $alert_status = !empty($single->alert_status_history) ? json_decode($single->alert_status_history) : array();
        $job_status   = !empty($single->alert_job_status_history) ? json_decode($single->alert_job_status_history) : array();
        array_push($job_status,array('remark'=>'Alert send !','date'=>date('Y-m-d H:i:s'),'status'=>'1'));
        array_push($alert_status,array('remark'=>'Payemnt Complete !','date'=>date('Y-m-d H:i:s'),'status'=>'1'));
        
        $data['alert_status']                   = '1';
        $data['alert_status_history']           = json_encode($alert_status);
        $data['alert_job_status']               = '1';
        $data['alert_job_status_history']       = json_encode($job_status);
        
        if($this->BaseModel->_update_query('park_alerts_reached',$data,array('alert_id'=>$alert_id))){
            /*========================send alert by fcm========================*/
            //TO
            $tokens  = array($this->CustomerModel->_get_customer_single_column($customer_id,'customer_device_token'));
            $title   = $single->alert_text;
            $content = $single->alert_text;
            $image   = base_url($single->alert_proof_image);
            $this->_send_alert_by_fcm($tokens,$title,$content,$image,$customer_id);
            //From
            $tokens  = array($this->CustomerModel->_get_customer_single_column($single->alert_customer_by,'customer_device_token'));
            $title   = $single->alert_text;
            $content = $single->alert_text;
            $image   = base_url($single->alert_proof_image);
            $this->_send_alert_by_fcm($tokens,$title,$content,$image,$single->alert_customer_by);
            /*=================================================================*/
            /*========this code use after alert send get cashback ===========*/
            if(@$this->data['config']['help_alert_coin_back'] > 0){
                $coinsvalue = @$this->data['config']['help_alert_coin_back'];
                $this->WalletsModel->_add_alert_coins_wallet($customer_id ,$alert_id , $coinsvalue,"You Earn ".$coinsvalue." Coins For ".$title,'1');
            }
            
            
            $this->api_return(array('status' =>true,'error' => 'Alert have been successfully sent !','alert_id'=>$alert_id),self::HTTP_OK);exit;
        }else{
            $this->api_return(array('status' =>false,'error' =>'Oops! Something went wrong ! Help us improve your experience by sending an error report  !'),self::HTTP_OK);exit;
        }
    }
    
    public function againsttypewisealerts(){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);  
        $post = json_decode(file_get_contents('php://input'));
        if(!isset($post->alert_type) ){
            $this->api_return(array('status' =>false,'error' => 'Alert type is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->customer_id) || !isset($post->customer_id) ){
            $this->api_return(array('status' =>false,'error' => 'Customer ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        $alert_type  = $post->alert_type;
        $customer_id = $post->customer_id;
        $record    = $this->BaseModel->_run_query('select * from park_alerts_reached par where par.alert_type="'.$alert_type.'" and alert_customer_by="'.$customer_id.'" order by alert_id desc');
        
        if($record->result()){
            foreach($record->result() as $key => $data){
               $images = json_decode($data->alert_proof_image);
               $proof_array = [
                array('front_image' =>base_url().$images[0]->front_image),
                array('back_image'  =>base_url().$images[1]->back_image),
                array('left_image'  =>base_url().$images[2]->left_image),
                array('right_image' =>base_url().$images[3]->right_image),
                ];
            
               $record->result()[$key]->alert_proof_image = $proof_array;
            }
            $this->api_return(array('status' =>true,'error' => 'Alert data found !','data'=>$record->result()),self::HTTP_OK);exit;
        }else{
            $this->api_return(array('status' =>false,'error' =>'Alert data not found !'),self::HTTP_OK);exit;
        }
    }
    
    public function typewisealerts(){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);  
        $post = json_decode(file_get_contents('php://input'));
        if(!isset($post->alert_type) ){
            $this->api_return(array('status' =>false,'error' => 'Alert type is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->customer_id) || !isset($post->customer_id) ){
            $this->api_return(array('status' =>false,'error' => 'Customer ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        if(!isset($post->alert_favour_type) ){
            //alert_favour_type = 0 is favour
            ///alert_favour_type = 1 is against
            $this->api_return(array('status' =>false,'error' => 'Favour Type is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        $alert_type  = $post->alert_type;
        if($post->alert_favour_type == 1){
            $where = 'and par.alert_customer_id="'.$post->customer_id.'"';
        }else{
            $where = 'and par.alert_customer_by="'.$post->customer_id.'"';
        }
        
        
        $record    = $this->BaseModel->_run_query('select * from park_alerts_reached par where par.alert_type="'.$alert_type.'" '.$where.' order by alert_id desc');
        
        if($record->result()){
            foreach($record->result() as $key => $data){
               $images = json_decode($data->alert_proof_image);
               $proof_array = [
                array('front_image' =>base_url().$images[0]->front_image),
                array('back_image'  =>base_url().$images[1]->back_image),
                array('left_image'  =>base_url().$images[2]->left_image),
                array('right_image' =>base_url().$images[3]->right_image),
                ];
            
               $record->result()[$key]->alert_proof_image = $proof_array;
            }
            
            $this->api_return(array('status' =>true,'error' => 'Alert data found !','data'=>$record->result()),self::HTTP_OK);exit;
        }else{
            $this->api_return(array('status' =>false,'error' =>'Alert data not found !'),self::HTTP_OK);exit;
        }
    }
    
    public function details(){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);  
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->alert_id) || !isset($post->alert_id)){
            $this->api_return(array('status' =>false,'error' => 'Alert ID is empty Or missing !'),self::HTTP_OK);exit;
        } 
        $alert_id  = $post->alert_id;
        $record    = $this->BaseModel->_run_query('select COALESCE(pa.alert_text,"") as alert_text,par.*,alert_proof_image from park_alerts_reached par left join park_alerts pa on pa.alert_id = par.alert_type_id  where par.alert_id="'.$alert_id.'" limit 1');
       
        if($record->result()){
            
            foreach($record->result() as $key => $data){
               $images = json_decode($data->alert_proof_image);
               $proof_array = [
                array('front_image' =>base_url().$images[0]->front_image),
                array('back_image'  =>base_url().$images[1]->back_image),
                array('left_image'  =>base_url().$images[2]->left_image),
                array('right_image' =>base_url().$images[3]->right_image),
                ];
            
               $record->result()[$key]->alert_proof_image = $proof_array;
               $record->result()[$key]->single_image = base_url().$images[0]->front_image;
            }
            
            $result  = $record->row();
            
            $result->alert_text               = @strip_tags($result->alert_text);
            $result->alert_status_history     = @json_decode($result->alert_status_history);
            $result->alert_job_status_history = @json_decode($result->alert_job_status_history);
            
            $wallets = $this->WalletsModel->_get_alerts_wise_coins($alert_id,$result->alert_customer_id);
            $result->alert_coins = !empty($wallets->balence)? round($wallets->balence):'0';
            
            $this->api_return(array('status' =>true,'error' => 'Alert data found !','data'=>$result),self::HTTP_OK);exit;
        }else{
            $this->api_return(array('status' =>false,'error' =>'Alert data not found !'),self::HTTP_OK);exit;
        }
    }
    
    public function _send_alert_by_fcm($tokens,$title,$content,$image,$user_id){
        $data['notification_user_id']     =$user_id;
        $data['notification_title']       =$title;
        $data['notification_description'] =$content; 
        $data['notification_image']       =$image;
        $data['notification_create_at']   =date('Y-m-d H:i:s');
        $data['notification_status']      ="1";
        $this->BaseModel->_inser_query('notification',$data);
        $this->send_push_notification($tokens,strip_tags($title),strip_tags($content),$image);
    }
    
    
    public function request(){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);  
        $post = json_decode(file_get_contents('php://input'));
    }
    
    public function risedalert(){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);  
        $post = json_decode(file_get_contents('php://input'));
    }
    
}