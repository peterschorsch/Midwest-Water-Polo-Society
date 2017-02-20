<?php  
class ProfileModel extends MY_Model {		
	
	public function getUserList() { 
		$sql = "SELECT DISTINCT u.*, s.schoolName, t.teamMascot
				FROM SCHOOLS s join TEAMS t using (schoolID) join AVAILABILITY a using (teamID) join USERS u using(userID)
				ORDER BY u.userID ASC";
		
		return $this->db->query($sql);
	} // end of function 
	
	public function getUserID($userID) {	
		$sql = "SELECT userID 
				FROM USERS 
				WHERE userID = ?;";
				
		$bind = array($userID);
				
		return $this->db->query($sql, $bind);
	} // end of function 
	
	public function getUserProfile($userID) {
		$sql = "SELECT u.userID, u.userEmail, u.userPhoneNumber, u.passEffectiveDate, u.userFirstName, u.userLastName, u.userType, u.userLastLogin, s.schoolName, t.teamMascot, p.photoLink 
				FROM USERS u, PHOTOS p, TEAMS t, SCHOOLS s 
				WHERE u.userID = p.uploaderID 
				AND p.uploaderID = t.teamID 
				AND s.schoolID = t.schoolID 
				AND p.photoLink LIKE 'public/images/profile/%' 
				AND u.userID = ? 
				ORDER BY p.photoDate ASC , p.photoTime ASC;";
		
		$bind = array($userID);
				
		return $this->db->query($sql, $bind);
	} // end of function 
	
	public function getProfileLink($userID) { //for header
		$sql = "SELECT p.photoLink
				FROM USERS u, PHOTOS p, AVAILABILITY a, TEAMS t, SCHOOLS s
				WHERE u.userID=p.uploaderID
				AND u.userID=a.availabilityID
				AND a.availabilityID=t.teamID
				AND t.teamID=s.schoolID
				AND p.photoLink LIKE 'public/images/profile/%'
				AND u.userID = ?
				ORDER BY p.photoDate ASC, p.photoTime ASC;";
				
		$bind = array($userID);
				
		return $this->db->query($sql, $bind);
	} // end of function 
	
	public function validateProfile(){ //New - After AITP competition
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('firstName','firstName', 'trim|required');
		$this->form_validation->set_rules('lastName','lastName', 'trim|required');
		$this->form_validation->set_rules('phone', 'Phone number of the user', 'trim|required|numeric|exact_length[10]');
		
		if($this->form_validation->run() == FALSE) {
			return validation_errors();
		}
		else {
			return '';
		}
	} //end of function
	
	public function updateProfile($userID) { //New - After AITP competition	
		$userEmail = ucwords($this->input->post('email'));
		$userFirstName = ucwords($this->input->post('firstName'));
		$userLastName = ucwords($this->input->post('lastName'));
		$userPhone = strtoupper($this->input->post('phone'));
		
		$sql = "UPDATE USERS 
				SET userEmail = ?, userFirstName = ?, 
				userLastName = ?, userPhone = ?
				WHERE userID = ?";
				
		$bind = array($userEmail, $userFirstName, $userLastName, $userPhone, $userID);
				
		return $this->db->query($sql, $bind);
	} // end of function 
	
}//end of class
?>