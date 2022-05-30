<?php
 defined('BASEPATH') OR exit('No direct script access allowed');

class Participant_model extends CI_Model{
    
    public function get_all_participant(){
       $this->db->select("*");
       $this->db->from('idol_participant');
       $this->db->where('user_type','1');
       $this->db->order_by('participant_id','DESC');
       $result =  $this->db->get()->result_array();
       return $result;

    }
}
