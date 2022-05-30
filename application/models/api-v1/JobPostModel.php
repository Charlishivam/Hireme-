<?php defined('BASEPATH') or exit('No direct script access allowed');
class JobPostModel extends CI_Model{
    
    
    
    public function __construct(){
        parent::__construct();
    }
    

    public function _job_post_records(){
       
		$this->db->select('dk_jobpost.jobpost_id,dk_jobpost.jobpost_title,,dk_jobpost.jobpost_description,dk_jobpost.jobpost_price_from,dk_jobpost.jobpost_praposal,dk_jobpost.jobpost_skill,dk_jobpost.jobpost_category,dk_jobpost.jobpost_subcategory,dk_jobpost.jobpost_status,dk_jobpost.jobpost_till_date,dk_category.category_name,dk_subcategory.subcategory_name,dk_jobpost.customer_id');
		$this->db->from('dk_jobpost');
		$this->db->where('jobpost_status','1');
		$this->db->join('dk_category','dk_category.category_id=dk_jobpost.jobpost_category','LEFT');
		$this->db->join('dk_subcategory','dk_subcategory.subcategory_id=dk_jobpost.jobpost_subcategory','LEFT');
		$this->db->join('dk_customer','dk_customer.customer_id=dk_jobpost.customer_id','LEFT');
		$query = $this->db->get()->result_array();
		foreach($query as $key => $val){
		    $jobpost_skill_array =  json_decode($val['jobpost_skill']);
		        $this->db->select("GROUP_CONCAT(skill_name SEPARATOR ',') as skill_name");
        		$this->db->from('dk_skill');
        		$this->db->where('skill_status','1');
        		$this->db->where_in('skill_id',$jobpost_skill_array);
        		$data = $this->db->get()->result_array();
		        $query[$key]['jobpost_skill']=@$data[0]['skill_name'];
        }
        return $query;
    }
     //create by vasit
     public function _get_jobpost_sbcat($subcategory_id){
        $this->db->select('dk_jobpost.jobpost_id,dk_jobpost.jobpost_title,dk_jobpost.jobpost_description,dk_jobpost.jobpost_price_from,dk_jobpost.jobpost_praposal,dk_jobpost.jobpost_skill,dk_jobpost.jobpost_category,dk_jobpost.jobpost_subcategory,dk_jobpost.jobpost_status,dk_jobpost.jobpost_till_date,dk_category.category_name,dk_subcategory.subcategory_name,dk_jobpost.customer_id');
        $this->db->from('dk_jobpost');
		$this->db->where('jobpost_status','1');
		$this->db->where('jobpost_subcategory',$subcategory_id);
		$this->db->join('dk_category','dk_category.category_id=dk_jobpost.jobpost_category','LEFT');
		$this->db->join('dk_subcategory','dk_subcategory.subcategory_id=dk_jobpost.jobpost_subcategory','LEFT');
		$this->db->join('dk_customer','dk_customer.customer_id=dk_jobpost.customer_id','LEFT');
		$query = $this->db->get();
        return $query;
    }
 
    
    //create by vasit
     public function _get_jobpost_by_customerid($customer_id){
		$this->db->select('dk_jobpost.jobpost_id,dk_jobpost.jobpost_title,dk_jobpost.jobpost_description,dk_jobpost.jobpost_price_from,dk_jobpost.jobpost_praposal,dk_jobpost.jobpost_skill,dk_jobpost.jobpost_category,dk_jobpost.jobpost_subcategory,dk_jobpost.jobpost_status,dk_jobpost.jobpost_till_date,dk_category.category_name,dk_subcategory.subcategory_name');
		$this->db->from('dk_jobpost');
		$this->db->where('dk_jobpost.jobpost_status','1');
		$this->db->where('dk_jobpost.customer_id',$customer_id);
		$this->db->join('dk_category','dk_category.category_id=dk_jobpost.jobpost_category','LEFT');
		$this->db->join('dk_subcategory','dk_subcategory.subcategory_id=dk_jobpost.jobpost_subcategory','LEFT');
		$this->db->join('dk_customer','dk_customer.customer_id=dk_jobpost.customer_id','LEFT');
		$query = $this->db->get();
        return $query;
    }    
    
     // suerch jobpost by title//  //create by vasit
    public function _search_by_keywords($keyword,$limit){
        $this->db->select('dk_jobpost.jobpost_id,dk_jobpost.jobpost_title,dk_jobpost.jobpost_description,dk_jobpost.jobpost_price_from,dk_jobpost.jobpost_praposal,dk_jobpost.jobpost_skill,dk_jobpost.jobpost_category,dk_jobpost.jobpost_subcategory,dk_jobpost.jobpost_status,dk_jobpost.jobpost_till_date,dk_category.category_name,dk_subcategory.subcategory_name,dk_jobpost.customer_id');
		$this->db->from('dk_jobpost');
		$this->db->join('dk_category','dk_category.category_id=dk_jobpost.jobpost_category','LEFT');
		$this->db->join('dk_subcategory','dk_subcategory.subcategory_id=dk_jobpost.jobpost_subcategory','LEFT');
		$this->db->join('dk_customer','dk_customer.customer_id=dk_jobpost.customer_id','LEFT');
		$this->db->where('dk_jobpost.jobpost_status','1');
		$this->db->like('dk_jobpost.jobpost_title',$keyword);
		if(empty($limit)){
		$this->db->order_by('dk_jobpost.jobpost_id','desc');
		}
		$this->db->limit($limit);
		$result = $this->db->get();
        return $result;
	}
    
  
    public function _job_post_bidding_records($jobpost_id){
		$this->db->select('dk_bidding.bidding_id,dk_bidding.bidding_comment,dk_bidding.bidding_job_post_id,dk_bidding.bidding_customer_id,dk_bidding.bidding_amount,dk_bidding.bidding_status,dk_bidding.bidding_shortlist,dk_customer.customer_full_name');
                  $this->db->from('dk_bidding');
                  $this->db->where('bidding_job_post_id',$jobpost_id);
                  $this->db->where('bidding_status','1');
                  $this->db->join('dk_customer','dk_customer.customer_id=dk_bidding.bidding_customer_id','LEFT');
		$query = $this->db->get()->result_array();
         return $query;
		
		
       
    }
    
    
    public function _skill_records(){
       
		$this->db->select('*');
        $this->db->from('dk_skill');
		$query = $this->db->get()->result_array();
        return $query;
		
		
       
    }
    
}
