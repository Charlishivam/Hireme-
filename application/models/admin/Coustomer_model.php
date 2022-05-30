<?php
 defined('BASEPATH') OR exit('No direct script access allowed');

class Coustomer_model extends CI_Model{
    
    public function get_all_customer(){
       $this->db->select("*");
       $this->db->from('dk_customer');
       $this->db->order_by('customer_id','DESC');
       $result =  $this->db->get()->result_array();
       return $result;

    }
}
