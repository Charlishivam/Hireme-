<?php
class Content_model extends CI_Model{
   
   	public function __construct()
	{
		parent::__construct();
	}

	//-----------------------------------------------------
	function get_all_content()
    {
        $this->db->select('*');
		$this->db->from('dk_content');
		$query = $this->db->get();
        return $query->result_array();
    }

    //-----------------------------------------------------
	function add_content($data)
    {
		$this->db->insert('dk_content', $data);
		return true;
    }

    //---------------------------------------------------
	// Edit Module
	public function edit_content($data, $id){
		$this->db->where('content_id', $id);
		$this->db->update('dk_content', $data);
		return true;
	}

	//-----------------------------------------------------
	function delete_content($id)
	{		
		$this->db->where('content_id',$id);
		$this->db->delete('dk_content');
	} 

	//-----------------------------------------------------
	function get_content_by_id($id)
    {
		$this->db->from('dk_content');
		$this->db->where('content_id',$id);
		$query=$this->db->get();
		return $query->row_array();
    }

	//-----------------------------------------------------
	function change_status()
	{		
		$this->db->set('content_status',$this->input->post('content_status'));
		$this->db->where('content_id',$this->input->post('content_id'));
		$this->db->update('dk_content');
	} 
	
	
	function all_content_categories()
    {
		$this->db->from('dk_content');
		$query = $this->db->get();
        return $query->result_array();
    }
    
}
?>