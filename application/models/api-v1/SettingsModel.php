<?php  if(!defined('BASEPATH')) Exit ('No Direct script access allowed');
class SettingsModel extends CI_Model{
	public function __construct()
	{
		parent::__construct();	
	}
	//get settings
	public function getsettings()
	{
		$this->db->select("*");
		$this->db->from("setting");
		$query = $this->db->get();
		return $query->result_array();
	}
	//site setting delete all record
	public function SettingsDelete()
	{
		return $this->db->empty_table('site_settings');
	}
	//site setting add
	public function Dosettings($datanew)
	{
		return $this->db->insert('site_settings',$datanew);
	}
	
	
	// get payment gateways
	public function getPaymentGateways()
	{
	    $this->db->select("*");
		$this->db->from("payment_gateways");
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function DoPaymentGateway($datanew)
	{
	    return $this->db->insert('payment_gateways',$datanew);
	}
	
}