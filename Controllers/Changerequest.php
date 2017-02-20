<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ChangeRequest extends MY_Controller {

	public function index($sort='')
	{//all requests
		$typeUser = $this->session->userdata('TypeUser');
		if($typeUser != 'Guest') {		
			$this->load->model('CRModel');
			
			if($typeUser == 'Admin') {
				$result = $this->CRModel->getAllCRs($sort);				
				
				if(isset($result) && !empty($result)){
					$data['CRs'] = $result;								// needs to be read in the view using foreach($CRs->result() as $item)
					$data['title'] = 'Midwest Water Polo - View CRs';
					$data['view'] = 'changerequests/index';
				}
				else{
					$error = $this->CRModel->getError();
					$data['error'] = $error."\nTry refreshing the page."; // send error to the view! (need to add div into code)
					$data['title'] = 'Midwest Water Polo - View Error';
					$data['view'] = 'changerequests/index';
				}
			}
			else if($typeUser == 'Officer') {
				$userID = $this->session->userdata('UserID');
				$result = $this->CRModel->getMyCRs($sort);		
				
				if(isset($result) && !empty($result)){
					$data['CRs'] = $result;								// needs to be read in the view using foreach($CRs->result() as $item)
					$data['title'] = 'Midwest Water Polo - View CRs';
					$data['view'] = 'changerequests/index';
				}
				else{
					$error = $this->CRModel->getError();
					$data['error'] = $error."\nTry refreshing the page."; // send error to the view! (need to add div into code)
					$data['title'] = 'Midwest Water Polo - View Error';
					$data['view'] = 'changerequests/index';
				}
			}
		}
		else {
			$data['title'] = 'Midwest Water Polo - UNAUTHORIZED';
			$data['view'] = 'error/unauthorized';
		}
		$this->load->view($this->layout, $data);
	} // end index
	
	public function deleterequest($requestID)
	{
		$typeUser = $this->session->userdata('TypeUser');
		if($typeUser != 'Guest') {
			$this->load->model('CRModel');
			
			if(isset($requestID) && !empty($requestID)){
				$result = $this->CRModel->removeCR($requestID);
			}
			
			/*if(isset($result) && $result == TRUE){
				// show some type of confirmation?
				$this->index();
			}
			else{
				$error = $this->CRModel->getError();
				// send error somewhere!
			}*/
		}
		else {
			$data['title'] = 'Midwest Water Polo - UNAUTHORIZED';
			$data['view'] = 'error/unauthorized';
		}
		redirect('/changerequest/index', 'refresh');
	} // end deleterequest
	
	/*
	 * AS OF NOW, THIS CODE ISN'T NEEDED DUE TO PULLING ALL REQUEST INFO AT ONE TIME AND STORING FOR THE PURPOSE OF USING THE MODAL.
	 * 
	 * public function viewrequest($requestID) //Views single request 
	{
		$typeUser = $this->session->userdata('TypeUser');
		if($typeUser != 'Guest') {
			$this->load->model('CRModel');
			
			if(isset($requestID) && !empty($requestID)){
				$result = $this->CRModel->getCR($requestID); 
			}
			
			if(isset($result) && !empty($result)){
				$data['CR'] = $result;									// needs to be read in the view using foreach($CR->row() as $column)
				
				$data['title'] = 'Midwest Water Polo - CR Viewer';
				$data['view'] = 'changerequests/viewrequest';
			}
			else{
				$error = $this->CRModel->getError();
				$data['error'] = $error."\nTry refreshing the page."; // send error to the view! (need to add div into code)
				$data['title'] = 'Midwest Water Polo - View Error';
				$data['view'] = 'changerequests/index';
			}
		}
		else {
			$data['title'] = 'Midwest Water Polo - UNAUTHORIZED';
			$data['view'] = 'error/unauthorized';
		}
		
		$this->load->view($this->layout, $data);
	} // end viewrequest */
	
	public function acceptrequest($requestID)
	{
		$typeUser = $this->session->userdata('TypeUser');

		if($typeUser != 'Guest') {
			$this->load->model('CRModel');
			
			if(isset($requestID) && !empty($requestID)){
				$accepted = $this->CRModel->acceptCR($requestID);
			}
			
			if(isset($accepted) && $accepted == TRUE){
				$request = $this->CRModel->getCR($requestID)->row_array();
				$this->load->model('NotificationModel', 'notifier');						// loads the notification model as the alias $this->notifier->(functionname); needed to store notification to show the user
				$notified = $this->notifier->createCRNotification('accepted',$requestID, $request['userID']);
				
				/*if(isset($notified) && $notified == TRUE){
					$data['alert']['success'] = 'Request #'.$requestID.' was accepted successfully and a notification has been sent to the affected user.';
					$data['title'] = 'Midwest Water Polo - CR Viewer';
					$data['view'] = 'changerequests/index';									// redirect to list of CRs on acceptance
				}
				else{
					$error = $this->CRModel->getError();
					// send error somewhere!
				}*/
			}
			else{
				$error = $this->CRModel->getError();
				// send error somewhere!
			}
		}
		else {
			$data['title'] = 'Midwest Water Polo - UNAUTHORIZED';
			$data['view'] = 'error/unauthorized';
			$this->load->view($this->layout, $data);
		}
		redirect('/changerequest/index', 'refresh');
	} // end acceptrequest

	public function rejectrequest($requestID)
	{
		$inputReason = $this->input->post('reason');
		$reason = filter_var($inputReason, FILTER_SANITIZE_STRING);
		
		$typeUser = $this->session->userdata('TypeUser');

		if($typeUser != 'Guest') {
			$this->load->model('CRModel' );
			
			$request = $this->CRModel->getCR($requestID)->row_array();

			if(isset($requestID) && !empty($requestID))	{
				if(!empty($reason) && $this->CRModel->removeCR($requestID)){
					$this->load->model('NotificationModel', 'notifier'); // loads the notification model as the alias $this->notifier->(functionname); needed to store notification to show the user
					$notified = $this->notifier->createCRNotification('rejected',$requestID,$request['userID'],$reason);

					/*if(isset($notified) && $notified == TRUE){
					$data['alert']['success'] = 'Request #'.$requestID.' was denied successfully and a notification has been sent to the affected user.';
					$data['title'] = 'Midwest Water Polo - CR Viewer';
					$data['view'] = 'changerequests/index';											// redirect to list of CRs on acceptance
					}
					else{
					$error = $this->CRModel->getError();
					$data['error'] = $error."\nPlease try to respond to the request again."; // send error to the view! (need to add div into code)
					$data['title'] = 'Midwest Water Polo - View Error';
					$data['view'] = 'changerequests/index';
					}*/
				}
				else{
					$error = $this->CRModel->getError();
					$data['error'] = $error."\nPlease try to respond to the request again."; // send error to the view! (need to add div into code)
					$data['title'] = 'Midwest Water Polo - View Error';
					$data['view'] = 'changerequests/index';
				}
			}
			else {
				$data['title'] = 'Midwest Water Polo - UNAUTHORIZED';
				$data['view'] = 'error/unauthorized';
				$this->load->view($this->layout, $data);
			}
		
			redirect('/changerequest/index', 'refresh');
		}
	} // end rejectrequest
	
	public function submitrequest($affectedPage) // this function actually sends the request data to the model
	{
		$typeUser = $this->session->userdata('TypeUser');

		if($typeUser != 'Guest') {
			$this->load->model('CRModel');
			
			$error = $this->CRModel->validateSubmitCRData();
			// THIS SECTION NEEDS TO BE LOOKED AT; NEED BETTER ERROR HANDLING WITH AJAX
			if(!empty($error)) {
				$data['error'] = $error;
				$this->load->view('login/index', $data);
			}
			else {
				$result = $this->CRModel->createCR($affectedPage);
				
				if($result) {
					$data['alert']['success'] = 'CR was submitted successfully for review.';
					$data['view'] = 'home/index';
					
				}
				else {
					$error = $this->CRModel->getError();
					// send error somewhere
				}
				$this->load->view($this->layout, $data);
			}
			// END SECTION TO BE LOOKED AT
		}
		else {
			$data['title'] = 'Midwest Water Polo - UNAUTHORIZED';
			$data['view'] = 'error/unauthorized';
		}
	} // end submitrequest
	
	public function removerequest($requestID){ //officer deletes request
		if($typeUser = 'Officer') {
			$this->load->model('CRModel');
			
			$result = $this->CRModel->removeRequest($requestID);
			
				
			$data['title'] = 'Midwest Water Polo - CR Viewer';
			$data['view'] = 'changerequests/index';	
		}//end of if
	}//end of remove request 
	
} // end Changerequest controller
