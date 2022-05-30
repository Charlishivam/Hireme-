<?php defined('BASEPATH') or exit('No direct script access allowed');
class ContentModel extends CI_Model{
    
    protected $table = "dk_content";
    
    public function __construct(){
        parent::__construct();
    }

    public function _get_content_records($offset=null,$count=null){
        $this->db->select('content_id,content_title,content_description,content_slug,content_create_at,content_update_at,concat("'.base_url('/uploads/content/').'",content_image) as content_image');
        $this->db->where('content_status','1');
        
        if(!empty($offset) && !empty($count)){
            $this->db->limit($offset,$count);
        }
        $this->db->order_by('content_id','desc');
        $this->db->order_by('content_create_at','desc');
        $this->db->order_by('content_update_at','desc');
        return $this->db->get($this->table);
    }
    
    public function _get_content_records_by_id($id){
        $this->db->select('content_id,content_title,content_description,content_slug,content_create_at,content_update_at,concat("'.base_url("/uploads/content/").'",content_image) as content_image');
        $this->db->where('content_status','1');
        $this->db->where('content_id',$id);
       return $this->db->get($this->table);
    }
    
}
