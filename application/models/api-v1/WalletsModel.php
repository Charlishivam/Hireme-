<?php defined('BASEPATH') or exit('No direct script access allowed');
class WalletsModel extends CI_Model{
    
    protected $table = "park_wallets";
    
    public function __construct(){
        parent::__construct();
    }

    public function _get_total_wallet_amount($cid){
        $this->db->select('sum(case when wallets_transaction_type="1" then wallets_amount else -wallets_amount end) as balence');
        $this->db->where('wallets_status','1');
        $this->db->where('wallet_customer_id',$cid);
       return $this->db->get($this->table);
    }
    
    public function _get_total_wallet_coins_back_amount($cid){
        $this->db->select('sum(case when wallets_transaction_type="1" then wallets_amount else -wallets_amount end) as balence');
        $this->db->where('wallets_status','1');
        $this->db->where('wallets_plan_id is null');
        $this->db->where('wallet_customer_id',$cid);
        return $this->db->get($this->table);
    }
    
    public function _get_total_wallet_amount_active_date($cid){
        $this->db->select('sum(case when wallets_transaction_type="1" then wallets_amount else -wallets_amount end) as balence');
        $this->db->where('wallets_status','1');
        $this->db->where('wallet_customer_id',$cid);
        $this->db->where('date(wallets_start_at) >=',date('Y-m-d'));
        $query = $this->db->get($this->table)->row();
        if($query->balence > 0){
            return $query->balence ; 
        }else{
            return 0;
        }
    }
    
    public function _alert_check_customer($cid){
        $this->db->select('sum(case when alerts_statement="1" then alerts_count else -alerts_count end) as alerts');
        $this->db->where('alerts_status','1');
        $this->db->where('alerts_type','1');
        $this->db->where('alerts_customer_id',$cid);
        $this->db->where('date(alerts_start_at) >=',date('Y-m-d'));
        $query = $this->db->get('park_customer_alerts')->row();
        //print_r($this->db->last_query());exit;
        if($query->alerts > 0){
            return $query->alerts ; 
        }else{
            return 0;
        }
    }
    
    public function _helping_alert_check_customer($cid){
        $this->db->select('sum(case when alerts_statement="1" then alerts_count else -alerts_count end) as alerts');
        $this->db->where('alerts_status','1');
        $this->db->where('alerts_type','0');
        $this->db->where('alerts_customer_id',$cid);
        $this->db->where('date(alerts_start_at) >=',date('Y-m-d'));
        $query = $this->db->get('park_customer_alerts')->row();
        //print_r($this->db->last_query());exit;
        if($query->alerts > 0){
            return $query->alerts ; 
        }else{
            return 0;
        }
    }
    
    public function _get_wallet_history($cid,$offset=null,$count=null){
        $this->db->select('*');
        $this->db->where('wallets_status','1');
        $this->db->where('wallet_customer_id',$cid);
        if(!empty($offset) && !empty($count)){
            $this->db->limit($offset,$count);
        }
        $this->db->order_by('wallets_id','desc');
        $this->db->order_by('wallets_create_at','desc');
        $this->db->order_by('wallets_update_at','desc');
       return $this->db->get($this->table);
    }
    
    public function _use_wallet($customer_id ,$booking_id , $coins,$descriotion,$type){
        $data['wallets_amount']             = $coins;
        $data['wallet_customer_id']         = $customer_id;
        $data['wallets_transaction_id']     = $booking_id;
        $data['wallets_transaction_type']   = $type;
        $data['wallets_description']        = $descriotion;
        $data['wallets_date_time']          = date('Y-m-d');
        $data['wallets_start_at']           = date('Y-m-d H:i:s');
        $data['wallets_stop_at']            = date('Y-m-d H:i:s');
        $data['wallets_status']             = '1';
        $data['wallets_create_at']          = date('Y-m-d H:i:s');
        $data['wallets_update_at']          = date('Y-m-d H:i:s');
        $data['wallets_type']               = '1';
        $data['wallets_scratched']          = '1';
        $this->BaseModel->_inser_query($this->table,$data);
    }
    public function _add_alert_coins_wallet($customer_id ,$alert_id , $coins,$descriotion,$type){
        $data['wallets_amount']             = $coins;
        $data['wallet_customer_id']         = $customer_id;
        $data['wallets_transaction_id']     = $alert_id;
        $data['wallets_transaction_type']   = $type;
        $data['wallets_description']        = $descriotion;
        $data['wallets_date_time']          = date('Y-m-d');
        $data['wallets_start_at']           = date('Y-m-d H:i:s');
        $data['wallets_stop_at']            = date('Y-m-d H:i:s');
        $data['wallets_status']             = '1';
        $data['wallets_create_at']          = date('Y-m-d H:i:s');
        $data['wallets_update_at']          = date('Y-m-d H:i:s');
        $data['wallets_type']               = '1';
        $data['wallets_scratched']          = '1';
        $data['wallets_alerts_id']          = $alert_id;
        $this->BaseModel->_inser_query($this->table,$data);
    }
    public function _transfer_amount_wallet($customer_id,$booking_id,$amounts,$descriotion,$type,$commission,$aftercommition){
        $data['wallets_amount']             = $amounts;
        $data['wallet_customer_id']         = $customer_id;
        $data['wallets_transaction_id']     = $booking_id;
        $data['wallets_transaction_type']   = $type;
        $data['wallets_description']        = $descriotion;
        $data['wallets_date_time']          = date('Y-m-d');
        $data['wallets_status']             = '1';
        $data['wallets_create_at']          = date('Y-m-d H:i:s');
        $data['wallets_update_at']          = date('Y-m-d H:i:s');
        $data['wallets_type']               = '1';
        $data['wallets_commission']         = $commission;
        $data['wallet_after_commission']    = $aftercommition;
        $this->BaseModel->_inser_query('park_real_money_wallets',$data);
    }
    
    public function raised_by_you($cid){
        $this->db->select('*');
        $this->db->where('alert_customer_by',$cid);
        return $this->db->get('park_alerts_reached');
    }
    
    public function raised_against_you($cid){
        $this->db->select('*');
        $this->db->where('alert_customer_id',$cid);
        return $this->db->get('park_alerts_reached');
    }
    
    public function _get_total_rewards_amount($cid,$referral_code){
        $this->db->select('sum(case when wallets_transaction_type="1" then wallets_amount else -wallets_amount end) as balence');
        $this->db->where('wallets_status','1');
        $this->db->where('wallet_customer_id',$cid);
        $this->db->where('wallets_referral_code',$cid);
       return $this->db->get($this->table);
    }
    public function _get_total_rewards_count($cid,$referral_code){
        $this->db->select('count(*) as count');
        $this->db->where('wallets_status','1');
        $this->db->where('wallet_customer_id',$cid);
        $this->db->where('wallets_referral_code',$cid);
       return $this->db->get($this->table);
    }
    
    public function _get_alerts_wise_coins($alert_id,$cid){
        $this->db->select('sum(case when wallets_transaction_type="1" then wallets_amount else -wallets_amount end) as balence');
        $this->db->where('wallets_status','1');
        $this->db->where('wallet_customer_id',$cid);
        $this->db->where('wallets_alerts_id',$alert_id);
       return $this->db->get($this->table);
    }
}
