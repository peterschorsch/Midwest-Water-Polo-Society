<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {
	
	public function index($userID){
		$this->load->model('ProfileModel');
		
		$result = $this->ProfileModel->getUserProfile($userID)->result_array();	
		$data['profile'] = $result;	
		
		$result2 = $this->ProfileModel->getUserList()->result_array();	
		$data['userList'] = $result2;		
		
		$data['title'] = 'Midwest Water Polo - Profile';
		$data['view'] = 'profile/index';
		$this->load->view($this->layout, $data);
	}//end of function
	
}//end of class
?>