<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'libraries/api-libraries/API_Controller.php'; // for load

class Payment extends API_Controller {

    public function __construct() {
        parent::__construct();
    }
    
    public function update(){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->bookingid) || !isset($post->bookingid)){
            $this->api_return(array('status' =>false,'error' => 'Booking ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        if(empty($this->data['config']['parking_commission'])){
            $this->api_return(array('status' =>false,'error' => 'Commission configration Error please check !'),self::HTTP_OK);exit;
        }
       
        
        $bookingid = $post->bookingid;
        
        $payment = $this->BaseModel->_run_query("select * from park_payment_log left join park_booking on park_booking.book_booking_id = park_payment_log.pay_orderid  where pay_orderid='".$bookingid."' limit 1 ");
        if($payment->num_rows() <= 0 ){
            $this->api_return(array('status' =>false,'error' => 'Payment details is not found !'),self::HTTP_OK);exit;
        }
        
        $commission  = (float)$this->data['config']['parking_commission'];
        $single      = $payment->row();
        $oldstatus   = !empty($single->pay_status_history) ? json_decode($single->pay_status_history,true) : array();
        $status['remark'] = "Payment complete !";
        $status['date']   = date('Y-m-d H:i:s');
        $status['status'] = '1';
        array_push($oldstatus,$status);
        if(!empty($post->taxn_id) && isset($post->taxn_id)){
            $data['pay_txn_id']         = '1';
        }
        $data['pay_upadte_at']      = date('Y-m-d H:i:s');
        $data['pay_status_history'] = json_encode($oldstatus);
        $data['pay_status']         = '1';
        
        
        
        $amounts = $single->pay_coins;
        /*====================use wallet amount ====================*/
        if(@$single->pay_payment_method == 3){
            //_use_wallet('customer_id','booking_id','coins','description','type');
            $description = 'Wallet deduct '.$single->pay_coins.' coin used parking booked !';
            $this->WalletsModel->_use_wallet($single->book_customer_id,$single->book_booking_id,$amounts,$description,'2');
            $amounts  = $this->_canvert_coin_to_cash($amounts);
        }
        /*====================use wallet amount ====================*/
        /*====================commiition and transfer amount ===================*/
        $totalcommition = $amounts/100*$commission;
        $aftercommition = $amounts-$totalcommition;
        
        $data['pay_after_commission']   = $aftercommition;
        $data['pay_commission']         = $commission;
        
        $description = "You received Rs.".round($aftercommition,2)." rupees from parking booking ";
        $this->WalletsModel->_transfer_amount_wallet($single->book_customer_id,$single->book_booking_id,$amounts,$description,'1',$commission,$aftercommition);
        /*====================commiition and transfer amount ===================*/
        
        if($this->BaseModel->_update_query('park_payment_log',$data,array('pay_orderid'=>$bookingid))){
            $this->api_return(array('status' =>true,'error' => 'Parking place payment done !','bookingid'=>$bookingid),self::HTTP_OK);exit;
        }
        $this->api_return(array('status' =>false,'error' => 'Oops! Something went wrong ! Help us improve your experience by sending an error report  !'),self::HTTP_OK);exit;
    }
}
