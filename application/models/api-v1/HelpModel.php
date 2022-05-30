<?php defined('BASEPATH') or exit('No direct script access allowed');
class PostconversationModel extends CI_Model{
    
    protected $table = "ticket_support";
    
    public function __construct(){
        parent::__construct();
    }

    public function _get_ticket_support($customer_id){
        $this->db->select('ticket_support.id,ticket_support.unique_id,ticket_support.type,ticket_support.user_id,ticket_support.admin_id,ticket_support.status,park_customer.customer_fullname');
        $this->db->where('user_id',$customer_id);
        $this->db->join('park_customer','park_customer.customer_id=ticket_support.user_id','LEFT');
       return $this->db->get($this->table);
    }
    
    public function _get_ticket_chat($ticket_id){
        $this->db->select("ticket_id,message,from_type,from_id,created_at");
        $this->db->from('ticket_chat');
        $this->db->where('ticket_id',$ticket_id);
        $this->db->order_by('ticket_id','DESC');
        //$this->db->order_by('created_at','DESC');
        $query = $this->db->get();
        return $query;
    }
    
}
