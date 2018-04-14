<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Dashboard extends CI_Controller {

	var $user_id;

	public function __construct() {

        parent::__construct();

		checkAuth();

		$this->user_id = $this->session->userdata('id');

		$this->load->model('admin/dashboard_model');

    }

	

	public function index(){

		$data['total_user'] = $this->dashboard_model->all_users();
		$data['total_location'] = $this->dashboard_model->all_locations();

		$this->load->view('admin/dashboard',$data);

	}
	
	/*public function edit_profile(){

		$user_id = base64_decode($this->uri->segment('4'));

		$data['role'] = $this->dashboard_model->getDownRole();

		$data['edit_user'] = $this->dashboard_model->edit_user($user_id);

		$this->load->view('admin/user/form',$data);

		

	}*/
	

	

	

	

}