<?php defined('BASEPATH') or exit('No direct script access allowed');
class Blogsmodel extends CI_Model{
    
    protected $table = "park_blog";
    
    public function __construct(){
        parent::__construct();
    }

    public function _get_blogs_records($offset=null,$count=null){
        $this->db->select('blog_id,blog_heading,blog_content,blog_by,blog_create_at,blog_postedon,blog_update_at,concat("'.base_url().'",blog_image) as blog_image,coalesce(blog_source,"") as blog_source,coalesce(blog_area,"") as blog_area');
        $this->db->where('blog_status','1');
        $this->db->where('blog_articles','1');
        
        if(!empty($offset) && !empty($count)){
            $this->db->limit($offset,$count);
        }
        $this->db->order_by('blog_id','desc');
        $this->db->order_by('blog_create_at','desc');
        $this->db->order_by('blog_update_at','desc');
       return $this->db->get($this->table);
    }
    
    public function _get_blogs_records_by_id($id){
        $this->db->select('blog_id,blog_heading,blog_content,blog_by,blog_area,blog_create_at,blog_update_at,concat("'.base_url().'",blog_image) as blog_image,coalesce(blog_source,"") as blog_source,coalesce(blog_area,"") as blog_area');
        $this->db->where('blog_status','1');
        $this->db->where('blog_id',$id);
       return $this->db->get($this->table);
    }
    
}
