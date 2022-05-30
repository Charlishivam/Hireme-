<?php
 defined('BASEPATH') OR exit('No direct script access allowed');

class Jobpost_model extends CI_Model{
    
    public function get_all_jobpost(){
       $this->db->select("*");
       $this->db->from('dk_jobpost');
       $this->db->join('dk_customer','dk_customer.customer_id=dk_jobpost.customer_id','LEFT');
       $this->db->join('dk_category','dk_category.category_id=dk_jobpost.jobpost_category','LEFT');
       $this->db->join('dk_subcategory','dk_subcategory.subcategory_id=dk_jobpost.jobpost_subcategory','LEFT');
       $this->db->order_by('jobpost_id','DESC');
       $result =  $this->db->get()->result_array();
       return $result;

    }



    public function get_single_jobpost($jobpost_id){
       $this->db->select("*");
       $this->db->from('dk_jobpost');
       $this->db->where('jobpost_id',$jobpost_id);
       $this->db->join('dk_category','dk_category.category_id=dk_jobpost.jobpost_category','LEFT');
       $this->db->join('dk_subcategory','dk_subcategory.subcategory_id=dk_jobpost.jobpost_subcategory','LEFT');
       $this->db->order_by('jobpost_id','DESC');
       $result =  $this->db->get()->row_array();
       return $result;

    }


    public function get_all_bidding_records($jobpost_id){
       $this->db->select("*");
       $this->db->from('dk_bidding');
       $this->db->where('bidding_job_post_id',$jobpost_id);
       $this->db->join('dk_customer','dk_customer.customer_id=dk_bidding.bidding_customer_id','LEFT');
       $this->db->order_by('bidding_id','DESC');
       $result =  $this->db->get()->result_array();
       return $result;

    }

    public function get_all_review_records($jobpost_id){
       $this->db->select("*");
       $this->db->from('dk_review');
       $this->db->where('review_job_post_id',$jobpost_id);
       $this->db->join('dk_customer','dk_customer.customer_id=dk_review.review_customer_id','LEFT');
       $this->db->order_by('review_id','DESC');
       $result =  $this->db->get()->result_array();
       return $result;

    }


    public function get_skill_name_records($skill_id){
       $this->db->select("*");
       $this->db->from('dk_skill');
       $this->db->where('skill_id',$skill_id);
       $result =  $this->db->get()->row();
       return $result;

    }

    public function all_sub_cat_by_cat_id($category_id)
    {
        return $this->db->select("subcategory_id,subcategory_name")
            ->where('category_id', $category_id)
            ->get('dk_subcategory')->result();
    }
}
