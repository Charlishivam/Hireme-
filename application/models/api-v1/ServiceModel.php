<?php defined('BASEPATH') or exit('No direct script access allowed');
class ServiceModel extends CI_Model{
    
    public function __construct(){
        parent::__construct();
    }
      //create by vasit
    public function _get_service_records($customer_id){
		$this->db->select('dk_service.service_id,dk_service.service_title,dk_service.service_price,dk_service.service_delivery,dk_service.service_description,dk_service.service_features,dk_service.service_category,dk_service.service_subcategory,dk_service.service_status,dk_category.category_name,dk_subcategory.subcategory_name,dk_customer.customer_full_name,dk_service.customer_id,concat("'.base_url().'",dk_service.service_image) as service_image');
		$this->db->from('dk_service');
		$this->db->where('service_status','1');
		$this->db->where('dk_service.customer_id',$customer_id);
		$this->db->join('dk_category','dk_category.category_id=dk_service.service_category','LEFT');
		$this->db->join('dk_subcategory','dk_subcategory.subcategory_id=dk_service.service_subcategory','LEFT');
		$this->db->join('dk_customer','dk_customer.customer_id=dk_service.customer_id','LEFT');
		$query = $this->db->get();
        return $query;
    }
        //create by vasit
    public function _service_records(){
		$this->db->select('dk_service.service_id,dk_service.service_title,dk_service.service_price,dk_service.service_description,dk_service.service_delivery,dk_service.service_features,dk_service.service_category,dk_service.service_subcategory,dk_service.service_status,dk_category.category_name,dk_subcategory.subcategory_name,dk_customer.customer_full_name,dk_service.customer_id,concat("'.base_url().'",dk_service.service_image) as service_image');
		$this->db->from('dk_service');
		$this->db->where('service_status','1');
		$this->db->join('dk_category','dk_category.category_id=dk_service.service_category','LEFT');
		$this->db->join('dk_subcategory','dk_subcategory.subcategory_id=dk_service.service_subcategory','LEFT');
		$this->db->join('dk_customer','dk_customer.customer_id=dk_service.customer_id','LEFT');
		$query = $this->db->get();
        return $query;
    
    }
      //create by vasit
    public function _get_subcatidby_records($subcategory_id){
		$this->db->select('dk_service.service_id,dk_service.service_title,dk_service.service_price,dk_service.service_delivery,dk_service.service_description,dk_service.service_features,dk_service.service_category,dk_service.service_subcategory,dk_service.service_status,dk_category.category_name,dk_subcategory.subcategory_name,dk_customer.customer_full_name,dk_service.customer_id,concat("'.base_url().'",dk_service.service_image) as service_image');
		$this->db->from('dk_service');
		$this->db->where('dk_service.service_status','1');
		$this->db->where('dk_service.service_subcategory',$subcategory_id);
		$this->db->join('dk_category','dk_category.category_id=dk_service.service_category','LEFT');
		$this->db->join('dk_subcategory','dk_subcategory.subcategory_id=dk_service.service_subcategory','LEFT');
		$this->db->join('dk_customer','dk_customer.customer_id=dk_service.customer_id','LEFT');
		$query = $this->db->get(); 
		return $query;
    }
    
    // suerch service by title//  //create by vasit
    
    public function _search_by_keywords($keyword,$limit){
     	$this->db->select('dk_service.service_id,dk_service.service_title,dk_service.service_price,dk_service.service_description,dk_service.service_delivery,dk_service.service_features,dk_service.service_category,dk_service.service_subcategory,dk_service.service_status,dk_category.category_name,dk_subcategory.subcategory_name,dk_customer.customer_full_name,dk_service.customer_id,concat("'.base_url().'",dk_service.service_image) as service_image');
		$this->db->from('dk_service');
		$this->db->join('dk_category','dk_category.category_id=dk_service.service_category','LEFT');
		$this->db->join('dk_subcategory','dk_subcategory.subcategory_id=dk_service.service_subcategory','LEFT');
		$this->db->join('dk_customer','dk_customer.customer_id=dk_service.customer_id','LEFT');
		$this->db->where('dk_service.service_status','1');
		$this->db->like('dk_service.service_title',$keyword);
		if(empty($limit)){
		$this->db->order_by('dk_service.service_id','desc');
		}
		$this->db->limit($limit);
		$result = $this->db->get();
        return $result;
	}
    
    
    
       //create by vasit
    public function service_features_get(){
		$this->db->select('*');
        $this->db->from('dk_service_features');
		$query = $this->db->get()->result_array();
        return $query;
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
      //create by vasit
      public function delete_row($where,$tbl){
    	$this->db->where($where);
    	$this->db->delete($tbl);
	}
    
}   
    
    

