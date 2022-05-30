<?php defined('BASEPATH') or exit('No direct script access allowed');
class CustomerModel extends CI_Model{
    
    protected $table = "park_customer";
    
    public function __construct(){
        parent::__construct();
    }
    
    public function _get_customer_single_column($customer_id,$select){
        $this->db->select($select);
        $this->db->from($this->table);
        $this->db->where('customer_id',$customer_id);
        $this->db->limit('1');
        $query = $this->db->get();
        if($query->num_rows() > 0){
             return $query->row()->$select; 
        }else{
            return null;    
        }
    }
    
}
