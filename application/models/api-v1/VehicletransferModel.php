<?php defined('BASEPATH') or exit('No direct script access allowed');
class VehicletransferModel extends CI_Model{
    
    protected $table = "park_customer";
    
    public function __construct(){
        parent::__construct();
    }
    
  
    public function _get_all_customer_records($customer_id){
       $this->db->select('customer_id,customer_fullname');
       $this->db->from('park_customer');
       $this->db->where("customer_id <>",$customer_id);
       $result =  $this->db->get()->result_array();
       return $result;
    }
}