<?php defined('BASEPATH') or exit('No direct script access allowed');
class CategoryModel extends CI_Model{
    
    
    
    public function __construct(){
        parent::__construct();
    }
    
    public function _get_category_records(){
		$this->db->select('category_id,category_name,category_slug,category_status,concat("'.base_url().'",category_image) as category_image');
		$this->db->from('dk_category');
		$this->db->where('category_status','1');
		$query = $this->db->get()->result_array();
        return $query;
    }
    
    public function _get_subcategory_records($category_id){
		$this->db->select('subcategory_id,subcategory_name,subcategory_slug,subcategory_status,concat("'.base_url().'",subcategory_image) as subcategory_image,category_name');
		$this->db->from('dk_subcategory');
		$this->db->where('subcategory_status','1');
		$this->db->where('dk_subcategory.category_id',$category_id);
		$this->db->join('dk_category','dk_category.category_id=dk_subcategory.category_id','LEFT');
		$query = $this->db->get()->result_array();
        return $query;
    }
    
    
    
}
