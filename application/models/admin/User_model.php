<?php
class User_model extends CI_Model{
	var $tbl_user = 'v2s_user';
	var $tbl_role = "v2s_role";
	var $tbl_mobile = "v2s_mobile";
	var $tbl_otp = "v2s_password";
	var $tbl_location = 'v2s_location';
	var $tbl_city = 'v2s_city';
	var $tbl_state = 'v2s_state';
	
	function getDownRole(){
		return $this->db->select('*')->from($this->tbl_role)->where('delete_flag = 0 AND role > '.$this->session->userdata('role'))->order_by('role','DESC')->get()->result_array();
	}
	
	function add_user($data){
		return $this->db->insert($this->tbl_user,$data);
	}
	
	function add_pass($pass){
		return $this->db->insert($this->tbl_otp,array('otp'=>$pass,'type'=>1,'insertDate'=>$this->datetime,'insertBy'=>$this->user_id,'insertIp'=>$this->input->ip_address()));
	}
	
	function set_user_pass($set = array(), $where = array()){
		return $this->db->set($set)->where($where)->update($this->tbl_otp);
		
	}
	
	function get_users(){
		$select = "CONCAT(u.firstname,' ',u.lastname) as uname, u.id as uid, u.profile as upic, u.email as uemail, u.mobile as umobile, u.role as unrole, rl.name as urname,u.pincode as pincode,u.password as password";
		$this->db->select($select);
		$this->db->from($this->tbl_user.' u');
		$this->db->join($this->tbl_role.' rl','u.role = rl.role');
		$this->db->where('rl.delete_flag = 0 AND u.delete_flag = 0 AND u.role = 20');
		return $this->db->order_by('u.role','ASC')->get()->result_array();
	}
	function edit_user($user_id){
		$select = "u.firstname as firstname, u.lastname as lastname,CONCAT(u.firstname,' ',u.lastname) as uname, u.id as uid, u.profile as upic, u.email as uemail, u.mobile as umobile, u.role as unrole, u.password as password, rl.name as urname,u.pincode as pincode";
		$this->db->select($select);
		$this->db->from($this->tbl_user.' u');
		$this->db->join($this->tbl_role.' rl','u.role = rl.role');
		$this->db->where('rl.delete_flag = 0 AND u.id = '.$user_id.'');
		return $this->db->order_by('u.role','ASC')->get()->result_array();	
	}
	function delete_user($admin_id){
		$this->db->set('delete_flag','1');
		$this->db->where('id',$admin_id);
		return $this->db->update($this->tbl_user);
	}
	function update_user($data,$admin_id){
		$this->db->where('id', $admin_id);
		$result = $this->db->update($this->tbl_user, $data);
		if($result){
			return true;	
		}
	}
	function get_model_data($userid){
		$select = "l.*,l.id as location_id,u.*,(select GROUP_CONCAT(mobile) AS mobile_list from ".$this->tbl_mobile." where location_id = l.id) as mobile_number,CONCAT(u.firstname,' ',u.lastname) as uname,(select city_name from ".$this->tbl_city." where city_id = l.city_id) as city_name ,(select state_name from ".$this->tbl_state." where state_id = l.state_id) as state_name, u.id as uid, u.profile as upic, u.email as uemail, u.mobile as umobile, u.role as unrole, rl.name as urname,u.pincode as pincode";
		$this->db->select($select);
		$this->db->from($this->tbl_user.' u');
		$this->db->join($this->tbl_role.' rl','u.role = rl.role','left');
		$this->db->join($this->tbl_location. ' l','l.insertBy = u.id','left');
		$this->db->where('rl.delete_flag = 0 AND u.delete_flag = 0 AND u.id = '.$userid.'');
		return $this->db->order_by('l.id','DESC')->get()->result_array();
	}
	function get_mobile_no($mobile_id){
		 return $this->db->select('*')->from($this->tbl_mobile)->where('location_id = '.$mobile_id.'')->get()->result_array();
	}
}