<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Availability extends MY_Controller {

	public function index(){
		$this->load->model('ScheduleModel');
			
		//shows list of available weekends	
		$result = $this->ScheduleModel->showAvailableWeekends()->result_array();	
		$data['availability'] = $result;			
		
		$data['title'] = 'Midwest Water Polo - Availability';
		$data['view'] = 'availability/index';
		$this->load->view($this->layout, $data); 
	}//end of function
	
	public function updateWeekend() {//update chosen weekend
		$this->load->model('ScheduleModel');
		
		if($this->ScheduleModel->updateWeekend()) {
			$this->index();
		}
		else {
			// db fail
		}
		 
	}//end of function 
	
	public function insertWeekend() {//saves initial chosen weekends
		$this->load->model('ScheduleModel');
		
		if($this->ScheduleModel->saveChosenWeekend()) {
			$this->index();
		}
		else {
			// db fail
		}			
		
		$data['title'] = 'Midwest Water Polo - Availability';
		$data['view'] = 'availability/index';
	}//end of function
}//end of controller
		