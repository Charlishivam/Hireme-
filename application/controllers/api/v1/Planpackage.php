<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'libraries/api-libraries/API_Controller.php'; // for load

class Planpackage extends API_Controller {

    public function __construct() {
        parent::__construct();
        
    }
    
    public function list(){
        $this->_apiConfig([
            'methods' => ['GET'],
            'key' => ['header',$this->config->item('api_fixe_header_key')],
        ]);
        $category = $this->BaseModel->_ci_data_query(array('pc_status'=>'1'),'park_plan_category','pc_id,pc_name,pc_renewal_alerts,pc_buyer_inquiry');
        
        if($category->num_rows() <= 0){
            $this->api_return(array('status' =>true,'error' => 'Data not Found !'),self::HTTP_OK);exit;
        }
        
        foreach($category->result() as $key => $data){
            $category->result()[$key]->plans = $this->BaseModel->_ci_data_query(array('packege_plan_id'=>$data->pc_id),'park_plan_packege','packege_id,packege_coin,packege_amount')->result();
        }
        $this->api_return(array('status' =>true,'error' => 'Data Found !','data'=>$category->result()),self::HTTP_OK);exit;
    }
}
    

