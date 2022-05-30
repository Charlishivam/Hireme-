<?php
class Category_model extends CI_Model{
   
   	public function __construct()
	{
		parent::__construct();
	}

	//-----------------------------------------------------
	function get_all_category()
    {
        $this->db->select('*');
		$this->db->from('dk_category');
		$this->db->order_by('category_id','desc');
		$query = $this->db->get();
        return $query->result_array();
    }
   
}
?>