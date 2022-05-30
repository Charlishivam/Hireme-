<?php

defined('BASEPATH') or exit('No direct script access allowed');

class HelpSupport_model extends CI_Model{
    
    public function __construct(){
        parent::__construct();
        
    }

    //-----------------------------------------------------
    //not in use but keep it 
    function get_all_booking_query(){
        
$this->db->select('ticket_support.id,ticket_support.booking_id,dk_customer.customer_full_name as user,ticket_support.status');
        $this->db->from('ticket_support');
       
         $this->db->join('dk_customer','dk_customer.customer_id=ticket_support.user_id','LEFT');
       
       
        $this->db->order_by('ticket_support.id','DESC');
        $this->db->group_by('ticket_support.id');
        $query = $this->db->get()->result_array();
        return $query;
    }
    //update
    public function getAllQuery(){
        $this->db->select('ticket_support.*,dk_customer.*');
        $this->db->from('ticket_support');
        $this->db->order_by('ticket_support.id','DESC');
        $this->db->join('dk_customer','dk_customer.customer_id=ticket_support.user_id','LEFT');
        $query = $this->db->get()->result_array();
        return $query;
    }
    //-----------------------------------------------------
    
    public function getChat($id){
       $data=$this->session->userdata();
       $admin_id= $data['admin_id'];
       $arr=array(
           "admin_id"=>$admin_id,
           "status"=>1,
           "updated_at"=>date('Y-m-d h:i:s')
           );
       $this->db->where('id',$id);
       $this->db->update('ticket_support',$arr);
       $this->db->select('id,ticket_id,from_type,from_id,message, created_at');
       $this->db->from('ticket_chat');
       $this->db->where('ticket_id',$id);
       $this->db->where('from_type !=',2); //1for user,2 for vendor, 3 for admin,
       return $this->db->get()->result_array();
      
    }
    function get_booking_details($id){
        $this->db->where('booking_id', $id);
        $this->db->join('customer','book_rides.customer_id=customer.customer_id');
        //$this->db->join('products', 'products.product_id = order_items.food_id', 'left');
        $query = $this->db->get('order_items');
        return $query->result_array();
    }
    public function chatRepply($ticket_id,$message){
       $data=$this->session->userdata();
       $admin_id= $data['admin_id'];
       $chat_data=array(
                    "ticket_id"=>$ticket_id,
                    "from_type"=>3,
                    "from_id"=>$admin_id,
                    "message"=>$message,
                    "created_at"=>date('Y-m-d H:i:s')
                );
        $this->db->insert('ticket_chat',$chat_data);
        $this->db->select('id,ticket_id,from_type,from_id,message, created_at');
        $this->db->from('ticket_chat');
        $this->db->where('ticket_id',$ticket_id);
        $this->db->where('from_type !=',2); //1for user,2 for vendor, 3 for admin,
        return $this->db->get()->result_array();
            
    }

    

    public function _get_all_customer_records(){
        $this->db->select('customer_id,customer_first_name,customer_last_name,customer_mobile');
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
