<?php defined('BASEPATH') or exit('No direct script access allowed');
class ParkingModel extends CI_Model{
    
    protected $table = "park_space";
    
    public function __construct(){
        parent::__construct();
    }
    
    public function _find_parking_by_lat_lan($lat,$lan,$radius){
        //colomn name parking_latitude
        //colomn name parking_longitude
        $this->db->select("park_space.parking_id,parking_name,parking_address,parking_address2,parking_city,parking_flat_no,parking_landmark,parking_latitude,parking_longitude,parking_zipcode,parking_image,park_customer.customer_fullname
            ,3956 * 2 * ASIN(SQRT( POWER(SIN(('".$lat."' -abs(parking_latitude)) * pi()/180 / 2),2) + COS('".$lat."' * pi()/180 ) * COS(abs(parking_latitude) * pi()/180) * POWER(SIN(('".$lan."' - parking_longitude) * pi()/180 / 2), 2) )) as mels");
         $this->db->from($this->table);
         $this->db->join('park_customer','park_customer.customer_id= park_space.customer_id','left');
         $this->db->order_by('mels','asc');
         $this->db->where('parking_status','1');
         $this->db->having('mels < ',$radius,false);
         return $this->db->get();
    }
}