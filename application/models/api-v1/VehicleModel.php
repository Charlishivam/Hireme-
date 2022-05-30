<?php defined('BASEPATH') or exit('No direct script access allowed');
class VehicleModel extends CI_Model{
    
    protected $table = "park_customer";
    
    public function __construct(){
        parent::__construct();
    }
    
    public function _search_by_lat_log($picuplat,$picuplag,$miles){
       $miles = ($miles * 0.621371);
       return $this->BaseModel->_run_query("select *,3956 * 2 * ASIN(SQRT( POWER(SIN(('".$picuplat."' -abs(tbl_1.parking_latitude)) * pi()/180 / 2),2) + COS('".$picuplat."' * pi()/180 ) * COS( abs(tbl_1.parking_latitude) * pi()/180) * POWER(SIN(('".$picuplag."' - tbl_1.parking_longitude) * pi()/180 / 2), 2) )) as parking_distance FROM park_space tbl_1 where parking_status='1' having parking_distance <= ".$miles." ORDER BY parking_distance");
    }
}