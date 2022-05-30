<?php
 defined('BASEPATH') OR exit('No direct script access allowed');

class Locality_model extends CI_Model{
    
    public function get_all_locality(){
       $this->db->select("*");
       $this->db->from('dk_locality');
       $this->db->join('dk_state','dk_state.state_id=dk_locality.locality_state_id','LEFT');
       $this->db->join('dk_city','dk_city.city_id=dk_locality.locality_city_id','LEFT');
       $this->db->order_by('locality_id','DESC');
       $result =  $this->db->get()->result_array();
       return $result;

    }

    public function all_city_by_state_id($state_id)
    {
        return $this->db->select("city_id,city_name")
            ->where('city_state_id', $state_id)
            ->get('dk_city')->result();
    }
}
