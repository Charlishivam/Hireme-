<?php
class Setting_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//-----------------------------------------------------
	public function update_general_setting($data){
		$this->db->where('id', 1);
		$this->db->update('ci_general_settings', $data);
		return true;

	}

	//-----------------------------------------------------
	public function get_general_settings(){
		$this->db->where('id', 1);
        $query = $this->db->get('ci_general_settings');
        return $query->row_array();
	}



	public function getAllsetting()
  {

  	$this->db->select('setting.*,vehicle.vehicle_name');
		$this->db->from('setting');
		$this->db->join('vehicle','setting.setting_key=vehicle.id','LEFT');
		$query = $this->db->get();
        return $query->result_array();

  
  }
  public function addsetting($data)
  {
    return $this->db->insert('setting',$data);
  }
  public function change_status($id,$status)
  {

    $this->db->set('setting_status', $status);
    $this->db->where('setting_id', $id);
    $this->db->update('setting');
  }
  public function fetchById($id)
  {
    $this->db->where('setting_id',$id);
    $res=$this->db->get('setting');
    return $res->row_array();

  }
  public function updatesetting($id,$data)
  {
    $this->db->where('setting_id',$id);
    $res=$this->db->update('setting',$data);
    return $res;
  }
  public function deletesetting($id)
  {
    $this->db->where('id',$id);
    $res=$this->db->delete('setting');
    return $res;
  }


  public function _get_all_vehicle_list()
    {
        $this->db->select('id,vehicle_name');

        $query =  $this->db->get('vehicle');

        $data[''] ='Select Vehicle Name';

        foreach ($query->result_array() as $row) {
            $data[$row['id']] = $row['vehicle_name'];
        }
        return $data;
    }
}

	

?>