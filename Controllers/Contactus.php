<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContactUs extends MY_Controller {

	public function index($message='', $schoolID=''){
		$this->load->model('ContactUsModel');
		$result = $this->ContactUsModel->getActiveTeams()->result_array();
		$result2 = $this->ContactUsModel->getInactiveTeams()->result_array();
		$result3 = $this->ContactUsModel->getActiveCount()->result_array();
		$result4 = $this->ContactUsModel->getInactiveCount()->result_array();
		
		$data['inactiveList'] = $result2;
		$data['activeCount'] = $result3;
		$data['inactiveCount'] = $result4;
		
		$this->load->model('SchoolModel');
		$result5 = $this->SchoolModel->getSchoolInfo($schoolID)->result_array();
		
		if(isset($result) && !empty($result)){
			$data['activeList'] = $result;
		}
		else {
			$error = $this->ContactUsModel->getError();
			// send error somewhere!
		}
		if(isset($result3) && !empty($result5)) {
			$data['schoolInfo'] = $result5;
		}
		else {
			$error = $this->TravelModel->getError();
			// send error somewhere!
		}
		
		$data['message'] = $message; 
		$data['title'] = 'Midwest Water Polo - Team Contact Info';
		$data['view'] = 'contactus/index';
		$this->load->view($this->layout, $data);	
	} // end of index
	
	public function addTeam(){
		$this->load->model('ContactUsModel');
		$this->load->model('FileModel');
		$this->load->model('PhotosModel');
		
		$error = $this->ContactUsModel->verifyTeamInfo();
		
		if(!empty($error)) {
			// form had errors
		}//end of if
		else {
			$path = 'public/images/teams/';
			$descr = 'Team logo for '.$this->input->post('teamName');
			$photo = ($_FILES['teamLogo']['size'] > 0) ? $this->FileModel->uploadFile($path, 'teamLogo') : array('file_name' => $this->input->post('teamLogoFilename'));
			
			if($this->PhotosModel->addTeamLogo($descr, $path.$photo['file_name'])) {
				$photoID = $this->PhotosModel->getMaxID()->result_array()[0];
				if($this->ContactUsModel->addTeamInfo($photoID)) {
					$this->index();
				}
				else {
					// failed to update teamInfo
					//echo '<script>alert("add team failed")</script>';
				}
			}
			else {
				// failed to add Photo
				//echo '<script>alert("add photo failed")</script>';
			}			
		}//end of else
	}//end of function
	
	public function updateTeamInfo($teamID){
		$this->load->model('ContactUsModel');
		$this->load->model('FileModel');
		$this->load->model('PhotosModel');
		
		$error = $this->ContactUsModel->verifyTeamInfo();
		if (!isset($teamID) || empty($teamID)) { $error[] = '<p>Team ID must be specified in function call.</p>'; } 
		if(!empty($error)) {
			// form had errors
		}//end of if
		else {
			$path = 'public/images/teams/';
			$descr = 'Team logo for '.$this->input->post('teamName');
			$photo = (isset($_FILES['teamLogo'])) ? $this->FileModel->uploadFile($path, 'teamLogo') : array('file_name' => $this->input->post('teamLogoFilename'));
			
			if($this->PhotosModel->addTeamLogo($descr, $path.$photo['file_name'])) {
				$photoID = $this->PhotosModel->getMaxID()->result_array()[0];
				if($this->ContactUsModel->updateTeamInfo($teamID, $photoID)) {
					$this->index();
				}
				else {
					// failed to update teamInfo
				}
			}
			else {
				// failed to add Photo
			}			
		}//end of else
	}//end of function
	
	public function removeTeamInfo($teamID){
		$this->load->model('ContactUsModel');
		
		if($this->ContactUsModel->removeTeamInfo($teamID)) {
			$message = "<p>Team #".$teamID." has been removed successfully</p>";
			$this->index($message);
		}//end of if
		else {
			//didnt delete
		}//end of else
		
	}//end of function
	
	public function addSchool() {
		$this->load->model('TravelModel');
		
		$error = $this->TravelModel->verifyTravelInfo();
		
		if(!empty($error)) {
			// send error
		}//end of if
		else {
			if($this->TravelModel->addTravelInfo()) {
				$this->index();
			}//end of if 
			else {
				//failure to update DB
			}//end of else
		}//end of else
	}//end of function
		
	/*public function updatePicture($photoLink){
		$this->load->model('PhotosModel');
		
		$result = $this->PhotosModel->updatePicture($photoLink);
		
		$data['contactUsPicture'] = $result;		
				
		$data['title'] = 'Midwest Water Polo - Team Contact Info';
		$data['view'] = 'contactus/index';
		$this->load->view($this->layout, $data);
	}//end of function*/
	
} //end of class