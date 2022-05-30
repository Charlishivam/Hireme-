<?php
 defined('BASEPATH') OR exit('No direct script access allowed');

class Service_model extends CI_Model{
    
    public function get_all_service(){
       $this->db->select("*");
       $this->db->from('dk_service');  
       $this->db->join('dk_customer','dk_customer.customer_id=dk_service.customer_id','LEFT');
       $this->db->join('dk_category','dk_category.category_id=dk_service.service_category','LEFT');
       $this->db->join('dk_subcategory','dk_subcategory.subcategory_id=dk_service.service_subcategory','LEFT');
       $this->db->order_by('service_id','DESC');
       $result =  $this->db->get()->result_array();
       return $result;

    }

}
