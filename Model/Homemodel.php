<?php
class HomeModel extends MY_Model {
		
	function getArticles(){			
		$sql = "SELECT c.*, t.tabName
				FROM CONTENTS c, TABS t 
				WHERE c.tabID= t.tabID
				AND t.tabID = 1
				ORDER BY c.timeCreated DESC";
		
		return $this->db->query($sql);
	}//end of function
	
	function updateContent($contentID, $contentTitle, $contentText) { //NEW
		$userID = $this->session->userdata('UserID');
		
		$sql = "UPDATE CONTENTS SET contentTitle = ?, contentText = ?, timeCreated = NOW(), userID = ?
				WHERE contentID = ?";
				
		$bind = array($contentTitle, $contentText, $userID, $contentID);
	
		return $this->db->query($sql, $bind);	
	}//end of function
	
	function validateContent($contentTitle='', $contentText='') {
		if(empty($contentText) || empty($contentTitle)) {
			$error = "<p>All fields must be completed before content can be updated.</p>";
		}//end of if
		else {
			$error = [];
		}//end of else
		
		return $error;
	}//end of function
	
	function validateCarousel() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('carouselDescription1', 'Description for first photo', 'trim|required');
		$this->form_validation->set_rules('carouselDescription2', 'Description for second photo', 'trim|required');
		$this->form_validation->set_rules('carouselDescription3', 'Description for third photo', 'trim|required');
		$this->form_validation->set_rules('carouselDescription4', 'Description for fourth photo', 'trim|required');
		
		if($this->form_validation->run() == FALSE) {
			return validation_errors();
		}
		else {
			return '';
		}	
	}
	
	
}//end of class
?>