<?php defined('BASEPATH') or exit('No direct script access allowed');
class PostconversationModel extends CI_Model{
    
    protected $table = "dk_tickets";
    
    public function __construct(){
        parent::__construct();
    }

    public function _get_ticket_support($customer_id){
        $this->db->select('dk_tickets.dk_tickets_id,dk_tickets.dk_post_id,dk_tickets.dk_post_type,dk_tickets.dk_unique_id,dk_tickets.dk_customer_id,dk_tickets.dk_post_customer_id,dk_tickets.dk_tickets_status,dk_tickets.dk_tickets_create_at,a.customer_full_name as sender_customer_name,b.customer_full_name as receiver_customer_name');
        $this->db->where('dk_customer_id',$customer_id);
        $this->db->join('dk_customer a','a.customer_id=dk_tickets.dk_customer_id','LEFT');
        $this->db->join('dk_customer b','b.customer_id=dk_tickets.dk_post_customer_id','LEFT');
       return $this->db->get($this->table);
    }
    
    public function _get_ticket_chat($ticket_id){
        $this->db->select("ticket_id,message,from_type,from_id,created_at");
        $this->db->from('dk_ticket_chat');
        $this->db->where('ticket_id',$ticket_id);
        $this->db->order_by('ticket_id','DESC');
        //$this->db->order_by('created_at','DESC');
        $query = $this->db->get();
        return $query;
    }
    
}
