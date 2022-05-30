<?php
class Subcategory_model extends CI_Model{
   
   	public function __construct()
	{
		parent::__construct();
	}

	//-----------------------------------------------------
	function get_all_subcategory()
    {
        $this->db->select('*');
		$this->db->from('dk_subcategory');
		$this->db->join('dk_category','dk_category.category_id =dk_subcategory.category_id','LEFT');
		$this->db->order_by('subcategory_id','desc');
		$query = $this->db->get();
        return $query->result_array();
    }
   
}
?>