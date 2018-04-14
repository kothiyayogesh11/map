<?php

class Location_model extends CI_Model{

	var $tbl_state = 'v2s_state';

	var $tbl_city = 'v2s_city';

	var $tbl_location = 'v2s_location';

	var $tbl_mobile = 'v2s_mobile';

	var $tbl_business_category = 'v2s_business_category';
	
	var $tbl_location_category = 'v2s_location_category';
	

	function select_state(){

		return $this->db->select('*')->from($this->tbl_state)->get()->result_array();

	}

	function select_city($get_state_id){

		return $this->db->select('*')->from($this->tbl_city)->where('state_id = '.$get_state_id.'')->get()->result_array();

	}
	
	function select_location_category(){
		return $this->db->select('*')->from($this->tbl_location_category)->where('delete_flag = 0')->get()->result_array();
	}

	function insert_location($data){

		$this->db->insert($this->tbl_location,$data);

		return $insert_id = $this->db->insert_id();	

	}

	function insert_mobile_data($mobile_data){

		return $this->db->insert($this->tbl_mobile,$mobile_data);

	}

	function get_location(){
		if(!empty($this->session->userdata('role'))&& ($this->session->userdata('role') == '10')){
		
			$select = "l.*,l.id as locationid,(select GROUP_CONCAT(mobile) AS mobile_list from v2s_mobile where location_id = l.id) as mobile_number,(select city_name from v2s_city where city_id = l.city_id) as city_name,(select state_name from v2s_state where state_id = l.state_id) as state_name,(select name from v2s_business_category where id = l.category_id) as cat_name";
	
			$this->db->select($select);
	
			$this->db->from($this->tbl_location.' l');
	
			$this->db->where('l.delete_flag = 0');
	
			return $this->db->order_by('l.id','DESC')->get()->result_array();	
		}
		if(!empty($this->session->userdata('role'))&& ($this->session->userdata('role') == '20')){
			$user_uid = $this->session->userdata('id'); 
			$select = "l.*,l.id as locationid,(select GROUP_CONCAT(mobile) AS mobile_list from v2s_mobile where location_id = l.id) as mobile_number,(select city_name from v2s_city where city_id = l.city_id) as city_name,(select state_name from v2s_state where state_id = l.state_id) as state_name,(select name from v2s_business_category where id = l.category_id) as cat_name";
	
			$this->db->select($select);
	
			$this->db->from($this->tbl_location.' l');
	
			$this->db->where('l.delete_flag = 0 AND l.insertBy = '.$user_uid.'');
	
			return $this->db->order_by('l.id','DESC')->get()->result_array();	
		}

	}

	function edit_location($location_id){

		return $this->db->select('*')->from($this->tbl_location)->where('id ='.$location_id)->get()->result_array();

	}

	function select_mobile_list($location_id){

		return $this->db->select('*')->from($this->tbl_mobile)->where('location_id = '.$location_id)->get()->result_array();

	}

	function get_city(){

		return $this->db->select('*')->from($this->tbl_city)->get()->result_array();

	}

	function update_location($data,$location_id){

		$this->db->where('id', $location_id);

		$result = $this->db->update($this->tbl_location, $data);

		if($result){

			return true;	

		}

	}

	function select_category(){

		return $this->db->select('*')->from($this->tbl_business_category)->get()->result_array();

	}

	function check_unique_code($random_unique_int){

		$where = 'unique_code='.$random_unique_int.'';

		return $this->db->select('unique_code')->from('v2s_location')->where($where)->get()->result_array();

	}

	function update_delete_location($location_id){

		$this->db->where('location_id', $location_id);

		return $this->db->delete($this->tbl_mobile);

	}

	function delete_location($location_id){

		$this->db->set('delete_flag','1');

		$this->db->where('id',$location_id);

		$this->db->update($this->tbl_location);

		

		$this->db->where('location_id', $location_id);

		return $this->db->delete($this->tbl_mobile);

		

	}

	function get_mobile_no($mobile_id){

		return $this->db->select('*')->from($this->tbl_mobile)->where('location_id='.$mobile_id.'')->get()->result_array();

	}

}