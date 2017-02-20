<?php
class CRModel extends MY_Model {
	// define constants here	
		
	// define functions here
	function validateSubmitCRData() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('comment', 'Request Content', 'trim|required');
		
		if($this->form_validation->run() == FALSE) {
			return validation_errors();
		}
		else {
			return '';
		}
	}//end of function
	
	// SELECT STATEMENTS
	function getAllCRs($sort='') {
		$this->session->userdata('UserID');
		
		$sql = 'SELECT r.*, CONCAT(u.userFirstName," ",u.userLastName) as Submitter, p.photoLink
				FROM USERS u, REQUESTS r, PHOTOS p 
				WHERE u.userID = r.userID
				AND u.userID = p.uploaderID
				AND p.photoLink LIKE "public/images/profile/%"';
		
		if($sort == 'name'){
			$sql .= " ORDER BY u.userFirstName ASC, u.userLastName ASC";
		}
		else if($sort == 'page'){
			$sql .= " ORDER BY r.affectedPage ASC";
		}
		else if($sort == 'date'){
			$sql .= " ORDER BY r.requestDateTime";
		}
		else if($sort == 'status'){
			$sql .= " ORDER BY r.requestStatus";
		}
		else {
			$sql .= " ORDER BY r.requestID ASC;";
		}
		
		return $this->db->query($sql);
	}//end of function
	
	function getMyCRs($sort='') { //Gets all of my individual change requests
			$userID = $this->session->userdata('UserID');
				
			$sql = 'SELECT r.*, CONCAT(u.userFirstName," ",u.userLastName) as Submitter
				FROM REQUESTS r NATURAL JOIN USERS u';
		
			if($sort == 'name'){
				$sql .= " ORDER BY u.userFirstName ASC, u.userLastName ASC";
			}
			else if($sort == 'page'){
				$sql .= " ORDER BY r.affectedPage ASC";
			}
			else if($sort == 'date'){
				$sql .= " ORDER BY r.requestDateTime";
			}
			else if($sort == 'status'){
				$sql .= " ORDER BY r.requestStatus";
			}
			else {
				$sql .= " ORDER BY r.requestID ASC;";
			}
		
			return $this->db->query($sql, $bind);
	}//end of function
	
	function getCR($requestID) { //Gets individual change request
		if(isset($requestID) && !empty($requestID)){
			$sql = 'SELECT * 
					FROM REQUESTS
					WHERE requestID = ?;';
			
			$bind = array($requestID);

			return $this->db->query($sql, $bind);
		}//end of if
	}//end of function
	
	function getRequestCount() {
		$userID = $this->session->userdata('UserID');
		$typeUser = $this->session->userdata('TypeUser');
		
		$sql = 'SELECT COUNT(requestID) as count
				FROM REQUESTS
				WHERE requestStatus = "Pending"';
				
		if ($typeUser == 'Officer') {
			$sql = $sql.' AND userID = ?';
		}
		
		$bind = array($userID);
		
		return $this->db->query($sql, $bind);
	}
	
	// INSERT STATEMENTS
	function createCR($affectedPage) {
		$requestContent = $this->input->post('comment');
		$requestStatus = 'Pending';
		$userID = $this->session->userdata('UserID');
		
		$sql = 'INSERT INTO REQUESTS (requestContent, requestDateTime, requestStatus, affectedPage, userID) 
				VALUES (?, NOW(), ?, ?, ?);'; 
		$bind = array($requestContent, $requestStatus, $affectedPage, $userID);
		
		return $this->db->query($sql, $bind);
	}//end of function
	
	// UPDATE STATEMENTS
	function acceptCR($requestID) {
		if(isset($requestID) && !empty($requestID)){
			$sql = 'UPDATE REQUESTS
					SET requestStatus = "Accepted"
					WHERE requestID = ?;';
			
			$bind = array($requestID);
			
			return $this->db->query($sql, $bind);
		}//end of if
	}//end of function	
	
	// DELETE STATEMENTS
	function removeCR($requestID) {
		if(isset($requestID) && !empty($requestID)){
			$sql = 'DELETE FROM REQUESTS
					WHERE requestID = ?;';
			
			$bind = array($requestID);
			
			return $this->db->query($sql, $bind);
		}
	}//end of function
	
}//end of class
?>