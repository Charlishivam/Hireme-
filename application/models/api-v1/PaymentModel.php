<?php defined('BASEPATH') or exit('No direct script access allowed');
class PaymentModel extends CI_Model{
    
    protected $table = "park_wallets";
    
    public function __construct(){
        parent::__construct();
    }

    public function _payment_create($amount,$coin,$oderid,$remark){
        $data['pay_amount']         = $amount;
        $data['pay_coins']          = $coin;
        $data['pay_orderid']        = $oderid;
        $data['pay_status']         = '0';
        $data['pay_status_history'] = json_encode([array('remark'=>$remark,'date'=>date('Y-m-d H:i:s'),'status'=>'0')]);
        $data['pay_tax_rate']       = 0;
        $data['pay_tax_type']       = 0;
        $data['pay_discount_type']  = 0;
        $data['pay_discount_rate']  = 0;
        $data['pay_create_at']      = date('Y-m-d H:i:s');
        $data['pay_payment_method'] = '3';
        $this->BaseModel->_inser_query('park_payment_log',$data);
    }
    
    public function _return_booking_amount_or_coins($book_id,$customer_id){
        $this->db->select('*');
        $this->db->from('park_payment_log');
        $this->db->where('pay_orderid',$book_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $single = $query->row();

            $walets['wallets_amount']           = $single->pay_coins;
            $walets['wallet_customer_id']       = $customer_id;
            $walets['wallets_transaction_id']   = $book_id;
            $walets['wallets_transaction_type'] = '1';
            $walets['wallets_description']      = 'You have been refunded '.$walets['wallets_amount'].' coins of your booking cancelled !';
            $walets['wallets_type']             = '1';
            $walets['wallets_status']           = '1';
            $walets['wallets_create_at']        = date('Y-m-d H:i:s');
            $walets['wallets_update_at']        = date('Y-m-d H:i:s');
            $walets['wallets_scratched']        = '1';
            $this->db->insert($this->table,$walets);
            
            return true;
        }else{
            return false;
        }
    }
    
}
