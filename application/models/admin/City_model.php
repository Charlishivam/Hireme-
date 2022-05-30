<?php
 defined('BASEPATH') OR exit('No direct script access allowed');

class City_model extends CI_Model{
    
    public function get_all_city(){
       $this->db->select("*");
       $this->db->from('dk_city');
       $this->db->join('dk_state','dk_state.state_id=dk_city.city_state_id','LEFT');
       $this->db->order_by('city_id','DESC');
       $result =  $this->db->get()->result_array();
       return $result;

    }
}
