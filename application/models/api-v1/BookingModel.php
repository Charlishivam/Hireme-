<?php defined('BASEPATH') or exit('No direct script access allowed');
class BookingModel extends CI_Model{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function _single_booking_details($book_id){
       $result = $this->BaseModel->_run_query("select 
       park_booking.*,
       park_customer.customer_fullname,
       park_customer.customer_mobile,
       park_customer.customer_device_token,
       park_space.parking_name,
       park_space.customer_id as parking_customer_id,
       parking_address,
       parking_city,
       parking_time_in,
       parking_time_out,
       parking_address2,
       parking_image,
       parking_facilities,
       parking_id,
       pac.customer_device_token as owner_device_token from park_booking 
       left join park_customer on park_customer.customer_id=park_booking.book_customer_id 
       left join park_space on park_space.parking_id=park_booking.book_parking_id 
       left join park_customer pac on pac.customer_id=park_space.customer_id
       where park_booking.book_id='".$book_id."' order by park_booking.book_id desc");
       
       return $result->row();
    }
    
}
