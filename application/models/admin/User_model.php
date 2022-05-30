<?php
	class User_model extends CI_Model{

		public function add_user($data){
			$this->db->insert('ci_users', $data);
			return true;
		}


		public function add_address($data){
			$this->db->insert('address_list', $data);
			return true;
		}


		public function allUser(){
		    
		  //  $this->db->from('customer');
    // 		$this->db->join('userwallet','userwallet.user_id=customer.customer_id');
    		
    // 		$query = $this->db->get();
    //         return $query->result_array();

			$this->db->from('customer');
			$query=$this->db->get();
			return $query->result_array();
		}
		//---------------------------------------------------
		// get all users for server-side datatable processing (ajax based)
		public function get_all_users(){
		    
		    
		    
		  
		    
		    
			$wh =array();
			$SQL ='SELECT * FROM ci_users';
			$wh[] = " is_admin = 0";
			if(count($wh)>0)
			{
				$WHERE = implode(' and ',$wh);
				return $this->datatable->LoadJson($SQL,$WHERE);
			}
			else
			{
				return $this->datatable->LoadJson($SQL);
			}
		}


		//---------------------------------------------------
		// Get user detial by ID
		public function get_user_by_id($id){
			$query = $this->db->get_where('customer', array('customer_id' => $id));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
		// Edit user Record
		public function edit_user($data, $id){
			$this->db->where('customer_id', $id);
			$this->db->update('customer', $data);
			return true;
		}

		//---------------------------------------------------
		// Change user status
		//-----------------------------------------------------
		function change_status($id,$status)
		{		
			$this->db->set('status', $status);
			$this->db->where('customer_id ', $id);
			$this->db->update('customer');
		} 

		//---------------------------------------------------
		// get users for csv export
		public function get_users_for_export(){
			
			$this->db->where('is_admin', 0);
			$this->db->select('id, username, firstname, lastname, email, mobile_no, created_at');
			$this->db->from('ci_users');
			$query = $this->db->get();
			return $result = $query->result_array();
		}
		public function getCartItem()
		{
		    $this->db->from('cart');
    		$this->db->join('foodcategory','cart.cat_id=foodcategory.foodcategory_id');
    		$this->db->join('services','cart.service_id=services.id');
    		$this->db->join('customer','cart.user_id=customer.customer_id');
    // 		$this->db->order_by('grants_id','desc');
    // 		$this->db->limit($limit, $offset);
    		$query = $this->db->get();
            return $query->result_array();
		}
		public function get_wallet_by_id($id)
		{
		    $res=$this->db->query("select * from userwallet where user_id='$id'");
		    return $res->result_array();
		}
		public function get_details($id)
		{
		    $sql="select * from customer where customer_id='$id'";
		    $res=$this->db->query($sql);
		    return $res->row();
		}
		public function transaction($data)
		{
		    $res=$this->db->insert('userwallet',$data);
		}

		public function get_user_details_by_id($id)
	    {
			$this->db->from('customer');
			$this->db->where('customer_id',$id);
			$query=$this->db->get();
			return $query->row();
	    }


	    public function _get_time_schedule($id)
	    {
			$this->db->from('time_schdule');
			$this->db->where('id',$id);
			$query=$this->db->get();
			return $query->row();
	    }

	    public function get_add_by_customer($id)
	    {
	    	$this->db->select('id,address');
			$this->db->from('address_list');
			$this->db->where('user_id',$id);
			$query=$this->db->get();
			return $query->row();
	    }


	  //   public function getTotalAmount(){
	  //   	$data=$this->db
			//     ->select_sum('balance')
			//     ->from('userwallet')
			//     ->where('user_id', $id);
			//     ->get();
			// return $data->result_array();
	  //   }

			//get wallet amount
		    public function _get_user_wallet_records($id) {
		        try {
		            $query = $this->db->query("SELECT sum( case when transaction_type='1' then amount else  0 end) as add_amount,sum( case when transaction_type='2' then amount else  0 end) as minus_amount FROM userwallet where user_type='1' AND user_id='$id'");
		            return $query->row();
		        } catch (\Throwable $th) {
		            //echo $th->getMessage();
		        }
		    }

		 

	    public function _get_all_customer_records(){
	        $this->db->select('*');
	        $query =  $this->db->get('customer');

	        $data[''] ='Select Customer';
	        
	        foreach ($query->result_array() as $row) {
	        	if($row['full_name']){
	        		$data[$row['customer_id']] = $row['full_name'];

	        	}else{
	        		$data[$row['customer_id']] = $row['mobile'];
	        	}
	           
	        }
	        return $data;
	    }


	    public function _get_single_booking_records($bookingid)
		{

			$this->db->select('bookings.customer_id,bookings.service_id as bookings_service,bookings.addon_id as bookingsaddon,bookings.booking_id,bookings.amount_before_des,bookings.status as booking_status,bookings.total_charge,bookings.addon_amount,bookings.pay_mode,bookings.vendor_id,bookings.address_id,services_bookings.booking_id,services_bookings.quantity as services_bookings_quantity,addon_booking.booking_id,addon_booking.quantity as addon_booking_quantity,addon_booking.amount as addon_booking_amount,services_bookings.amount as serive_booking_amount');
			$this->db->from('bookings');
			$this->db->where('bookings.booking_id',$bookingid);
			$this->db->where('addon_booking.booking_id',$bookingid);
			$this->db->where('services_bookings.booking_id',$bookingid);
			$this->db->where('bookings.status',5);
			$this->db->join('addon_booking','bookings.booking_id=addon_booking.booking_id','LEFT');
			$this->db->join('time_schdule','bookings.time_schedule_id=time_schdule.id','LEFT');
			$this->db->join('services_bookings','bookings.booking_id=services_bookings.booking_id','LEFT');
			$query = $this->db->get();
	        return $query->result();

		
		}




	 

	   


	    public function _get_all_services_records(){
	    	 $this->db->from('services');
					$query=$this->db->get();
			 return $query->result_array();
	      
	    }

	    public function _get_all_addon_records(){
	    	 $this->db->from('product');
					$query=$this->db->get();
			 return $query->result_array();
	      
	    }
	    public function _get_all_vendor_records(){
	        $this->db->select('id,username,mobile');
	        $query =  $this->db->get('vendor');

	        $data[''] ='Select Vendor';
	        
	        foreach ($query->result_array() as $row) {

	        	if($row['username']){
	        		$data[$row['id']] = $row['username'];

	        	}else{
	        		$data[$row['id']] = $row['mobile'];
	        	}
	        	
	        		
	        }
	        return $data;
	    }

	    public function _get_all_schdule_records(){
	        $this->db->select('id,start_time,end_time');
	        $query =  $this->db->get('time_schdule');

	        $data[''] ='Select Schdule';
	        
	        foreach ($query->result_array() as $row) {
	        	
	        		$data[$row['id']] = $row['start_time']."&nbspTo&nbsp".$row['end_time'];
	        }
	        return $data;
	    }


	    public function _service_category($id)
	    {
	        $this->db->select('*');
	        $this->db->select('SUM(new_price) as sumTotal');
	        $this->db->where('id in ('.$id.')');
	        $query =  $this->db->get('services');

	        $data[''] ='Select Category';

	        foreach ($query->result_array() as $row) {
	            $data[$row['cat_id']] = $row['cat_name'];
	        }
	        return $data;
	    }


	    public function _get_all_service_amount($id) {
	        if ($id) {
	            $this->db->select('SUM(new_price) as serviceTotal');
	            $this->db->from('services');
	            $this->db->where('id in ('.$id.')');
	            $advance = $this->db->get();
	            if ($advance->num_rows() > 0) {
	                return $advance->row();
	            } else {
	                return FALSE;
	            }
	        } else {
	            return FALSE;
	        }
	    }

	    public function _get_all_addon_amount($id) {
	        if ($id) {
	            $this->db->select('SUM(sell_price) as addonTotal');
	            $this->db->from('product');
	            $this->db->where('product_id in ('.$id.')');
	            $advance = $this->db->get();
	            if ($advance->num_rows() > 0) {
	                return $advance->row();
	            } else {
	                return FALSE;
	            }
	        } else {
	            return FALSE;
	        }
	    }

	    public function create_customer_booking($data){
    		$this->db->insert('bookings',$data);
    		return $this->db->insert_id();
    	}

    	public function _booking_service_insert($data){
    		$this->db->insert('services_bookings',$data);
    		return $this->db->insert_id();
    	}

    	public function _booking_addon_insert($data){
    		$this->db->insert('addon_booking',$data);
    		return $this->db->insert_id();
    	}

	}

?>
