<?php
class Testimonial_model extends CI_Model{
   
   	public function __construct()
	{
		parent::__construct();
	}

	//-----------------------------------------------------
	function get_all_testimonial()
    {
        $this->db->select('*');
		$this->db->from('dk_testimonial');
		$this->db->order_by('testimonial_id','desc');
		$query = $this->db->get();
        return $query->result_array();
    }
   
}
?>