<?php

class Dashboard_model extends CI_Model{

	var $tbl_user = 'v2s_user';
	var $tbl_locations = 'v2s_location';

	

	function all_users(){

		$select = "*";

		$this->db->select($select);

		$this->db->from($this->tbl_user.' u');

		$this->db->where('delete_flag = 0 AND role = 20');

		return $this->db->order_by('role','ASC')->get()->result_array();

	}	
	function all_locations(){

		 if(!empty($this->session->userdata('role'))&& ($this->session->userdata('role') == '10')){
			$select = "*";
	
			$this->db->select($select);
	
			$this->db->from($this->tbl_locations.' l');
	
			$this->db->where('delete_flag = 0');
	
			return $this->db->get()->result_array();
		 }
		 if(!empty($this->session->userdata('role'))&& ($this->session->userdata('role') == '20')){
			$user_uid = $this->session->userdata('id'); 
			 
			$select = "*";
	
			$this->db->select($select);
	
			$this->db->from($this->tbl_locations.' l');
	
			$this->db->where('delete_flag = 0 AND l.insertBy = '.$user_uid.'');
	
			return $this->db->get()->result_array();  
		 }

	}
		
	
	

}