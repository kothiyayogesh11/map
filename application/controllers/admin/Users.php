<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	var $user_id;

	var $datetime;

	public function __construct() {

        parent::__construct();

		checkAuth();

		$this->user_id = $this->session->userdata('id');

		$this->datetime = date('Y-m-d H:i:s');

		$this->load->model('admin/user_model');

    }

	

	public function index(){

		$data['list'] = $this->user_model->get_users();

		$this->load->view('admin/user/list',$data);

	}

	

	function form(){

		$data['role'] = $this->user_model->getDownRole();

		$this->load->view('admin/user/form',$data);

	}

	

	function process(){

		$admin_id = $this->input->post('admin_id');

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		$this->form_validation->set_rules('first_name', 'First Name', 'required|min_length[2]');

		$this->form_validation->set_rules('last_name', 'Last Name', 'required|min_length[2]');

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

		$this->form_validation->set_rules('pincode', 'Pincode', 'required|min_length[6]|max_length[6]');

		

		

		

		if ($this->form_validation->run() == FALSE){

			$data['role'] = $this->user_model->getDownRole();

			$this->load->view('admin/user/form',$data);

		}else{

			if($admin_id == '')

			{

				if(isset($_FILES["user_image"]["name"]) && $_FILES["user_image"]["name"] != ''){

					$temporary = explode(".", $_FILES["user_image"]["name"]);

					$file_extension = end($temporary);

					$image = 'user_logo'.time().'.'.$file_extension;

					$config['file_name'] = $image;

					$config['upload_path']          = 'assets/images/user_profile';

					$config['allowed_types']        = '*';

					$this->load->library('upload', $config);

					if (! $this->upload->do_upload('user_image')){

						$images = '';

						$msg['msg'] = get_message($this->upload->display_errors(),1);

						$this->session->set_flashdata('message',$msg['msg']);

						redirect(base_url('admin/users/form'));

					}else{ 

						$logo = $this->upload->data();

						$images = 'assets/images/user_profile/'.$image;	

					}

				}else{

					$images = '';

				}

				

				$pass = unique_digit(10,'v2s_password','otp');

				if($pass != ''){

					$insPass = $this->user_model->add_pass($pass);

					$pass_id = $this->db->insert_id();

				}

				

				$data['password'] = trim(sha1($this->input->post('password')));

				$data['firstname'] = $this->input->post('first_name');

				$data['lastname'] = $this->input->post('last_name');

				$data['profile'] = $images;

				$data['email'] = $this->input->post('email');

				//$data['password'] = sha1($pass);

				$data['mobile'] = $this->input->post('mobile');

				$data['pincode'] = $this->input->post('pincode');

				$data['role'] = $this->input->post('role');

				$data['insertDate'] = $this->datetime;

				$data['insertBy'] = $this->user_id;

				$data['insertIp'] = $this->input->ip_address();

				$res = $this->user_model->add_user($data);

				if($res){

					$uid = $this->db->insert_id();

					$up = $this->user_model->set_user_pass(array('user_id'=>$uid),array('id'=>$pass_id));

					$msg = get_message('Sub admin added successfully...',0);

				}else{

					$msg = get_message('Failed to add sub admin',1);

				}

				$this->session->set_flashdata('message',$msg);

				redirect(base_url('admin/users'));

			}

			if($admin_id != ''){

				if(isset($_FILES["user_image"]["name"]) && $_FILES["user_image"]["name"] != ''){

					$temporary = explode(".", $_FILES["user_image"]["name"]);

					$file_extension = end($temporary);

					$image = 'user_logo'.time().'.'.$file_extension;

					$config['file_name'] = $image;

					$config['upload_path']          = 'assets/images/user_profile';

					$config['allowed_types']        = '*';

					$this->load->library('upload', $config);

					if (! $this->upload->do_upload('user_image')){

						$images = '';

						$msg['msg'] = get_message($this->upload->display_errors(),1);

						$this->session->set_flashdata('message',$msg['msg']);

						redirect(base_url('admin/users/form'));

					}else{ 

						$logo = $this->upload->data();

						$images = 'assets/images/user_profile/'.$image;

						$data['profile'] = $images;	

					}

				}

				if($this->input->post('pass') != ''){

					$data['password'] = trim(sha1($this->input->post('pass')));

				}

				

				$data['firstname'] = $this->input->post('first_name');

				$data['lastname'] = $this->input->post('last_name');

				$data['email'] = $this->input->post('email');

				$data['mobile'] = $this->input->post('mobile');

				$data['pincode'] = $this->input->post('pincode');

				$check['role'] = $this->input->post('role');

				if($check['role'] != ''){

					$data['role'] = $check['role'];	

				}

				$data['updateDate'] = $this->datetime;

				$data['updateBy'] = $this->user_id;

				$data['updateIp'] = $this->input->ip_address();

				

				$res = $this->user_model->update_user($data,$admin_id);

				if($res){

					$msg = get_message('Sub admin update successfully...',0);

				}else{

					$msg = get_message('Failed to update sub admin',1);

				}

				$this->session->set_flashdata('message',$msg);

				redirect(base_url('admin/users'));

			}

		}	

	}

	

	public function edit_admin(){

		$user_id = base64_decode($this->uri->segment('4'));

		$data['role'] = $this->user_model->getDownRole();

		$data['edit_user'] = $this->user_model->edit_user($user_id);

		$this->load->view('admin/user/form',$data);

		

	}

	

	public function delete_admin(){

		$admin_id = base64_decode($this->uri->segment('4'));

		$strQuery = $this->user_model->delete_user($admin_id);

		if($strQuery){

			$msg = get_message('Subadmin deleted successfully...',0);

		}

		$this->session->set_flashdata('message',$msg);

		redirect(base_url('admin/users'));	

	}

	public function view_admin_details(){

		$model[] = array();

		$view = '';

		$modelid = $this->input->post('id');

		$result['model_data'] = $this->user_model->get_model_data($modelid);

		

			$view .= '<div class="text-center"><h4 style=" border: 1px solid #ccc; background-color: #ccc;">'.ucwords($result['model_data'][0]['uname']).'</h4>';

			$view .= '<div class="content"><div class="row"><div class="col-sm-12"><table id="example" class="display dataTable no-footer" role="grid" aria-describedby="example_info"><thead><tr><th>Address</th><th>City Name</th><th>State Name</th><th>Mobile No.</th></tr></thead><tbody>';

			if(!empty($result['model_data']) && $result['model_data'][0]['address'] != ''){

				foreach($result['model_data'] as $model){

					$view .= ' <tr><td>'.ucwords($model['address']).'</td><td>'.ucwords($model['city_name']).'</td><td>'.ucwords($model['state_name']).'</td><td><a class="openModal_new" id="new_mobile_model" data-toggle="modal" href="#MobileModel" data-id="'.$model['location_id'].'" onclick="new_mobile();">View</a></td>';

				}

			}else{

				$view .= '<tr><td colspan="5">No Location is added by Subadmin.</td>';

			}

			$view .= '</tr></thread></table>';

			$view .= '<div></div></div></div>';

			$model['model_view'] = $view;

		echo json_encode($model);

	}	

	

	public function view_model_mobile(){

		$model_new[] = array();

		$view_new = '';

		$mobile_id = $this->input->post('id');

		$result['model_data_new'] = $this->user_model->get_mobile_no($mobile_id);

			$view_new .= '<div class="content"><div class="col-sm-12"><table id="example" class="display dataTable no-footer" role="grid" aria-describedby="example_info"><thead><tr><th>Contact No.</th></tr></thead><tbody>';

			if(!empty($result['model_data_new'])){

				foreach($result['model_data_new'] as $model_new){

					$view_new .= ' <tr><td>'.$model_new['mobile'].'</td>';

				}

			}else{

				$view_new .= '<tr><td colspan="5">No Mobile is availble.</td>';

			}

			$view_new .= '</tr></thread></table>';

			$view_new .= '<div></div></div>';

			$model_new['model_new_data'] = $view_new;

		echo json_encode($model_new);

	}

	

}