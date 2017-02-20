<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	public function index($sort=''){
		$this->load->model('UserModel');
			
		$result = $this->UserModel->viewActiveUsers($sort)->result_array();	
		$data['activeList'] = $result;	
		
		$result2 = $this->UserModel->viewInactiveUsers($sort)->result_array();	
		$data['inactiveList'] = $result2;		
		
		$result3 = $this->UserModel->getTotalUsers()->result_array();	
		$data['totalUsers'] = $result3;
		
		$result4 = $this->UserModel->getActiveTotal()->result_array();	
		$data['activeTotal'] = $result4;
		
		$result5 = $this->UserModel->getInactiveTotal()->result_array();	
		$data['inactiveTotal'] = $result5;
		
		$result6 = $this->UserModel->getAdminTotal()->result_array();	
		$data['adminTotal'] = $result6;
		
		$result7 = $this->UserModel->getAdminActivesTotal()->result_array();	
		$data['activeAdminTotal'] = $result6;
		
		$result8 = $this->UserModel->getAdminInactiveTotal()->result_array();	
		$data['inactiveAdminTotal'] = $result8;
		
		$result9 = $this->UserModel->getOfficerTotal()->result_array();	
		$data['officerTotal'] = $result9;
		
		$result10 = $this->UserModel->getOfficerActiveTotal()->result_array();	
		$data['activeOfficerTotal'] = $result10;
		
		$result11 = $this->UserModel->getOfficerInactiveUsersTotal()->result_array();	
		$data['inactiveOfficerTotal'] = $result11;			
		
		$data['title'] = 'Midwest Water Polo - User';
		$data['view'] = 'user/index';
		$this->load->view($this->layout, $data); 
	}//end of function
	
	public function viewUsers(){
		$this->load->model('UserModel');
		
		if($this->UserModel->viewActiveUsers()) {
			$this->index();
		}
		else {
			// db fail
		}		
		
		$data['title'] = 'Midwest Water Polo - Users';
		$data['view'] = 'user/index';
	} //end of function
	
	public function updateUserType($userID) { //saves new user types
		$this->load->model('UserModel');
		
		if($this->UserModel->updateUserType($userID)) {
			$this->index();
		}
		else {
			// db fail
		}			
		
		$data['title'] = 'Midwest Water Polo - Users';
		$data['view'] = 'user/index';
	}//end of function
	
	public function updateUserStatus($userID) { //changes new user status 
		$this->load->model('UserModel');
		
		if($this->UserModel->updateUserStatus($userID)) {
			$this->index();
		}
		else {
			// db fail
		}			
		
		$data['title'] = 'Midwest Water Polo - Users';
		$data['view'] = 'user/index';
	}//end of function
	
	public function addUser(){
		$this->load->model('UserModel');
		
		$error = $this->UserModel->verifyUser();

		if(!empty($error)) {
			// send error
		}//end of if
		else {
			if($this->UserModel->addUser()) {
				//$this->index();
			}//end of if 
			else {
				//
			}//end of else
		}//end of else
	}//end of function
	
	public function updateUser($userID=''){
		$this->load->model('UserModel');
		
		$error = $this->UserModel->verifyUser(); 
		
		if(!empty($error)) {
			echo '<p>'.$error.'</p>';
		}//end of if
		else {
			if($this->UserModel->updateUserInfo($schoolID)) {
				$this->index();
			}//end of if 
			else {
				//failure to update DB
			}//end of else
		}//end of else
	}//end of function
	
	public function removeUser($userID){
		$this->load->model('UserModel');
		
		if($this->UserModel->removeUser($schoolID)) {
			$message = "<p>User #".$userID." has been removed successfully</p>";
			$this->index($message);
		}//end of if		
		else {
			//something went wrong
		}//end of else
		
	}//end of function
}//end of class
?>