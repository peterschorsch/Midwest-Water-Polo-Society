<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends MY_Controller {

	public function index(){
		$year = date("Y");	
		
		$this->load->model('ScheduleModel');
		
		$result = $this->ScheduleModel->showAvailableWeekends()->result_array();	
		$data['availability'] = $result;
					
		$result2 = $this->ScheduleModel->getSeasons()->result_array();	
		$data['schedule'] = $result2;
					
		$result3 = $this->ScheduleModel->getSeasonYears()->result_array();
		$data['years'] = $result3;
		
		$data['title'] = 'Midwest Water Polo - Schedule';
		$data['view'] = 'schedule/index';
		$this->load->view($this->layout, $data); 
	}//end of function
	
	public function updateInfo($tournamentID){
		$this->load->model('ScheduleModel');
		
		$result = $this->ScheduleModel->updateTournamentInfo($tournamentID);
		
		$data['updateInfo'] = 'schedule/index';
		$this->load->view($this->layout, $data);
	}//end of function
	
	public function addScheduleInfo(){
		$this->load->model('ScheduleModel');
		
		$result = $this->ScheduleModel->addScheduleInfo();
		
		$data['addInfo'] = 'schedule/index';
		$this->load->view($this->layout, $data);
	}//end of function
	
	public function removeScheduleInfo(){
		$this->load->model('ScheduleModel');
		
		$result = $this->ScheduleModel->removeScheduleInfo();
		
		$data['removeInfo'] = 'schedule/index';
		$this->load->view($this->layout, $data);
	}//end of function		
			
	public function displayAvailableWeekends(){ //shows weekend availablity 
		$this->load->model('ScheduleModel');
		
		$seasonYear = date(Y);
				
		$result = $this->ScheduleModel->showAvailableWeekends($seasonYear)->result_array();
		
		if($result == ""){
			$seasonYear = $seasonYear-1;
			$result = $this->ScheduleModel->showAvailableWeekends($seasonYear)->result_array();
		}//end of if
		
		$data['availableWeekends'] = 'schedule/index';
		$this->load->view($this->layout, $data);
	}//end of function
	
	public function addChoosenWeekends(){ //adds choosen weekends for the month after clicking a submit button
		$this->load->model('ScheduleModel');
		
		$result = $this->ScheduleModel->saveChoosenWeekends();
		
		$data['chooseWeekends'] = 'schedule/index';
		$this->load->view($this->layout, $data);
	}//end of function
	
}//end of class
?>