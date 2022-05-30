<?php defined('BASEPATH') or exit('No direct script access allowed');
class TestimonialModel extends CI_Model{
    
    protected $table = "park_testimonial";
    
    public function __construct(){
        parent::__construct();
    }

    public function _get_testimonial_records($offset=null,$count=null){
        $this->db->select('testimonial_id,testimonial_title,testimonial_content,testimonial_rating_value,testimonial_create_at,testimonial_update_at,concat("'.base_url().'",testimonial_image) as testimonial_image');
        $this->db->where('testimonial_status','1');
        
        if(!empty($offset) && !empty($count)){
            $this->db->limit($offset,$count);
        }
        $this->db->order_by('testimonial_id','desc');
        $this->db->order_by('testimonial_create_at','desc');
        $this->db->order_by('testimonial_update_at','desc');
       return $this->db->get($this->table);
    }
    
    public function _get_testimonial_records_by_id($id){
        $this->db->select('testimonial_id,testimonial_title,testimonial_content,testimonial_rating_value,testimonial_create_at,testimonial_update_at,concat("'.base_url().'",testimonial_image) as testimonial_image');
        $this->db->where('testimonial_status','1');
        $this->db->where('testimonial_id',$id);
       return $this->db->get($this->table);
    }
    
}
