<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
	var $user_id;
	public function __construct() {
        parent::__construct();
		$this->user_id = $this->session->userdata('id');
		$this->load->model('admin/login_model');
    }
	
	public function index(){
		$this->load->view('admin/login');
	}
	
	public function admin_process(){
		$data['email'] = strtolower(trim($this->input->post('Email')));
		$data['password'] = trim(sha1($this->input->post('Password')));
		$res = $this->login_model->getUserByEmail($data['email']);
		if(count($res) > 0){
			$user = array();
			foreach($res as $uv){
				if($uv['password'] == $data['password'] && $uv['email'] == $data['email']){
					$user = $uv;
				}
			}
			if(!empty($user)){
				$this->session->set_userdata($user);
				redirect('admin/dashboard');
			}else{
				$msg = get_message('Enter valid email or password',1);
				$this->session->set_flashdata('message',$msg);
				redirect('admin/login');
			}
		}else{
			$msg = get_message('Enter valid email or password',1);
			$this->session->set_flashdata('message',$msg);
			redirect('admin/login');
		}
		redirect('admin/login/dashboard');
	}
	
	public function sub_admin_process(){
		$data['email'] = strtolower(trim($this->input->post('Email')));
		$data['password'] = trim(sha1($this->input->post('Password')));
		$res = $this->login_model->getUserByEmailSubAdmin($data['email']);
		
		if(count($res) > 0){
			$user = array();
			foreach($res as $uv){
				if($uv['password'] == $data['password'] && strtolower(trim($uv['email'])) == $data['email']){
					$user = $uv;
				}
			}
			
			if(!empty($user)){
				$this->session->set_userdata($user);
				redirect('admin/dashboard');
			}else{
				$msg = get_message('Enter valid email or password',1);
				$this->session->set_flashdata('message',$msg);
				redirect('admin/login');
			}
		}else{
			$msg = get_message('Enter valid email or password',1);
			$this->session->set_flashdata('message',$msg);
			redirect('admin/login');
		}
		redirect('admin/login/dashboard');
	}
	
	
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('admin/login'));
	}
	
	public function check(){
		pre($this->session->all_userdata());
	}
}