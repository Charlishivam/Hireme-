<?php defined('BASEPATH') or exit('No direct script access allowed');
class FaqModel extends CI_Model{
    
    protected $table = "park_knowedge";
    
    public function __construct(){
        parent::__construct();
    }

    public function _get_faq_records($offset=null,$count=null){
        $this->db->select('knowedge_id,knowedge_question,knowedge_answer,knowedge_heading,knowedge_title,knowedge_description,knowedge_create_at,knowedge_update_at,left(knowedge_answer,100) as knowedge_answer_home');
        $this->db->where('knowedge_status','1');
        
        if(!empty($offset) && !empty($count)){
            $this->db->limit($offset,$count);
        }
        $this->db->order_by('knowedge_id','desc');
        $this->db->order_by('knowedge_create_at','desc');
        $this->db->order_by('knowedge_update_at','desc');
       return $this->db->get($this->table);
    }
    
    public function _get_faq_records_by_id($id){
       $this->db->select('knowedge_id,knowedge_question,knowedge_answer,knowedge_heading,knowedge_title,knowedge_description,knowedge_create_at,knowedge_update_at');
        $this->db->where('knowedge_status','1');
        $this->db->where('knowedge_id',$id);
       return $this->db->get($this->table);
    }
    
}
