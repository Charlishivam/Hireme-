<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'libraries/api-libraries/API_Controller.php'; // for load

class Jobpost extends API_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
       $this->_apiConfig([
            'methods' => ['GET'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $result = $this->JobPostModel->_job_post_records();
        if(empty($result)){
        $this->api_return(array('status' =>true,'error' => 'Data not found !'),self::HTTP_OK);exit;
        }
        $this->api_return(array('status' =>true,'msg' => 'Data found !','data'=>$result),self::HTTP_OK);exit;
    }
    
    //+++++++++++++++++++++++++++++vasit khan++++++++++++++++++++++++++++++++++++++++// 
    public function get_jobpost_by_subcategoryid(){
          $this->_apiConfig([
            'methods' => ['POST'],
        'key' => ['header',$this->config->item('api_fixe_header_key')],]);
        
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->jobpost_subcategory) || !isset($post->jobpost_subcategory)){
        $this->api_return(array('status' =>false,'error' => 'Subcategory ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        $subcategory_id = $post->jobpost_subcategory;
        $result = $this->JobPostModel->_get_jobpost_sbcat($subcategory_id);
        
        if($result->num_rows() > 0){
            foreach($result->result() as $key => $val){
            $job_skill_array = !empty($val->jobpost_skill) ? json_decode($val->jobpost_skill) : array();
            $job_skill_set = array();
            foreach($job_skill_array as $keys => $vals){
                $this->db->select("skill_id,skill_name");
        		$this->db->from('dk_skill');
        		$this->db->where('skill_status','1');
         		$this->db->where_in('skill_id',$vals);
         		$job_skill_row = $this->db->get()->row();
         		array_push($job_skill_set,array('skill_id' =>$job_skill_row->skill_id,'skill_name' =>$job_skill_row->skill_name));
        }
            $result->result()[$key]->jobpost_skill = @$job_skill_set;
        }
            $this->api_return(array('status' =>true,'message' => 'Data found !','data'=>$result->result()),self::HTTP_OK);exit;
        }else{
            $this->api_return(array('status' =>true,'error' => 'Data not found!'),self::HTTP_OK);exit;
        }
    }
    
    public function bidding_list(){
       $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->jobpost_id) || !isset($post->jobpost_id)){
        $this->api_return(array('status' =>false,'error' => 'Jobpost ID  is empty Or missing !'),self::HTTP_OK);exit;
        }
        $result = $this->JobPostModel->_job_post_bidding_records($post->jobpost_id);
        if(empty($result)){
        $this->api_return(array('status' =>true,'error' => 'Data not found !'),self::HTTP_OK);exit;
        }
        $this->api_return(array('status' =>true,'msg' => 'Bidding Data found !','data'=>$result),self::HTTP_OK);exit;
    }
    
    public function skill_list(){
       $this->_apiConfig([
            'methods' => ['GET'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $result = $this->JobPostModel->_skill_records();
        if(empty($result)){
            $this->api_return(array('status' =>true,'error' => 'Data not found !'),self::HTTP_OK);exit;
        }
        $this->api_return(array('status' =>true,'msg' => 'Skill Data found !','data'=>$result),self::HTTP_OK);exit;
    }
    
    //+++++++++++++++++++++++++++++vasit khan++++++++++++++++++++++++++++++++++++++++//
    
       public function joblist_by_customerid(){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->customer_id) || !isset($post->customer_id)){
        $this->api_return(array('status' =>false,'error' => 'Customer ID is empty Or missing !'),self::HTTP_OK);exit;
        }
        $customer_id = $post->customer_id;
        $result = $this->JobPostModel->_get_jobpost_by_customerid($customer_id);
        if($result->num_rows() > 0){
            foreach($result->result() as $key => $val){
            $job_skill_array = !empty($val->jobpost_skill) ? json_decode($val->jobpost_skill) : array();
            $job_skill_set = array();
            foreach($job_skill_array as $keys => $vals){
                $this->db->select("skill_id,skill_name");
        		$this->db->from('dk_skill');
        		$this->db->where('skill_status','1');
         		$this->db->where_in('skill_id',$vals);
         		$job_skill_row = $this->db->get()->row();
         		array_push($job_skill_set,array('skill_id' =>$job_skill_row->skill_id,'skill_name' =>$job_skill_row->skill_name));
            }
            $result->result()[$key]->jobpost_skill = @$job_skill_set;
         }
            $this->api_return(array('status' =>true,'message' => 'Data found !','data'=>$result->result()),self::HTTP_OK);exit;
         }else{
            $this->api_return(array('status' =>true,'error' => 'Data not found!'),self::HTTP_OK);exit;
        }
    }
    
     //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
     
       public function search_jobpost_by_keyword_post(){
         $this->_apiConfig([
             
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->keyword) || !isset($post->keyword)){
            $this->api_return(array('status' =>false,'error' => 'Please Give any keyword !'),self::HTTP_OK);exit;
        }
        $keyword = $post->keyword;
        $limit   = 50;
        $result = $this->JobPostModel->_search_by_keywords($keyword,$limit);
        if($result->num_rows() > 0){
        foreach($result->result() as $key => $val){
        $job_skill_array = !empty($val->jobpost_skill) ? json_decode($val->jobpost_skill) : array();
        $job_skill_set = array();
            foreach($job_skill_array as $keys => $vals){
                $this->db->select("skill_id,skill_name");
        		$this->db->from('dk_skill');
        		$this->db->where('skill_status','1');
         		$this->db->where_in('skill_id',$vals);
         		$job_skill_row = $this->db->get()->row();
         		array_push($job_skill_set,array('skill_id' =>$job_skill_row->skill_id,'skill_name' =>$job_skill_row->skill_name));
        }
            $result->result()[$key]->jobpost_skill = @$job_skill_set;
        }
            $this->api_return(array('status' =>true,'message' => 'Data found !','data'=>$result->result()),self::HTTP_OK);exit;
        }else{
            $this->api_return(array('status' =>true,'error' => 'Data not found!'),self::HTTP_OK);exit;
        }
    }
  //----------------------------++--------------------------------------- //  
     
     
      public function create(){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
       
        if(empty($post->jobpost_title) || !isset($post->jobpost_title)){
            $this->api_return(array('status' =>false,'error' => 'Post title  is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->customer_id) || !isset($post->customer_id)){
            $this->api_return(array('status' =>false,'error' => 'Post costumer id  is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->jobpost_description) || !isset($post->jobpost_description)){
            $this->api_return(array('status' =>false,'error' => 'Post description is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->jobpost_price_from) || !isset($post->jobpost_price_from)){
            $this->api_return(array('status' =>false,'error' => 'Post price from is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->jobpost_praposal) && isset($post->jobpost_praposal)){
             $this->api_return(array('status' =>false,'error' => 'Praposal is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        if(empty($post->jobpost_skill) || !isset($post->jobpost_skill) || !is_array($post->jobpost_skill)){
            $this->api_return(array('status' =>false,'error' => 'Post skill is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        if(empty($post->jobpost_category) || !isset($post->jobpost_category)){
            $this->api_return(array('status' =>false,'error' => 'Post Category is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        if(empty($post->jobpost_subcategory) || !isset($post->jobpost_subcategory)){
            $this->api_return(array('status' =>false,'error' => 'Post subcategory is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->jobpost_summary) || !isset($post->jobpost_summary)){
            $this->api_return(array('status' =>false,'error' => 'Post summary is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        $data['customer_id']             = $post->customer_id;
        $data['jobpost_skill']           = json_encode($post->jobpost_skill);
        $data['jobpost_title']           = $post->jobpost_title;
        $data['jobpost_description']     = $post->jobpost_description;
        $data['jobpost_price_from']      = $post->jobpost_price_from;
        $data['jobpost_praposal']        = $post->jobpost_praposal;
        $data['jobpost_till_date']       = $post->jobpost_till_date;
        $data['jobpost_category']        = $post->jobpost_category;
        $data['jobpost_subcategory']     = $post->jobpost_subcategory;
        $data['jobpost_summary']         = $post->jobpost_summary;
        $data['jobpost_create_at']       = date('Y-m-d H:i:s');
     
    
        if($this->BaseModel->_inser_query('dk_jobpost',$data)){
            $insert_id = $this->db->insert_id();
            $this->api_return(array('status' =>true,'post_id' =>$insert_id,'msg' => 'Jobpost successfully added !'),self::HTTP_OK);exit;
        }else{
            $this->api_return(array('status' =>false,'error' => 'Oops! Something went wrong ! Help us improve your experience by sending an error report  !'),self::HTTP_OK);exit;
        }
    }  
    
     //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
     
      public function jobpost_update(){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        
        if(empty($post->jobpost_id) || !isset($post->jobpost_id)){
            $this->api_return(array('status' =>false,'error' => 'jobpost ID  is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->jobpost_title) || !isset($post->jobpost_title)){
            $this->api_return(array('status' =>false,'error' => 'Post title  is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->customer_id) || !isset($post->customer_id)){
            $this->api_return(array('status' =>false,'error' => 'Post costumer id  is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->jobpost_description) || !isset($post->jobpost_description)){
            $this->api_return(array('status' =>false,'error' => 'Post description is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->jobpost_price_from) || !isset($post->jobpost_price_from)){
            $this->api_return(array('status' =>false,'error' => 'Post price from is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->jobpost_praposal) && isset($post->jobpost_praposal)){
             $this->api_return(array('status' =>false,'error' => 'Praposal is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        if(empty($post->jobpost_skill) || !isset($post->jobpost_skill) || !is_array($post->jobpost_skill)){
            $this->api_return(array('status' =>false,'error' => 'Post skill is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        if(empty($post->jobpost_category) || !isset($post->jobpost_category)){
            $this->api_return(array('status' =>false,'error' => 'Post Category is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        if(empty($post->jobpost_subcategory) || !isset($post->jobpost_subcategory)){
            $this->api_return(array('status' =>false,'error' => 'Post subcategory is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->jobpost_summary) || !isset($post->jobpost_summary)){
            $this->api_return(array('status' =>false,'error' => 'Post summary is empty Or missing !'),self::HTTP_OK);exit;
        }
        $jobpost_id = $post->jobpost_id;
        $data['customer_id']             = $post->customer_id;
        $data['jobpost_skill']           = json_encode($post->jobpost_skill);
        $data['jobpost_title']           = $post->jobpost_title;
        $data['jobpost_description']     = $post->jobpost_description;
        $data['jobpost_price_from']      = $post->jobpost_price_from;
        $data['jobpost_praposal']        = $post->jobpost_praposal;
        $data['jobpost_till_date']       = $post->jobpost_till_date;
        $data['jobpost_category']        = $post->jobpost_category;
        $data['jobpost_subcategory']     = $post->jobpost_subcategory;
        $data['jobpost_summary']         = $post->jobpost_summary;
        $data['jobpost_update_at']       = date('Y-m-d H:i:s');
       if($this->BaseModel->_update_query('dk_jobpost',$data,array('jobpost_id'=>$jobpost_id))){
            $this->api_return(array('status' =>true,'msg' => 'Jobpost successfully updated !'),self::HTTP_OK);exit;
        }else{
            $this->api_return(array('status' =>false,'error' => 'Oops! Something went wrong ! Help us improve your experience by sending an error report  !'),self::HTTP_OK);exit;
        }
    }  
    
    public function biddingcreate(){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
       
        if(empty($post->bidding_comment) || !isset($post->bidding_comment)){
            $this->api_return(array('status' =>false,'error' => 'Bidding comment  is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->bidding_job_post_id) || !isset($post->bidding_job_post_id)){
            $this->api_return(array('status' =>false,'error' => 'Post Id is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->bidding_customer_id) || !isset($post->bidding_customer_id)){
            $this->api_return(array('status' =>false,'error' => 'Customer Id is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->bidding_amount) && isset($post->bidding_amount)){
             $this->api_return(array('status' =>false,'error' => 'Bidd Amount is empty Or missing !'),self::HTTP_OK);exit;
        }
        
        $data['bidding_comment']          = $post->bidding_comment;
        $data['bidding_job_post_id']      = $post->bidding_job_post_id;
        $data['bidding_customer_id']      = $post->bidding_customer_id;
        $data['bidding_amount']           = $post->bidding_amount;
        $data['bidding_shortlist']        = 0;
        $data['bidding_create_at']        = date('Y-m-d H:i:s');
        if($this->BaseModel->_inser_query('dk_bidding',$data)){
            $insert_id = $this->db->insert_id();
            $this->api_return(array('status' =>true,'bidd_id' =>$insert_id,'msg' => 'Bidding successfully added !'),self::HTTP_OK);exit;
        }else{
             
            $this->api_return(array('status' =>false,'error' => 'Oops! Something went wrong ! Help us improve your experience by sending an error report  !'),self::HTTP_OK);exit;
        }
    }
    
    
     public function jobpost_rating_create(){
        $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
       
        if(empty($post->review_customer_id) || !isset($post->review_customer_id)){
            $this->api_return(array('status' =>false,'error' => 'Customer ID  is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->review_job_post_id) || !isset($post->review_job_post_id)){
            $this->api_return(array('status' =>false,'error' => 'Job Post  is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->review_comment) || !isset($post->review_comment)){
            $this->api_return(array('status' =>false,'error' => 'Comment value is empty Or missing !'),self::HTTP_OK);exit;
        }
        if(empty($post->review_rating) && isset($post->review_rating)){
             $this->api_return(array('status' =>false,'error' => 'Rating value empty Or missing !'),self::HTTP_OK);exit;
        }
    
        $data['review_customer_id']          = $post->review_customer_id;
        $data['review_job_post_id']          = $post->review_job_post_id;
        $data['review_comment']              = $post->review_comment;
        $data['review_rating']               = $post->review_rating;
        $data['review_create_at']  = date('Y-m-d H:i:s');
     
    
        if($this->BaseModel->_inser_query('dk_review',$data)){
            $insert_id = $this->db->insert_id();
            $this->api_return(array('status' =>true,'review_id' =>$insert_id,'msg' => 'New Review successfully added !'),self::HTTP_OK);exit;
        }else{
            
            $this->api_return(array('status' =>false,'error' => 'Oops! Something went wrong ! Help us improve your experience by sending an error report  !'),self::HTTP_OK);exit;
        }
    }
    
    
        public function jobpost_status(){
	       $this->_apiConfig([
            'methods' => ['POST'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $post = json_decode(file_get_contents('php://input'));
        if(empty($post->jobpost_id) || !isset($post->jobpost_id)){
        $this->api_return(array('status' =>false,'error' => 'Service id is empty Or missing !'),self::HTTP_OK);exit;
        }
	   $jobpost_id =$post->jobpost_id;
	   $data['jobpost_status'] = '0';
	   
	  if($this->BaseModel->_update_query('dk_jobpost',$data,array('jobpost_id'=>$jobpost_id))){
            $this->api_return(array('status' =>true,'msg' => 'Jobpost status successfully updated !'),self::HTTP_OK);exit;
        }else{
            $this->api_return(array('status' =>false,'error' => 'Oops! Something went wrong ! Help us improve your experience by sending an error report  !'),self::HTTP_OK);exit;
        }
    }  
       

}