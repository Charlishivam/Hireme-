<?php
class Cronjob extends CI_Controller{

	public function __construct(){
        parent::__construct();
        
	}
	
	public function vendor_block_temp(){
	    date_default_timezone_set("Asia/Kolkata");
	    $this->data['todayworking'] = $this->db->select('*')->group_by('created_at')->get('vendors_schedule')->result();
	    
    	$this->db->update('vendor',array('is_blocked'=>'1','blocked_at'=>date('Y-m-d H:i:s'),'block_duration'=>'12'));
	    
	    foreach($this->data['todayworking'] as $key => $data){
	        $pats  = new DateTime($data->created_at);
            $today = new DateTime(date('Y-m-d'));
            $diffrence = $pats->diff($today)->format("%a"); //3
            if($diffrence < 3){ //under 2 days is not blocked
                $this->db->where('id',$data->vendor_id)->update('vendor',array('is_blocked'=>'0','blocked_at'=>null,'block_duration'=>null));
            }
	    }
	}
}
