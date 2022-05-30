<?php

/************************************************
 * This Model file has been created by           *   
 * Randheer  Singh                               *    
 * This Model is used to manipulate              *
 * the functionality in Admin Panel              *
 * Date -: 19/June/2020                          *           
 ************************************************
 */

Class Commonmodel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

   public function savedata($table,$args) {
  
	
       $this->db->insert($table, $args);
        $insert_id = $this->db->insert_id();
		return $insert_id;
		//return $this->db->last_query(); 
    } 
    
	public function getRow($table,$condition="",$orderby="",$limit='', $start='') {
		//echo $start; exit;
		if(empty($condition)){
			 $this->db->select("*")->from($table)->order_by($orderby);
			 if($limit){
			 	$this->db->limit($limit,$start);
			 }
			$query = $this->db->get();
			
		//return $this->db->last_query();
			if ($query->num_rows() > 0) {
				return $query->result_array();
			} else {
				return 0;
			}
		}else{
			$this->db->select("*")->from($table)->where($condition)->order_by($orderby);
			if($limit){
			 	$this->db->limit($limit,$start);
			 }
			$query = $this->db->get();
		//return $this->db->last_query();
		
		if ($query->num_rows() > 0) {
				return $query->result_array();
			} else {
				return 0;
			} 
		}	
    }
	
	public function count_data($table,$condition=""){
		$this->db->select("*")->from($table)->where($condition);
		$query = $this->db->get();
	  	if ($query->num_rows() > 0) {
			return $query->num_rows();
		} else {
			return 0;
		} 
	
	}
	
 	public function updateRow($table,$data,$condition) {
        $this->db->where($condition);
        $this->db->update($table,$data);
	//return $this->db->last_query();
         if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        } 
    }
	
	public function deleteRecord($table,$cond) {
        $this->db->where($cond);
        $this->db->delete($table);
       // echo $this->db->last_query();
        return True;
    }

    public function changeDeleteStatus($table,$cond) {
        $sql = "update $table set is_deleted = not is_deleted where $cond";
		$query = $this->db->query($sql);
		//echo $this->db->last_query();
	  	 if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        } 
    }
	
	public function changeStatus($table,$cond) {
        $sql = "update $table set status = not status where $cond";
        //echo $sql; exit;
		$query = $this->db->query($sql);
	  	 if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        } 
    }

    public function changeActiveToInactive($table,$cond) {
        $sql = "update $table set is_active = not is_active where $cond";
		$query = $this->db->query($sql);
	  	 if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        } 
    }

    public function calculateRating($condition) {
    	$sql = "SELECT sum(rating.rate) as total,count(rating.rating_id) as totalrow,AVG(rating.rate)as result FROM rating INNER JOIN apartment_room ON rating.property_id=apartment_room.prop_apart_id WHERE $condition";
    	//echo $sql; exit;
		$query = $this->db->query($sql);
	  	 if ($this->db->affected_rows() > 0) {
            return $query->result_array();
        } else {
            return 0;
        } 
    }

    public function changeAcStatus($table,$cond) {

    	$sql = "update $table set status ='0'";
        $sql1 = "update $table set status = not status where $cond";
        //echo $sql; exit;
		$query = $this->db->query($sql);
		$query1 = $this->db->query($sql1);
	
	  	 if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        } 
    }


    
    
	
}