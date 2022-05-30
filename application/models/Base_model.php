<?php defined('BASEPATH') or exit('No direct script access allowed');
class Base_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    public function __constomdo_uploads($dirpath,$inputname){
        /*check dir if nit exist then create dir */
        if (!is_dir($dirpath)){
            mkdir($dirpath,0777);exit;
        }

        $config['upload_path']  = $dirpath;
        $config['allowed_types']= 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG|mov|mp4|3gp|ogg|gif|MOV|MP4|3GP|OGG|GIF';
        $config['max_size']     = '';
        $config['max_width']    = '';
        $config['max_height']   = '';
        $config['encrypt_name'] = false;
        $config['overwrite']    = false;
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        $this->upload->do_upload($inputname);
    }
    public function _dropdownlist($slect1, $slect2, $where, $tbl, $option = null,$orderby = null){
        $this->db->select($slect1 . ',' . $slect2);
        if ($where != "") {
            $this->db->where($where);
        }
        if ($orderby != null) {
            $this->db->order_by($orderby);
        }
        $query = $this->db->get($tbl);

        if ($option != null) {
            $data[''] = $option;
        }
        
        foreach ($query->result_array() as $row) {
            $data[$row[$slect1]] = $row[$slect2];
        }
        return $data;
    }   
        
    public function _run_query($sql){
        return $this->db->query($sql);
    }
        
    public function _inser_query($tbl,$data){
        $this->db->insert($tbl,$data);
        return $this->db->insert_id();
    }
    public function _get_all_data($tbl,$order){
        $this->db->order_by($orderby);
        return $this->db->get($tbl);
    }
    
    public function _delete_query($tbl,$where){
        $this->db->where($where);
        if($this->db->delete($tbl)){
            return true;
        }else{
            return false;
        } 
    }
    
    public function _update_query($tbl,$data,$where){
               $this->db->where($where);
        return $this->db->update($tbl, $data);
    }
    public function _single_data_query($where,$tbl,$select = null){
        if(!empty($select)){
            $this->db->select($select);
        }
        if(!empty($where)){
            return $this->db->get_where($tbl,$where);
        }else{
           return $this->db->get($tbl); 
        }
        
    }

    public function all_setting_data(){
        $this->db->select('*');
        $result = $this->db->get('setting')->result_array();
        $data   = array();
        foreach ($result as $key => $value) {
            $data[$value['setting_key']] = $value['setting_value'];
        }
        return $data;
    }

    public function _get_pagination($records){

        $currentURL = current_url(); //http://myhost/main
        $params   = $_SERVER['QUERY_STRING']; //my_id=1,3
        $fullURL = $currentURL . '?' . $params; 
        $this->load->library('pagination');
        $config['base_url']         = $fullURL;
        $config['page_query_string']= TRUE;
        $config['use_page_numbers'] = False;
        $config['total_rows']       = count($records);
        $config['per_page']         = 10;
        $config["cur_tag_open"]     = '<span class="btn btn-icon btn-sm border-0 btn-hover-primary active mr-2 my-1">';
        $config["cur_tag_close"]    = '</span>';
        $config['first_link']       = '<i class="ki ki-bold-double-arrow-back icon-xs"></i>';
        $config['last_link']        = '<i class="ki ki-bold-double-arrow-next icon-xs"></i>';
        $config['anchor_class']     = 'class="active"';
        $config['attributes']       = array('class' => 'btn btn-icon btn-sm border-0 btn-light mr-2 my-1');
        $this->pagination->initialize($config);
        $limitstart = $this->input->get('per_page') ? $this->input->get('per_page') : 0;
        $_GET['limit_per_page']     = $config['per_page'];
    }
}
