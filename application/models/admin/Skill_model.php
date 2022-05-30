<?php
class Skill_model extends CI_Model{
   
   	public function __construct()
	{
		parent::__construct();
	}

	//-----------------------------------------------------
	function get_all_skill()
    {
        $this->db->select('*');
		$this->db->from('dk_skill');
		$this->db->order_by('skill_id','desc');
		$query = $this->db->get();
        return $query->result_array();
    }
   
}
?>