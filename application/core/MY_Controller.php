<?php

class MY_Controller extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('admin/setting_model', 'setting_model');
        //general settings
        $global_data['general_settings'] = $this->setting_model->get_general_settings();
        $this->general_settings = $global_data['general_settings'];
        //set timezone
        date_default_timezone_set($this->general_settings['timezone']);
        //recaptcha status
        $global_data['recaptcha_status'] = true;
        if (empty($this->general_settings['recaptcha_site_key']) || empty($this->general_settings['recaptcha_secret_key'])) {

            $global_data['recaptcha_status'] = false;
        }
        $this->recaptcha_status = $global_data['recaptcha_status'];

    }
    //verify recaptcha
    public function recaptcha_verify_request(){
        if (!$this->recaptcha_status) {
            return true;
        }

        $this->load->library('recaptcha');
        $recaptcha = $this->input->post('g-recaptcha-response');
        if (!empty($recaptcha)) {
            $response = $this->recaptcha->verifyResponse($recaptcha);
            if (isset($response['success']) && $response['success'] === true) {
                return true;
            }
        }
        return false;
    }
    
    function _ganrate_referral($id,$pre_fix){
        $number = sprintf("%07d", $id);
        return $pre_fix.$number;
    } 
    
    function _ganrate_ticket($id,$pre_fix){
        $number = sprintf("%04d", $id);
        return $pre_fix.$number;
    } 
    
    function send_push_notification($senderids,$title,$description,$imgurl = null){
        //$serverkey = 'AAAAYXFXVU8:APA91bFInO0rBNefwGc27kpir0sKq4evlCAQiLqX0UQViLzl7HIKqUZXI4s4JUcmz4Q5HS39b2WCMT-o1R5rPFr_NORfdeOII6R_9f3Eokk0iRS6IgRb8qp5bVjd4LDf8BnuP_Hfecu2';// this is a Firebase server key 
        $serverkey = 'AAAAF3VEsPU:APA91bGhj1QxN9TW-p24f8yxnUC7FHD0xq043w81gi1y1weCqb21Nv35GZWiJoT-4InHM_lJOKBpVBL0D4kF67yKt1ouO_TWmH--QHS_axIB6CnFh0UALsQr6NTj5ooPWglPyLP35NQR';// this is a Firebase server key 
        $notification['body']  = $description;
        $notification['title'] = $title;
        
        if($imgurl  != null){
            $notification['image'] = $imgurl;
        }
        
        $data = array(
        			'registration_ids' => $senderids,
                     'notification' => 
                     		$notification,
                            "data"=> 
                            array(
                    		"click_action"=> "FLUTTER_NOTIFICATION_CLICK",
                            "sound"=> "default", 
                             "status"=> "done"
                             )
                            ); 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://fcm.googleapis.com/fcm/send");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));  //Post Fields
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: key='.$serverkey));
        $output = curl_exec ($ch);
        curl_close ($ch);
        
      // echo "<pre>"; print_r($output); echo "<pre>"; die(); 
        return $output;
    }
    
}


class MY_Api_Controller extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('api-v1/BaseModel','BaseModel');
        $this->load->model('api-v1/JobPostModel','JobPostModel');
        $this->load->model('api-v1/CategoryModel','CategoryModel');
        $this->load->model('api-v1/StateModel','StateModel');
        $this->load->model('api-v1/WalletsModel','WalletsModel');
        $this->load->model('api-v1/BlogsModel','BlogsModel');
        $this->load->model('api-v1/ReferralModel','ReferralModel');
        $this->load->model('api-v1/FaqModel','FaqModel');
        $this->load->model('api-v1/ContentModel','ContentModel');
        $this->load->model('api-v1/TestimonialModel','TestimonialModel');
        $this->load->model('api-v1/ServiceModel','ServiceModel');
        $this->load->model('api-v1/PostconversationModel','PostconversationModel');
        
        $this->data['config']  = $this->BaseModel->all_setting_data();
        
    }
    
    public function _create_auto_number($_pri = null,$_old=null){
        $_pri   = !empty($_pri) ? $_pri : 'ADI';
        $_make  = '';
        $_num   = 1;
        $_part  = !empty($_old) ? explode('/',$_old) : '';
        $_uniq  = !empty($_part[1])? $_part[1] : 'A';

        
        if(!empty($_part[3]) && $_part[3] >= 1000){
            $_uniq ++;
            $_num = 1;
        }

        $_num   = !empty($_part[3]) ? (int)@$_part[3] : $_num;
        $_num   = sprintf('%04d', $_num+1);
        $_make  = $_pri.'/'.$_uniq.'/'.date('Y').'/'.$_num;
        return $_make;
    }
    
    public function _send_sms($mobile,$message,$tmpid = null,$unicode = null){
      //Your authentication key
      $authKey = "331352AoMVj494DKn606e0134P1";
      //Multiple mobiles numbers separated by comma
      $mobileNumber =$mobile;
      //Sender ID,While using route4 sender id should be 6 characters long.
      $senderId = "DKRNTI";
      //Your message to send, Add URL encoding here.
      $message = urlencode($message);
      //Define route 
      $route = "4";
      //Prepare you post parameters
      $postData = array(
          'authkey'     => $authKey,
          'mobiles'     => $mobileNumber,
          'message'     => $message,
          'sender'      => $senderId,
          'route'       => $route,
          'DLT_TE_ID'   =>$tmpid
      );
      //API URL
      $url="https://api.msg91.com/api/v2/sendsms";

      // init the resource
      $ch = curl_init();
      curl_setopt_array($ch, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_POST => true,
          CURLOPT_POSTFIELDS => $postData
      ));
      //Ignore SSL certificate verification
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
      //get response
      $output = curl_exec($ch);
      curl_close($ch);
      return $output ;
    }
    
    function _ganrate_referral($id,$pre_fix){
        $number = sprintf("%03d", $id);
        return $pre_fix.$number;
    } 
    
    function send_push_notification($senderids,$title,$description,$imgurl = null){
        $serverkey = 'AAAAF3VEsPU:APA91bGhj1QxN9TW-p24f8yxnUC7FHD0xq043w81gi1y1weCqb21Nv35GZWiJoT-4InHM_lJOKBpVBL0D4kF67yKt1ouO_TWmH--QHS_axIB6CnFh0UALsQr6NTj5ooPWglPyLP35NQR';// this is a Firebase server key 
        
        $notification['body']  = $description;
        $notification['title'] = $title;
        
        if($imgurl  != null){
            $notification['image'] = $imgurl;
        }
        
        $data = array(
                    'registration_ids' => $senderids,
                     'notification' => 
                            $notification,
                            "data"=> 
                            array(
                            "click_action"=> "FLUTTER_NOTIFICATION_CLICK",
                            "sound"=> "default", 
                             "status"=> "done"
                             )
                            ); 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://fcm.googleapis.com/fcm/send");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));  //Post Fields
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: key='.$serverkey));
        $output = curl_exec ($ch);
        curl_close ($ch);
        return $output;
    }

}

    