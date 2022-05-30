<?php
class jobpost extends MY_Controller
{
    function __construct(){

        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();
        $this->load->model('Base_model');
        $this->load->model('admin/Jobpost_model', 'Jobpost_model');
        $this->data['config']  = $this->Base_model->all_setting_data();
	}

	
	public function index(){
    $data['records']   = $this->Jobpost_model->get_all_jobpost();
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/jobpost/index', $data);
		$this->load->view('admin/includes/_footer');
	}


    //-----------------------------------------------------------
  public function add(){

    //echo "<pre>"; print_r($_POST); echo "<pre>"; die(); 
    $this->rbac->check_operation_access(); // check opration permission
    
    $this->form_validation->set_rules('jobpost_title', 'jobpost_title', 'required');
    $this->form_validation->set_rules('jobpost_till_date', 'jobpost_till_date', 'required');

    $jobpost_skill     = $this->input->post('jobpost_skill');
    if(!empty($jobpost_skill)){
        $skill = json_encode($jobpost_skill);
    }

        if($this->form_validation->run() == true){ 
            $data['customer_id']        = $this->input->post('customer_id');
            $data['jobpost_category']   = $this->input->post('jobpost_category');
            $data['jobpost_subcategory']= $this->input->post('jobpost_subcategory');
            $data['jobpost_praposal']   = $this->input->post('jobpost_praposal');
            $data['jobpost_title']      = $this->input->post('jobpost_title');
            $data['jobpost_till_date']  = date('Y-m-d', strtotime($this->input->post('jobpost_till_date')));
            $data['jobpost_price_from'] = $this->input->post('jobpost_price_from');
            //$data['jobpost_price_to'] = $this->input->post('jobpost_price_to');
            $data['jobpost_skill']      = $skill;
            $data['jobpost_description']= $this->input->post('jobpost_description');
            $data['jobpost_summary']    = $this->input->post('jobpost_summary');
            $data['jobpost_create_at']  = date('Y-m-d H:i:s');
           
            if($this->Base_model->_inser_query('dk_jobpost',$data)) {
              $this->session->set_flashdata('success', 'new job post have been successfully created !');
            }else{
                $this->session->set_flashdata('error', 'Some have error ! please try again ');
            }
            redirect('admin/jobpost');
             
        }

    $this->data['category_name'] = $this->Base_model->_dropdownlist('category_id','category_name',array('category_status'=>'1'),'dk_category','Select Category Name','');
    $this->data['customer_name']    = $this->Base_model->_dropdownlist('customer_id','customer_full_name',array('customer_status'=>'1'),'dk_customer','Select Customer Name','');
    $this->data['subcategory_name'] = $this->Base_model->_dropdownlist('subcategory_id','subcategory_name',array('subcategory_status'=>'1'),'dk_subcategory','Select Subcategory Name','');
    $this->data['skill_name'] = $this->Base_model->_dropdownlist('skill_id','skill_name',array('skill_status'=>'1'),'dk_skill','','');
       

    $data['title'] = '';
    $this->load->view('admin/includes/_header');
    $this->load->view('admin/jobpost/add',$this->data);
    $this->load->view('admin/includes/_footer');
  }

  public function edit(){
    $this->rbac->check_operation_access(); // check opration permission
    $jobpost_id = $this->uri->segment(4); 
    $this->data['single'] = $this->Base_model->_single_data_query(array('jobpost_id'=>$jobpost_id),'dk_jobpost')->row_array();
    $this->form_validation->set_rules('jobpost_title', 'jobpost_title', 'required');
    $this->form_validation->set_rules('jobpost_till_date', 'jobpost_till_date', 'required');

   

    $jobpost_skill     = $this->input->post('jobpost_skill');
    if(!empty($jobpost_skill)){
        $skill = json_encode($jobpost_skill);
    }

        if($this->form_validation->run() == true){ 
            $jobpost_id = $this->input->post('jobpost_id');
            $data['customer_id']   = $this->input->post('customer_id');
            $data['jobpost_category'] = $this->input->post('jobpost_category');
            $data['jobpost_subcategory'] = $this->input->post('jobpost_subcategory');
            
            $data['jobpost_title'] = $this->input->post('jobpost_title');
            $data['jobpost_till_date'] = date('Y-m-d', strtotime($this->input->post('jobpost_till_date')));

            $data['jobpost_praposal'] = $this->input->post('jobpost_praposal');
            $data['jobpost_price_from'] = $this->input->post('jobpost_price_from');
            //$data['jobpost_price_to'] = $this->input->post('jobpost_price_to');
            $data['jobpost_skill'] = $skill;
            $data['jobpost_description'] = $this->input->post('jobpost_description');
            $data['jobpost_summary'] = $this->input->post('jobpost_summary');
            $data['jobpost_update_at']        = date('Y-m-d H:i:s');
            if($this->Base_model->_update_query('dk_jobpost',$data,array('jobpost_id'=>$jobpost_id))) {
              $this->session->set_flashdata('success', 'Content have been successfully Update !');
            }else{
                $this->session->set_flashdata('error', 'Some have error ! please try again ');
            }
           
                redirect('admin/jobpost');
            
        }
       
    $this->data['title'] = '';
    $this->data['category_name']    = $this->Base_model->_dropdownlist('category_id','category_name',array('category_status'=>'1'),'dk_category','Select Category Name','');
    $this->data['customer_name']    = $this->Base_model->_dropdownlist('customer_id','customer_full_name',array('customer_status'=>'1'),'dk_customer','Select Customer Name','');
    $this->data['subcategory_name'] = $this->Base_model->_dropdownlist('subcategory_id','subcategory_name',array('subcategory_status'=>'1'),'dk_subcategory','Select Subcategory Name','');

    $this->data['skill_name'] = $this->Base_model->_dropdownlist('skill_id','skill_name',array('skill_status'=>'1'),'dk_skill','','');
    $this->load->view('admin/includes/_header');
    $this->load->view('admin/jobpost/edit', $this->data);
    $this->load->view('admin/includes/_footer');
  }

  //-----------------------------------------------------------
 
  public function jobpost_status(){
    $this->rbac->check_operation_access(); // check opration permission
    $jobpost_id = $this->uri->segment(4); 
    $this->data['single'] = $this->Base_model->_single_data_query(array('jobpost_id'=>$jobpost_id),'dk_jobpost')->row();
    $data['jobpost_status'] = $this->uri->segment(5) == '1' ? '0' : '1';

    if($this->Base_model->_update_query('dk_jobpost',$data,array('jobpost_id'=>$jobpost_id))) {
      $this->session->set_flashdata('success', 'jobpost Status has been changed successfully');
      redirect($_SERVER['HTTP_REFERER']);
    }else{
        $this->session->set_flashdata('errors', 'jobpost Status has not been changed successfully');
      redirect($_SERVER['HTTP_REFERER']);
    }
  }
  

  //------------------------------------------------------------
  public function delete($jobpost_id=''){
    $this->rbac->check_operation_access(); // check opration permission
    $jobpost_id = $this->uri->segment(4);
    if($this->Base_model->_delete_query('dk_jobpost',array('jobpost_id'=>$jobpost_id))) 
    {
      $this->session->set_flashdata('success','jobpost has been deleted Successfully.'); 
      redirect($_SERVER['HTTP_REFERER']);
    }
  }


  public function get_subcatgory(){

        $category_id  =  $this->input->post('category_id');

        $data['subcategory']=$this->Jobpost_model->all_sub_cat_by_cat_id($category_id);
        print_r(json_encode($data['subcategory']));

    }

 public function view(){
    $this->rbac->check_operation_access(); // check opration permission
    $jobpost_id = $this->uri->segment(4); 
    $this->data['single'] = $this->Jobpost_model->get_single_jobpost($jobpost_id);

    $this->data['bidding_records'] = $this->Jobpost_model->get_all_bidding_records($jobpost_id);

    $this->data['review_records'] = $this->Jobpost_model->get_all_review_records($jobpost_id);

    //echo "<pre>"; print_r($this->data['review_records']); echo "<pre>"; die(); 


    $this->data['title'] = '';
    $this->load->view('admin/includes/_header');
    $this->load->view('admin/jobpost/view', $this->data);
    $this->load->view('admin/includes/_footer');
  }

  public function bidding_add(){

    //echo "<pre>"; print_r($_POST); echo "<pre>"; die(); 
    $this->rbac->check_operation_access(); // check opration permission
    $this->form_validation->set_rules('jobpost_id', 'jobpost_id', 'required');
    $this->data['jobpost_id'] = $this->uri->segment(4); 
        if($this->form_validation->run() == true){ 
            $jobpost_id = $this->input->post('jobpost_id');
            $data['bidding_job_post_id'] = $jobpost_id;
            $data['bidding_customer_id'] = $this->input->post('bidding_customer_id');
            $data['bidding_amount'] = $this->input->post('bidding_amount');
            $data['bidding_comment'] = $this->input->post('bidding_comment');
            $data['bidding_shortlist'] = $this->input->post('bidding_shortlist');
            $data['bidding_create_at']  = date('Y-m-d H:i:s');
            if($this->Base_model->_inser_query('dk_bidding',$data)) {
              $this->session->set_flashdata('success', 'bidding have been successfully created !');
            }else{
                $this->session->set_flashdata('error', 'Some have error ! please try again ');
            }

            //echo $this->db->last_query(); die();
            redirect('admin/jobpost/view/'.$jobpost_id);
        }

    $this->data['customer_name'] = $this->Base_model->_dropdownlist('customer_id','customer_full_name',array('customer_status'=>'1','customer_type'=>'1'),'dk_customer','Select Customer Name','');
       

    $this->data['title'] = '';
    $this->load->view('admin/includes/_header');
    $this->load->view('admin/jobpost/bidding-add', $this->data);
    $this->load->view('admin/includes/_footer');
  }


  public function bidding_edit(){
    $this->rbac->check_operation_access(); // check opration permission
    $bidding_id = $this->uri->segment(4);
    $this->data['single'] = $this->Base_model->_single_data_query(array('bidding_id'=>$bidding_id),'dk_bidding')->row_array();
    $this->form_validation->set_rules('bidding_id', 'bidding_id', 'required');
   
        if($this->form_validation->run() == true){ 
            $bidding_job_post_id = $this->input->post('bidding_job_post_id');
            $bidding_id = $this->input->post('bidding_id');
            $data['bidding_job_post_id'] = $bidding_job_post_id;
            $data['bidding_customer_id'] = $this->input->post('bidding_customer_id');
            $data['bidding_amount'] = $this->input->post('bidding_amount');
            $data['bidding_comment'] = $this->input->post('bidding_comment');
            $data['bidding_shortlist'] = $this->input->post('bidding_shortlist');
            $data['bidding_update_at']  = date('Y-m-d H:i:s');
           
            if($this->Base_model->_update_query('dk_bidding',$data,array('bidding_id'=>$bidding_id))) {
              $this->session->set_flashdata('success', 'bidding have been successfully created !');
            }else{
                $this->session->set_flashdata('error', 'Some have error ! please try again ');
            }
            redirect('admin/jobpost/view/'.$bidding_job_post_id);
        }

    $this->data['customer_name'] = $this->Base_model->_dropdownlist('customer_id','customer_full_name',array('customer_status'=>'1','customer_type'=>'1'),'dk_customer','Select Customer Name','');
    $this->data['title'] = '';
    $this->load->view('admin/includes/_header');
    $this->load->view('admin/jobpost/bidding-edit', $this->data);
    $this->load->view('admin/includes/_footer');
  }

  //-----------------------------------------------------------
  public function bidding_status(){
    $this->rbac->check_operation_access(); // check opration permission
    $bidding_id = $this->uri->segment(4);
    $this->data['single'] = $this->Base_model->_single_data_query(array('bidding_id'=>$bidding_id),'dk_bidding')->row();
    $data['bidding_status'] = $this->uri->segment(5) == '1' ? '0' : '1';
    if($this->Base_model->_update_query('dk_bidding',$data,array('bidding_id'=>$bidding_id))) {
      $this->session->set_flashdata('success', 'bidding Status has been changed successfully');
      redirect($_SERVER['HTTP_REFERER']);
    }else{
        $this->session->set_flashdata('errors', 'bidding Status has not been changed successfully');
      redirect($_SERVER['HTTP_REFERER']);
    }
  }


   //------------------------------------------------------------
  public function bidding_delete($bidding_id=''){
    $this->rbac->check_operation_access(); // check opration permission
    $bidding_id = $this->uri->segment(4);
    if($this->Base_model->_delete_query('dk_bidding',array('bidding_id'=>$bidding_id))) 
    {
      $this->session->set_flashdata('success','bidding has been deleted Successfully.'); 
      redirect($_SERVER['HTTP_REFERER']);
    }
  }



  public function review_add(){

    //echo "<pre>"; print_r($_POST); echo "<pre>"; die(); 
    $this->rbac->check_operation_access(); // check opration permission
    $this->form_validation->set_rules('jobpost_id', 'jobpost_id', 'required');
    $this->data['jobpost_id'] = $this->uri->segment(4); 
        if($this->form_validation->run() == true){ 
            $jobpost_id = $this->input->post('jobpost_id');
            $data['review_job_post_id'] = $jobpost_id;
            $data['review_customer_id'] = $this->input->post('review_customer_id');
            $data['review_rating']      = $this->input->post('review_rating');
            $data['review_comment']     = $this->input->post('review_comment');
            $data['review_create_at']  = date('Y-m-d H:i:s');
            if($this->Base_model->_inser_query('dk_review',$data)) {
              $this->session->set_flashdata('success', 'review have been successfully created !');
            }else{
                $this->session->set_flashdata('error', 'Some have error ! please try again ');
            }

            //echo $this->db->last_query(); die();
            redirect('admin/jobpost/view/'.$jobpost_id);
        }

    $this->data['customer_name'] = $this->Base_model->_dropdownlist('customer_id','customer_full_name',array('customer_status'=>'1','customer_type'=>'1'),'dk_customer','Select Customer Name','');
    $this->data['title'] = '';
    $this->load->view('admin/includes/_header');
    $this->load->view('admin/jobpost/review-add', $this->data);
    $this->load->view('admin/includes/_footer');
  }


  //-----------------------------------------------------------
  public function review_status(){
    $this->rbac->check_operation_access(); // check opration permission
    $review_id = $this->uri->segment(4);
    $this->data['single'] = $this->Base_model->_single_data_query(array('review_id'=>$review_id),'dk_review')->row();
    $data['review_status'] = $this->uri->segment(5) == '1' ? '0' : '1';
    if($this->Base_model->_update_query('dk_review',$data,array('review_id'=>$review_id))) {
      $this->session->set_flashdata('success', 'bidding Status has been changed successfully');
      redirect($_SERVER['HTTP_REFERER']);
    }else{
        $this->session->set_flashdata('errors', 'bidding Status has not been changed successfully');
      redirect($_SERVER['HTTP_REFERER']);
    }
  }


  public function review_edit(){

    $this->rbac->check_operation_access(); // check opration permission
    $review_id = $this->uri->segment(4);
    $this->data['single'] = $this->Base_model->_single_data_query(array('review_id'=>$review_id),'dk_review')->row_array();
    $this->form_validation->set_rules('review_id', 'review_id', 'required');
        if($this->form_validation->run() == true){ 
            $review_job_post_id = $this->input->post('review_job_post_id');
            $review_id = $this->input->post('review_id');
            $data['review_job_post_id'] = $review_job_post_id;
            $data['review_customer_id'] = $this->input->post('review_customer_id');
            $data['review_rating'] = $this->input->post('review_rating');
            $data['review_comment'] = $this->input->post('review_comment');
            $data['review_update_at']  = date('Y-m-d H:i:s');
            if($this->Base_model->_update_query('dk_review',$data,array('review_id'=>$review_id))) {
              $this->session->set_flashdata('success', 'review have been successfully created !');
            }else{
                $this->session->set_flashdata('error', 'Some have error ! please try again ');
            }
            redirect('admin/jobpost/view/'.$review_job_post_id);
        }



    $this->data['customer_name'] = $this->Base_model->_dropdownlist('customer_id','customer_full_name',array('customer_status'=>'1','customer_type'=>'1'),'dk_customer','Select Customer Name','');
    $this->data['title'] = '';
    $this->load->view('admin/includes/_header');
    $this->load->view('admin/jobpost/review-edit', $this->data);
    $this->load->view('admin/includes/_footer');
  }


   //------------------------------------------------------------
  public function review_delete($review_id=''){
    $this->rbac->check_operation_access(); // check opration permission
    $review_id = $this->uri->segment(4);
    if($this->Base_model->_delete_query('dk_review',array('review_id'=>$review_id))) 
    {
      $this->session->set_flashdata('success','review has been deleted Successfully.'); 
      redirect($_SERVER['HTTP_REFERER']);
    }
  }


}

?>
