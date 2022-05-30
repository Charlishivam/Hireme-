<?php
class Banner_model extends CI_Model{
   
   	public function __construct()
	{
		parent::__construct();
	}

	//-----------------------------------------------------
	function get_all_banner()
    {
        $this->db->select('*');
		$this->db->from('dk_banner');
		$this->db->order_by('banner_id','desc');
		$query = $this->db->get();
        return $query->result_array();
    }
   
}
?>