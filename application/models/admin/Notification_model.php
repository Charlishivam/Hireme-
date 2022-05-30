<?php
class Notification_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
  }

   public function get_all_notification($limit){
       $this->db->select("*");
       $this->db->from('dk_notification');
       if(!empty($this->input->get('keyword'))){
            $this->db->or_like('notification_id',$this->input->get('keyword'));
            $this->db->or_like('notification_title',$this->input->get('keyword'));
            $this->db->or_like('notification_description',$this->input->get('keyword'));
        }
        if($this->input->get('per_page') && $limit == true){
            $this->db->limit( $this->input->get('limit_per_page'),$this->input->get('per_page'));
        }else{
          $this->db->limit($this->input->get('limit_per_page'));
        }
        $this->db->order_by('dk_notification.notification_id','DESC');
        $result = $this->db->get()->result_array();
        return $result;

    }


 public function get_normal_customer_token($id){

        $this->db->select('customer_device_token');
        $this->db->where('customer_id in ('.$id.')');
        $this->db->where('customer_device_token is NOT NULL', NULL, FALSE);
        $this->db->where('customer_type','0');
        $this->db->from('dk_customer');
        $query=$this->db->get();
        return $query->result_array();

      
 }

 public function get_service_customer_token($id){
        $this->db->select('customer_device_token');
        $this->db->where('customer_id in ('.$id.')');
        $this->db->where('customer_device_token is NOT NULL', NULL, FALSE);
        $this->db->where('customer_type','1');
        $this->db->from('dk_customer');
        $query=$this->db->get();
        return $query->result_array();


     
      
 }


     public function _get_all_normal_customer_records(){
        $this->db->select('customer_id,customer_first_name,customer_last_name,customer_mobile');
        $this->db->where('customer_type','0');
        $query =  $this->db->get('dk_customer');
        foreach ($query->result_array() as $row) {
            if($row['customer_first_name']){
                $data[$row['customer_id']] = $row['customer_first_name'].' '.$row['customer_last_name'].'('.$row['customer_mobile'].')';

            }else{
                $data[$row['customer_id']] = $row['customer_mobile'];
            }
           
        }
        return $data;
    }

    public function _get_all_service_customer_records(){
        $this->db->select('customer_id,customer_first_name,customer_last_name,customer_mobile');
        $this->db->where('customer_type','1');
        $query =  $this->db->get('dk_customer');
        foreach ($query->result_array() as $row) {
            if($row['customer_first_name']){
                $data[$row['customer_id']] = $row['customer_first_name'].' '.$row['customer_last_name'].'('.$row['customer_mobile'].')';

            }else{
                $data[$row['customer_id']] = $row['customer_mobile'];
            }
           
        }
        return $data;
    }






   

}
