<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AboutUs extends MY_Controller {
	public function index(){
		$this->load->model('AboutUsModel');
		$result = $this->AboutUsModel->loadConferenceInfo()->result_array();
		
		if(isset($result) && !empty($result)){
			$data['conferenceInfo'] = $result;
		}
		else {
			$error = $this->ContactUs->getError();
			// send error somewhere!
		}	
		
		//$data['message'] = $message; 
		$data['title'] = 'Midwest Water Polo - About Us';
		$data['view'] = 'aboutus/index';
		$this->load->view($this->layout, $data);
	}//end of function
	
	public function updateContent($contentID) {
		$contentTitle = $this->input->post('contentTitle');
		$contentText = $this->input->post('contentText');
		$typeUser = $this->session->userdata('TypeUser');	
		$this->load->model('AboutUsModel');
		
		if ($typeUser == 'Admin') {	
			$error = $this->AboutUsModel->validateContent($contentTitle, $contentText);
			
			if(!empty($error)) {
				// redirect back to index and show error in div
			}//end of if
			else {
				if($this->AboutUsModel->updateContent($contentID, $contentTitle, $contentText)) {
					$this->index();
				}//end of if
				else {
					//something went wrong
				}//end of else
			}//end of else
		}//end of if
		else {
			$data['title'] = 'Midwest Water Polo - UNAUTHORIZED';
			$data['view'] = 'error/unauthorized';
			$this->load->view($this->layout, $data);
		}//end of else
	}//end of function
	
	public function removeText($contentID='',$tabID=''){//NOT NEEDED?
		$this->load->model('AboutUsModel');
		$this->load->model('NotificationModel');
		
		$userID = $_SESSION['userID'];
		
		$result = $this->AboutUsModel->removeInfo($contentID,$tabID);//Also send notification?
		$result2 = $this->NotificationModel->sendNotification($userEmail='');//Notification. May not need userEmail? ERD Messages?
		
		$data['removeInfo'] = 'aboutus/index';
		$this->load->view($this->layout, $data);
	}//end of function
			
} //end of class

?>