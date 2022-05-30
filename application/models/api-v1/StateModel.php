<?php defined('BASEPATH') or exit('No direct script access allowed');
class StateModel extends CI_Model{
    
    
    
    public function __construct(){
        parent::__construct();
    }
    
    public function _get_state_records(){
		$this->db->select('state_id,state_name,state_code,state_status');
		$this->db->from('dk_state');
		$this->db->where('state_status','1');
		$query = $this->db->get()->result_array();
        return $query;
    }
    
    public function _get_country_records(){
		$this->db->select('country_id,country_name,country_code,country_status');
		$this->db->from('dk_country');
		$this->db->where('country_status','1');
		$query = $this->db->get()->result_array();
        return $query;
    }
    
    public function _get_single_country_records($country_id){
		$this->db->select('country_id,country_name,country_code,country_status');
		$this->db->from('dk_country');
		$this->db->where('country_status','1');
		$this->db->where('country_id',$country_id);
		$query = $this->db->get()->row();
        return $query;
    }
    
    public function _get_single_state_records($state_id){
		$this->db->select('state_id,state_name,state_code,state_status');
		$this->db->from('dk_state');
		$this->db->where('state_status','1');
		$this->db->where('state_id',$state_id);
		$query = $this->db->get()->row();
        return $query;
    }
    
    public function _get_city_records($state_id){
		$this->db->select('city_id,city_name,city_state_id,city_status,state_name');
		$this->db->from('dk_city');
		$this->db->where('city_status','1');
		$this->db->where('dk_city.city_state_id',$state_id);
		$this->db->join('dk_state','dk_state.state_id=dk_city.city_state_id','LEFT');
		$query = $this->db->get()->result_array();
        return $query;
    }
    
    public function _get_locality_records($city_id){
		$this->db->select('dk_locality.locality_id,dk_locality.locality_name,dk_locality.locality_status,dk_city.city_name,dk_state.state_name');
		$this->db->from('dk_locality');
		$this->db->where('dk_locality.locality_status','1');
		$this->db->where('dk_locality.locality_city_id',$city_id);
		$this->db->join('dk_state','dk_state.state_id=dk_locality.locality_state_id','LEFT');
		$this->db->join('dk_city','dk_city.city_id=dk_locality.locality_city_id','LEFT');
		$query = $this->db->get()->result_array();
		 
        return $query;
    }
    
    
    
}
