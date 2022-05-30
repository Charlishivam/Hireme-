<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Html extends MY_home_Controller {

    public function __construct() {
        parent::__construct();
        
    }
    public function smartandsafe(){
         $this->data['record'] = $this->BaseModel->_single_data_query(array('smartsafe_status'=>1),'park_smartsafe')->result_array();
         $this->load->view('app-view/smart-us-page',$this->data);
       
    }
    public function aboutus(){
        $this->data['single'] = $this->BaseModel->_single_data_query(array('about_status'=>1),'park_about_page')->row_array();
        $this->data['ourteam'] = $this->BaseModel->_single_data_query(array('ourteam_status'=>'1'),'park_ourteam')->result_array();
        $this->load->view('app-view/about-us-page',$this->data);
    }
}