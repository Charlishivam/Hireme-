<?php defined('BASEPATH') or exit('No direct script access allowed');
class ReferralModel extends CI_Model{
    
    protected $table = "park_customer";
    
    public function __construct(){
        parent::__construct();
    }
    
    public function _get_referral_code_by_id($id){
        $this->db->select('customer_id,customer_referral_code');
        $this->db->where('customer_id',$id);
        $this->db->limit(1);
       return $this->db->get($this->table);
    }
    
    public function _get_referral_code_by_code($code){
        $this->db->select('customer_id,customer_referral_code');
        $this->db->where('customer_referral_code',$code);
        $this->db->limit(1);
       return $this->db->get($this->table);
    }
    //referral by cash back coins referral person
    public function _cash_back_coin_other($code){
        $userdetails = $this->_get_referral_code_by_code($code)->row();
        $customer_id = $userdetails->customer_id;
        
        $data['wallets_amount']             = $this->data['config']['referral_cashback_coin_other'];
        $data['wallet_customer_id']         = $customer_id;
        $data['wallets_transaction_id']     = $code.'/'.date('Y/m/d');
        $data['wallets_transaction_type']   = '1';
        $data['wallets_description']        = 'You received '.$data['wallets_amount'].' coins for invite friend !';
        $data['wallets_type']               = '1';
        $data['wallets_status']             = '1';
        $data['wallets_create_at']          = date('Y-m-d H:i:s');
        
        $data['wallets_total_days']         = 90;
        $data['wallets_start_at']           = date('Y-m-d H:i:s');
        $data['wallets_stop_at']            = date('Y-m-d H:i:s',strtotime('90 days'));
        
        if($data['wallets_amount'] > 0){
            $this->BaseModel->_inser_query('park_wallets',$data);
            $this->_vehicle_buyer_inquiry_other($customer_id);
            $this->_reporting_alerts_other($customer_id);
        }
    }
    
    //referral by cash back coins referral use person
    public function _cash_back_coin_self($code,$customer_id){
        $data['wallets_amount']             = @$this->data['config']['referral_cashback_coin_self'];
        $data['wallet_customer_id']         = $customer_id;
        $data['wallets_transaction_id']     = $code.'/'.date('Y/m/d');
        $data['wallets_transaction_type']   = '1';
        $data['wallets_description']        = 'You received '.$data['wallets_amount'].' coins for first signup !';
        $data['wallets_type']               = '1';
        $data['wallets_status']             = '1';
        $data['wallets_create_at']          = date('Y-m-d H:i:s');
        
        $data['wallets_total_days']         = 90;
        $data['wallets_start_at']           = date('Y-m-d H:i:s');
        $data['wallets_stop_at']            = date('Y-m-d H:i:s',strtotime('90 days'));
        if($data['wallets_amount'] > 0){
            $this->BaseModel->_inser_query('park_wallets',$data);
            //This function use to Expiry and Renewals Alerts subscription
            $this->_vehicle_buyer_inquiry_self($customer_id);
            $this->_reporting_alerts_self($customer_id);
           
        }
    }
    //signup bonus 
    public function _signup_cash_back($customer_id){
        $data['wallets_amount']             = $this->data['config']['referral_cashback_coin_other'];
        $data['wallet_customer_id']         = $customer_id;
        $data['wallets_transaction_id']     = $customer_id.'/'.date('Y/m/d');
        $data['wallets_transaction_type']   = '1';
        $data['wallets_description']        = 'You received '.$data['wallets_amount'].' coins for first signup !';
        $data['wallets_type']               = '1';
        $data['wallets_status']             = '1';
        $data['wallets_create_at']          = date('Y-m-d H:i:s');
        
        $data['wallets_total_days']         = 30;
        $data['wallets_start_at']           = date('Y-m-d H:i:s');
        $data['wallets_stop_at']            = date('Y-m-d H:i:s',strtotime('90 days'));
        if($data['wallets_amount'] > 0){
            $this->BaseModel->_inser_query('park_wallets',$data);
        }
    }
    
    public function _vehicle_buyer_inquiry_self($customer_id){
        $old_plan = $this->db->select('*')->where('ce_customer_id',$customer_id)->where('ce_statement','1')->order_by('ce_id','desc')->limit('1')->get('park_customer_buyer_enquiry');
        $data['ce_start_at']    = date('Y-m-d H:i:s');
        $data['ce_stop_at']     = date('Y-m-d H:i:s',strtotime($this->data['config']['vehivle_buyer_inquiry_validity_self'].' days'));
        if($old_plan->num_rows() > 0){
            $single = $old_plan->row();
            $data['ce_start_at']    = date('Y-m-d H:i:s',strtotime($single->ce_stop_at));
            $data['ce_stop_at']     = date('Y-m-d H:i:s',strtotime($single->ce_stop_at.' + '.$this->data['config']['vehivle_buyer_inquiry_validity_self'].' days')); 
        }
        $data['ce_plan_alerts'] = $this->data['config']['vehivle_buyer_inquiry_count_self'];
        $data['ce_total_days']  = $this->data['config']['vehivle_buyer_inquiry_validity_self'];
        $data['ce_status']      = '1';
        $data['ce_customer_id'] = $customer_id;
        $data['ce_created_at']  = date('Y-m-d H:i:s');
        if($data['ce_plan_alerts'] > 0){
            $this->BaseModel->_inser_query('park_customer_buyer_enquiry',$data);
        }
    }
    
    public function _vehicle_buyer_inquiry_other($customer_id){
        $old_plan = $this->db->select('*')->where('ce_customer_id',$customer_id)->where('ce_statement','1')->order_by('ce_id','desc')->limit('1')->get('park_customer_buyer_enquiry');
        $data['ce_start_at']    = date('Y-m-d H:i:s');
        $data['ce_stop_at']     = date('Y-m-d H:i:s',strtotime($this->data['config']['vehivle_buyer_inquiry_validity_other'].' days'));
        if($old_plan->num_rows() > 0){
            $single = $old_plan->row();
            $data['ce_start_at']    = date('Y-m-d H:i:s',strtotime($single->ce_stop_at));
            $data['ce_stop_at']     = date('Y-m-d H:i:s',strtotime($single->ce_stop_at.' + '.$this->data['config']['vehivle_buyer_inquiry_validity_other'].' days')); 
        }
        $data['ce_plan_alerts'] = $this->data['config']['vehivle_buyer_inquiry_count_other'];
        $data['ce_total_days']  = $this->data['config']['vehivle_buyer_inquiry_validity_other'];
        $data['ce_status']      = '1';
        $data['ce_customer_id'] = $customer_id;
        $data['ce_created_at']  = date('Y-m-d H:i:s');
        if($data['ce_plan_alerts'] > 0){
            $this->BaseModel->_inser_query('park_customer_buyer_enquiry',$data);
        }
    }
    
    //
    public function _reporting_alerts_self($customer_id){
        $old_alert = $this->db->select('*')->where('alerts_customer_id',$customer_id)->where('alerts_statement','1')->where('alerts_type','1')->order_by('alerts_id','desc')->limit('1')->get('park_customer_alerts');
        $data['alerts_start_at']    = date('Y-m-d H:i:s');
        $data['alerts_stop_at']     = date('Y-m-d H:i:s',strtotime($this->data['config']['report_alert_validity_self'].' days'));
        if($old_alert->num_rows() > 0){
            $single = $old_alert->row();
            $data['alerts_start_at']    = date('Y-m-d H:i:s',strtotime($single->alerts_stop_at));
            $data['alerts_stop_at']     = date('Y-m-d H:i:s',strtotime($single->alerts_stop_at.' + '.$this->data['config']['report_alert_validity_self'].' days')); 
        }
        $data['alerts_count']       = $this->data['config']['report_alert_count_self'];
        $data['alerts_total_days']  = $this->data['config']['report_alert_validity_self'];
        $data['alerts_status']      = '1';
        $data['alerts_type']        = '1';
        $data['alerts_statement']   = '1';
        $data['alerts_customer_id'] = $customer_id;
        $data['alerts_create_at']   = date('Y-m-d H:i:s');
        if($data['alerts_count'] > 0){
            $this->BaseModel->_inser_query('park_customer_alerts',$data);
        }
    }
    //
    
    public function _reporting_alerts_other($customer_id){
        $old_alert = $this->db->select('*')->where('alerts_customer_id',$customer_id)->where('alerts_statement','1')->where('alerts_type','1')->order_by('alerts_id','desc')->limit('1')->get('park_customer_alerts');
        $data['alerts_start_at']    = date('Y-m-d H:i:s');
        $data['alerts_stop_at']     = date('Y-m-d H:i:s',strtotime($this->data['config']['report_alert_validity_other'].' days'));
        if($old_alert->num_rows() > 0){
            $single = $old_alert->row();
            $data['alerts_start_at']    = date('Y-m-d H:i:s',strtotime($single->alerts_stop_at));
            $data['alerts_stop_at']     = date('Y-m-d H:i:s',strtotime($single->alerts_stop_at.' + '.$this->data['config']['report_alert_validity_other'].' days')); 
        }
        $data['alerts_count']       = $this->data['config']['report_alert_count_other'];
        $data['alerts_total_days']  = $this->data['config']['report_alert_validity_other'];
        $data['alerts_status']      = '1';
        $data['alerts_type']        = '1';
        $data['alerts_statement']   = '1';
        $data['alerts_customer_id'] = $customer_id;
        $data['alerts_create_at']   = date('Y-m-d H:i:s');
        if($data['alerts_count'] > 0){
            $this->BaseModel->_inser_query('park_customer_alerts',$data);
        }
    }
    //use for self 
    public function _expiry_and_renewals_alerts_subscription_self($customer_id){
       $old_alert = $this->db->select('*')->where('alerts_customer_id',$customer_id)->where('alerts_statement','1')->where('alerts_type','2')->order_by('alerts_id','desc')->limit('1')->get('park_customer_alerts');
        $data['alerts_start_at']    = date('Y-m-d H:i:s');
        $data['alerts_stop_at']     = date('Y-m-d H:i:s',strtotime($this->data['config']['alert_subcription_validity_self'].' days'));
        if($old_alert->num_rows() > 0){
            $single = $old_alert->row();
            $data['alerts_start_at']    = date('Y-m-d H:i:s',strtotime($single->alerts_stop_at));
            $data['alerts_stop_at']     = date('Y-m-d H:i:s',strtotime($single->alerts_stop_at.' + '.$this->data['config']['alert_subcription_validity_self'].' days')); 
        }
        $data['alerts_total_days']  = $this->data['config']['alert_subcription_validity_self'];
        $data['alerts_status']      = '1';
        $data['alerts_type']        = '2';
        $data['alerts_statement']   = '1';
        $data['alerts_customer_id'] = $customer_id;
        $data['alerts_create_at']   = date('Y-m-d H:i:s');
        if($data['alerts_total_days'] > 0){
            $this->BaseModel->_inser_query('park_customer_alerts',$data);
        }
    }
    
    //use for other mens referral by 
    public function _expiry_and_renewals_alerts_subscription_other($customer_id){
        $old_alert = $this->db->select('*')->where('alerts_customer_id',$customer_id)->where('alerts_statement','1')->where('alerts_type','2')->order_by('alerts_id','desc')->limit('1')->get('park_customer_alerts');
        $data['alerts_start_at']    = date('Y-m-d H:i:s');
        $data['alerts_stop_at']     = date('Y-m-d H:i:s',strtotime($this->data['config']['alert_subcription_validity_other'].' days'));
        if($old_alert->num_rows() > 0){
            $single = $old_alert->row();
            $data['alerts_start_at']    = date('Y-m-d H:i:s',strtotime($single->alerts_stop_at));
            $data['alerts_stop_at']     = date('Y-m-d H:i:s',strtotime($single->alerts_stop_at.' + '.$this->data['config']['alert_subcription_validity_other'].' days')); 
        }
        $data['alerts_total_days']  = $this->data['config']['alert_subcription_validity_other'];
        $data['alerts_status']      = '1';
        $data['alerts_type']        = '2';
        $data['alerts_statement']   = '1';
        $data['alerts_customer_id'] = $customer_id;
        $data['alerts_create_at']   = date('Y-m-d H:i:s');
        if($data['alerts_total_days'] > 0){
            $this->BaseModel->_inser_query('park_customer_alerts',$data);
        }
    }
    
    
    public function _get_partner_list($customer_referred){
        $this->db->select('customer_id,customer_fullname,customer_create_at');
        $this->db->where('customer_referred_by',$customer_referred);
       return $this->db->get($this->table);
    }
}
