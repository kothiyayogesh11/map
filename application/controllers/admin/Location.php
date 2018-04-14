<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Location extends CI_Controller {

	public function __construct() {

        parent::__construct();

		checkAuth();

		$this->user_id = $this->session->userdata('id');

		$this->datetime = date('Y-m-d H:i:s');

		$this->load->model('admin/Location_model');

    }

	

	public function index(){

		$data['location_list'] = $this->Location_model->get_location();

		$this->load->view('admin/location/list',$data);

	}

	

	function getLatLong($address){

		if(!empty($address)){

		   error_reporting(0);

		   $formattedAddr = str_replace(' ','+',$address);

		   $geocodeFromAddr = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddr.'&sensor=false'); 

		   $output = json_decode($geocodeFromAddr);

		   $data['latitude']  = $output->results[0]->geometry->location->lat; 

		   $data['longitude'] = $output->results[0]->geometry->location->lng;

		   if(!empty($data)){

			  return $data;

		   }else{

			  return false;

		   }

	    }else{

		   return false;   

	    }

	}

	

	public function insert_location(){

		error_reporting(0);

		$location_id = $this->input->post('location_id');

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		$this->form_validation->set_rules('name', 'Name', 'required|min_length[2]');

		$this->form_validation->set_rules('address', 'Address', 'required|min_length[2]');

		$this->form_validation->set_rules('latitude', 'Latitude', 'required|min_length[2]');

		$this->form_validation->set_rules('longitude', 'Longitude', 'required|min_length[2]');

		$this->form_validation->set_rules('pincode', 'Pincode', 'required|min_length[6]|max_length[6]');

		if($location_id == ''){

			//$this->form_validation->set_rules('phone', 'Contact No.', 'required');

		}

		if ($this->form_validation->run() == FALSE){

			$data['category'] = $this->Location_model->select_category();

			$data['state'] = $this->Location_model->select_state();

			$this->load->view('admin/location/form',$data);

		}else{

			if($location_id == ''){

				$data['location_category'] =  $this->input->post('loc_cat_id');
				$data['name'] = $this->input->post('name');

				$data['address'] = $this->input->post('address');

				$data['location'] = $this->input->post('location');

				$data['city_id'] = $this->input->post('city_list');

				$data['state_id'] = $this->input->post('state_id');

				$data['category_id'] = $this->input->post('category_id');

				$data['pin_code'] = $this->input->post('pincode');

				$data['insertDate'] = $this->datetime;

				$data['insertBy'] = $this->user_id;

				$data['insertIp'] = $this->input->ip_address();

				$mobile['mobile'] = $this->input->post('phone');

				//$latLong = $this->getLatLong($data['address']);

				$data['latitude'] = $this->input->post('latitude');

				$data['longitude'] = $this->input->post('longitude');

				

				$random_unique_int = $this->get_unique_location_code();

				$data['unique_code'] = $random_unique_int;

				

				$count = count($mobile['mobile']);

				if($count == 0){

					$data['is_mobile'] = '0';

				}

				else{

					$data['is_mobile'] = '1';

				}

				$response =  $this->Location_model->insert_location($data);

				if($count != 0){

					for($i=0; $i<$count; $i++){

						$mobile_data['location_id'] = $response;

						$mobile_data['mobile'] = $mobile['mobile'][$i];	

						$mobile_data['user_id'] =  $this->user_id;

						$mobile_data['insertDate'] = $this->datetime ;

						$mobile_data['insertBy'] = $this->user_id ;

						$mobile_data['insertIp'] = $this->input->ip_address();

						$res = $this->Location_model->insert_mobile_data($mobile_data);

					}	

				}

				if($response){

					$msg = get_message('Location added successfully...',0);	

				}

				else{

					$msg = get_message('Failed to add location',1);

				}

				$this->session->set_flashdata('message',$msg);

				redirect(base_url('admin/location'));

			}

			if($location_id != ''){

				$data['location_category'] =  $this->input->post('loc_cat_id');
				
				$data['name'] = $this->input->post('name');

				$data['address'] = $this->input->post('address');

				$data['location'] = $this->input->post('location');

				$check['city_id'] = $this->input->post('city_list');

				if($check['city_id'] != ''){

					$data['city_id'] = $check['city_id'];

				}

				$check['state_id'] = $this->input->post('state_id');

				if($check['state_id'] != ''){

					$data['state_id'] = $check['state_id'];

				}

				$check['category_id'] = $this->input->post('category_id');

				if($check['category_id'] != ''){

					$data['category_id'] = $check['category_id'];	

				}

				$data['pin_code'] = $this->input->post('pincode');

				$data['updateDate'] = $this->datetime;

				$data['updateBy'] = $this->user_id;

				$data['updateIp'] = $this->input->ip_address();

				$mobile['mobile'] = $this->input->post('phone');

				$latLong = $this->getLatLong($data['address']);

				$data['latitude'] = $this->input->post('latitude');

				$data['longitude'] = $this->input->post('longitude');;

				$count = count($mobile['mobile']);

				if($count == 0){

					$data['is_mobile'] = '0';

				}

				else{

					$data['is_mobile'] = '1';

					$strQuery = $this->Location_model->update_delete_location($location_id);

				}

				

				

				$response =  $this->Location_model->update_location($data,$location_id);

				

				if($count != 0){																		

					for($i=0; $i<$count; $i++){

						$mobile_data['location_id'] = $location_id;

						$mobile_data['mobile'] = $mobile['mobile'][$i];	

						$mobile_data['user_id'] =  $this->user_id;

						$mobile_data['updateDate'] = $this->datetime ;

						$mobile_data['updateBy'] = $this->user_id ;

						$mobile_data['updateIp'] = $this->input->ip_address();

						$res = $this->Location_model->insert_mobile_data($mobile_data);

					}	

				}

				if($response){

					$msg = get_message('Location updated successfully...',0);	

				}

				else{

					$msg = get_message('Failed to updated location',1);

				}

				$this->session->set_flashdata('message',$msg);

				redirect(base_url('admin/location'));

			}

		}

		

	}

	

	public function from(){

		$data['category'] = $this->Location_model->select_category();

		$data['state'] = $this->Location_model->select_state();
		
		$data['loc_cat'] = $this->Location_model->select_location_category();

		$this->load->view('admin/location/form',$data);	

	}

	

	public function edit_location(){

		$location_id = base64_decode($this->uri->segment('4'));

		$data['edit_location'] = $this->Location_model->edit_location($location_id);

		$data['category'] = $this->Location_model->select_category();
		
		$data['state'] = $this->Location_model->select_state();

		$data['city'] = $this->Location_model->get_city();
		
		$data['loc_cat'] = $this->Location_model->select_location_category();

		$data['mobile'] = $this->Location_model->select_mobile_list($location_id);

		$this->load->view('admin/location/form',$data);

	}

	public function delete_location(){

		$location_id = base64_decode($this->uri->segment('4'));

		$strQuery = $this->Location_model->delete_location($location_id);

		if($strQuery){

			$msg = get_message('Location deleted successfully...',0);

		}

		$this->session->set_flashdata('message',$msg);

		redirect(base_url('admin/location'));	

	}

	

	public function get_city(){

		$get_city[] = array();

		$city_list = '';

		$get_state_id = $this->input->post('get_state_id');

		$data['city_list'] = $this->Location_model->select_city($get_state_id);

		if(!empty($data['city_list'])){

			foreach($data['city_list'] as $city){

				$city_list .= '<option value="'.$city['city_id'].'">'.$city['city_name'].'</option>';

			}

			$get_city['city'] = $city_list;

			$get_city['error'] = 0;	

		}

		else{

			$get_city['city'] = '';	

			$get_city['error'] = 1;

		}

		echo json_encode($get_city);

	}

	

	public function get_unique_location_code(){

			$digits_needed = 12;

			$random_number = ''; // set up a blank string

			$count=0;

			while ( $count < $digits_needed ) {

			    $random_digit = mt_rand(0, 9);

			    $random_number .= $random_digit;

			    $count++;

			}

			$random_unique_int = $random_number;

			$query = $this->Location_model->check_unique_code($random_unique_int);

		     if(count($query) > 0){

			  $this->get_unique_location_code();

		     }

		     return $random_unique_int;

	}

	

	public function view_mobile(){

		$model[] = array();

		$view = '';

		$mobile_id = $this->input->post('id');

		$result['model_data'] = $this->Location_model->get_mobile_no($mobile_id);

			$view .= '<div class="content"><div class="col-sm-12"><table id="example" class="display dataTable no-footer" role="grid" aria-describedby="example_info"><thead><tr><th>Contact No.</th></tr></thead><tbody>';

			if(!empty($result['model_data'])){

				foreach($result['model_data'] as $model){

					$view .= ' <tr><td>'.$model['mobile'].'</td>';

				}

			}else{

				$view .= '<tr><td colspan="5">No Mobile is availble.</td>';

			}

			$view .= '</tr></thread></table>';

			$view .= '<div></div></div>';

			$model['model_view'] = $view;

		echo json_encode($model);

	}



	

	

	

}