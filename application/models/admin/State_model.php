<?php
 defined('BASEPATH') OR exit('No direct script access allowed');

class State_model extends CI_Model{
    

    public function get_all_state(){
       $this->db->select("*");
       $this->db->from('dk_state');
       $this->db->order_by('state_id','DESC');
       $result =  $this->db->get()->result_array();
       return $result;

    }


    


    



   


}
