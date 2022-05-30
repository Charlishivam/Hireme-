<?php defined('BASEPATH') or exit('No direct script access allowed');
class BaseModel extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    public function __constomdo_uploads($dirpath,$inputname){
        /*check dir if nit exist then create dir */
        if (!is_dir($dirpath)){
            mkdir($dirpath,0777);exit;
        }

        $config['upload_path']  = $dirpath;
        $config['allowed_types']= 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
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
    
    public function _ci_data_query($where,$tbl,$select = null){
        if(!empty($select)){
            $this->db->select($select);
        }
        if(!empty($where)){
            $this->db->where($where);
        }
        return $this->db->get($tbl); 
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
    
    /*This function use to get sms template details */
    public function get_template_by_slug($slug){
        $this->db->select('*');
		$this->db->where('slug',$slug);
		$query=$this->db->get('sms_template');
		return $query->row_array();
    }
    
    /*This function use to get sms template details */
    public function get_notification_template_by_slug($slug){
        $this->db->select('*');
		$this->db->where('slug',$slug);
		$query=$this->db->get('park_notification_template');
		return $query->row_array();
    }
    
    public function _upload_Base64_image($imageData,$path){
        $imageData = 'data:image/jpeg;base64,'.$imageData;
        list($type, $imageData) = explode(';', $imageData);
        list(,$extension)       = explode('/',$type);
        list(,$imageData)       = explode(',', $imageData);
        $fileName               = uniqid().date('Y').'.'.$extension;
        $imageData              = base64_decode($imageData);
        file_put_contents($path.$fileName, $imageData);
        return $fileName;
    }
}
