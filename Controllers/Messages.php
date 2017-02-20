<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messages extends MY_Controller {
	public function getMessages() {
		$userID = $this->session->userdata('UserID');
		
		$this->load->model('UserModel');
		$this->load->model('NotificationModel');
		$messages = $this->NotificationModel->getMyNotifications($userID)->result_array();
		for ($i=0; $i < sizeof($messages); $i++) {
			$username = $this->UserModel->getUsername($messages[$i]['senderID']);
			$messages[$i]['senderID'] = $username;
		}
		$data['messages'] = $messages;
		
		$this->load->view('messages/popoverdata', $data);
	}
} ?>