<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('checkAuth')){
   function checkAuth(){
       $ci =& get_instance();
       $ci->load->library('session');
       $sess = $ci->session->userdata('id');
       if(!$sess){
		   /*if($ci->input->is_ajax_request()){
			   	exit;
		   }else{
			   	if($ci->uri->segment(1) != 'assets')$ci->session->set_userdata('last_url',base_url($ci->uri->uri_string()));*/
			redirect(base_url('login'));exit;
		  // }
	   }
   }
}