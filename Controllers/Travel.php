<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Travel extends MY_Controller {
	public function index($schoolID=""){
		$this->load->model('TravelModel');
		
		$result = $this->TravelModel->getActiveList()->result_array();
		$result2 = $this->TravelModel->getInactiveList()->result_array();
		
		$data['inactiveTeams'] = $result2;
		
		
		$this->load->model('ContactUsModel');
		
		$result3 = $this->ContactUsModel->getInactiveTeams()->result_array();
		$result4 = $this->ContactUsModel->getActiveCount()->result_array();
		$result5 = $this->ContactUsModel->getInactiveCount()->result_array();
		
		$data['inactiveList'] = $result3;
		$data['activeCount'] = $result4;
		$data['inactiveCount'] = $result5;
	
		if(isset($result) && !empty($result)){
			$data['activeList'] = $result;
		}//end of if
		else {
			$error = $this->TravelModel->getError();
			// send error somewhere!
		}//end of else
			
		
		//$data['message'] = $message; 
		$data['title'] = 'Midwest Water Polo - Travel';
		$data['view'] = 'travel/index';
		$this->load->view($this->layout, $data);
	}//end of function
	
	public function addTravel(){
		$this->load->model('TravelModel');
		
		$error = $this->TravelModel->verifyTravelInfo();

		if(!empty($error)) {
			// send error
		}//end of if
		else {
			if($this->TravelModel->addTravelInfo()) {
				//$this->index();
			}//end of if 
			else {
				//
			}//end of else
		}//end of else
	}//end of function
	
	public function updateTravel($schoolID=''){
		$this->load->model('TravelModel');
		
		$error = $this->TravelModel->verifyTravelInfo(); 
		if(!empty($error)) {
			echo '<p>'.$error.'</p>';
		}//end of if
		else {
			if($this->TravelModel->updateTravelInfo($schoolID)) {
				$this->index();
			}//end of if 
			else {
				//failure to update DB
			}//end of else
		}//end of else
	}//end of function
	
	public function removeTravel($schoolID=''){
		$this->load->model('TravelModel');
		
		if($this->TravelModel->removeTravelInfo($schoolID)) {
			$message = "<p>Travel info #".$schoolID." has been removed successfully</p>";
			$this->index($message);
		}//end of if		
		else {
			//something went wrong
		}//end of else
		
	}//end of function
	
} //end of class

?>