<?php
class Login_model extends CI_Model{
	var $tbl_user = 'v2s_user';
	
	function getUserByEmail($email = NULL){
		return $this->db->get_where($this->tbl_user,array('LOWER(email)'=>$email,'role'=>'10'))->result_array();
	}
	
	function getUserByEmailSubAdmin($email = NULL){
		return $this->db->get_where($this->tbl_user,array('LOWER(email)'=>$email,'role'=>'20'))->result_array();
	}
	
}