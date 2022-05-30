<?php
class Setting extends MY_Controller{

    function __construct(){

        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();
        $this->load->model('Base_model');
        $this->load->model('admin/Setting_model');
        $this->data['config'] = $this->Base_model->all_setting_data();
    }

  
      public function index(){
        $this->rbac->check_operation_access(); // check opration
        $this->load->view('admin/includes/_header');
        $this->data['title']  = 'Global Setting' ;
        $this->load->view('admin/setting/index-page',$this->data);
        $this->load->view('admin/includes/_footer');
      }

    public function update(){
        /*===================================================
        ====================Verification for=================
        =====================================================*/
        if($this->input->post('verification_form') == 'true'){

            if(!empty($this->input->post('verification_form'))){
                unset($_POST['verification_form']);
            }

            foreach($this->input->post() as $key => $value){
                
                if(!array_key_exists($key,$this->data['config'])){
                   $data['setting_key']   = $key;
                   $data['setting_value'] = $value;
                   $data['setting_create_at'] = date('Y-m-d H:i:s');
                   
                   $this->Base_model->_inser_query('setting',$data);
                }else{
                   $data['setting_key']   = trim($key);
                   $data['setting_value'] = !empty(trim($value)) ? $value : NULL ;
                   $data['setting_update_at'] = date('Y-m-d H:i:s');
                   $this->Base_model->_update_query('setting',$data,array('setting_key'=>trim($key)));
                }
            }
            $this->session->set_flashdata('success', 'Document verification setting data updated !');
            redirect('admin/setting');
        /*===================================================
        ====================Payment for======================
        =====================================================*/
        }else if($this->input->post('payment_form') == 'true'){

            if(!empty($this->input->post('payment_form'))){
                unset($_POST['payment_form']);
            }

            foreach($this->input->post() as $key => $value){
                
                if(!array_key_exists($key,$this->data['config'])){
                   $data['setting_key']   = $key;
                   $data['setting_value'] = $value;
                   $data['setting_create_at'] = date('Y-m-d H:i:s');
                   
                   $this->Base_model->_inser_query('setting',$data);
                }else{
                   $data['setting_key']   = trim($key);
                   $data['setting_value'] = !empty(trim($value)) ? $value : NULL ;
                   $data['setting_update_at'] = date('Y-m-d H:i:s');
                   $this->Base_model->_update_query('setting',$data,array('setting_key'=>trim($key)));
                }
            }
            $this->session->set_flashdata('success', 'Payment setting data updated !');
            redirect('admin/setting');
        /*===================================================
        ====================Google api form==================
        =====================================================*/
        }else if($this->input->post('google_form') == 'true'){
            /*This is Google api setting form */

            if(!empty($this->input->post('google_form'))){
                unset($_POST['google_form']);
            }

            foreach($this->input->post() as $key => $value){
                if(!array_key_exists($key,$this->data['config'])){
                   $data['setting_key']   = $key;
                   $data['setting_value'] = $value;
                   $data['setting_create_at'] = date('Y-m-d H:i:s');
                   
                   $this->Base_model->_inser_query('setting',$data);
                }else{
                   $data['setting_key']   = trim($key);
                   $data['setting_value'] = !empty(trim($value)) ? $value : NULL ;
                   $data['setting_update_at'] = date('Y-m-d H:i:s');
                   $this->Base_model->_update_query('setting',$data,array('setting_key'=>trim($key)));
                }
            }
            $this->session->set_flashdata('success', 'Google Api setting data updated !');
            redirect('admin/setting');
        /*===================================================
        ====================Referral api form================
        =====================================================*/
        }else if($this->input->post('referral_form') == 'true'){
            /*This is Google api setting form */

            if(!empty($this->input->post('referral_form'))){
                unset($_POST['referral_form']);
            }

            foreach($this->input->post() as $key => $value){
                if(!array_key_exists($key,$this->data['config'])){
                   $data['setting_key']   = $key;
                   $data['setting_value'] = $value;
                   $data['setting_create_at'] = date('Y-m-d H:i:s');
                   
                   $this->Base_model->_inser_query('setting',$data);
                }else{
                   $data['setting_key']   = trim($key);
                   $data['setting_value'] = !empty(trim($value)) ? $value : NULL ;
                   $data['setting_update_at'] = date('Y-m-d H:i:s');
                   $this->Base_model->_update_query('setting',$data,array('setting_key'=>trim($key)));
                }
            }
            $this->session->set_flashdata('success', 'Referral setting data updated !');
            redirect('admin/setting');
        }else if($this->input->post('parking_commision_form') == 'true'){
            /*This is Google api setting form */

            if(!empty($this->input->post('parking_commision_form'))){
                unset($_POST['parking_commision_form']);
            }

            foreach($this->input->post() as $key => $value){
                if(!array_key_exists($key,$this->data['config'])){
                   $data['setting_key']   = $key;
                   $data['setting_value'] = $value;
                   $data['setting_create_at'] = date('Y-m-d H:i:s');
                   
                   $this->Base_model->_inser_query('setting',$data);
                }else{
                   $data['setting_key']   = trim($key);
                   $data['setting_value'] = !empty(trim($value)) ? $value : NULL ;
                   $data['setting_update_at'] = date('Y-m-d H:i:s');
                   $this->Base_model->_update_query('setting',$data,array('setting_key'=>trim($key)));
                }
            }
            $this->session->set_flashdata('success', 'Parking Commission data updated !');
            redirect('admin/setting');
        }  
    }

}