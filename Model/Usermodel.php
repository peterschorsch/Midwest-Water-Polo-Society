<?php  
/*
 * 
 *  PETER : ALL CODE IN THIS MODEL SHOULD BE FUNCTIONING AS INTENDED.  -- Cody, 2/5/16
 * 
 */

class UserModel extends MY_Model {
	public function checkCredentials(){ 
		$userEmail = $this->input->post('email');
		$userPassword = $this->input->post('password');
		
		$sql = 'SELECT userEmail
				FROM USERS 
				WHERE userEmail = ? AND userPassword = SHA2(?, 256);';
				
		$bind = array($userEmail, $userPassword);
		
		return $this->db->query($sql, $bind);
	} //end of function
	
	public function getTotalUsers() { //Gets active users
		$sql = "SELECT COUNT(userID) AS Count
				FROM USERS";
					
		return $this->db->query($sql);
	} // end of function 
	
	public function viewActiveUsers($sort='') { //Gets list of users
		$sql = "SELECT DISTINCT u.*, s.schoolName, t.teamMascot, p.photoLink
				FROM SCHOOLS s, TEAMS t, AVAILABILITY a, USERS u, PHOTOS p 
				WHERE s.schoolID = t.schoolID 
				AND t.teamID = a.teamID 
				AND a.userID = u.userID 
				AND t.photoID = p.photoID
				AND u.userStatus = 'Active'";
		//SELECT DISTINCT u.*, s.schoolName, t.teamMascot, p.photoLink FROM SCHOOLS s, TEAMS t, AVAILABILITY a, USERS u, PHOTOS p WHERE s.schoolID = t.schoolID AND t.teamID = a.teamID AND a.userID = u.userID AND u.userID = p.uploaderID 	
		
		if($sort == 'name'){
			$sql .= " ORDER BY u.userLastName ASC, u.userFirstName ASC, ";
		}
		else if($sort == 'team'){
			$sql .= " ORDER BY s.schoolName ASC, t.teamMascot ASC";
		}
		else if($sort == 'typeuser'){
			$sql .= " ORDER BY u.userType ASC";
		}
		else if($sort == 'login'){
			$sql .= " ORDER BY u.userLastLogin DESC";
		}
		else {
			$sql .= " ORDER BY u.userID ASC";
		}
					
		return $this->db->query($sql);
	} // end of function 
		
	function viewInactiveUsers($sort='') {
		$sql = "SELECT DISTINCT u.*, s.schoolName, t.teamMascot, p.photoLink
				FROM SCHOOLS s, TEAMS t, AVAILABILITY a, USERS u, PHOTOS p 
				WHERE s.schoolID = t.schoolID 
				AND t.teamID = a.teamID 
				AND a.userID = u.userID 
				AND t.photoID = p.photoID
				AND u.userStatus = 'Inactive'";
		
		if($sort == 'name'){
			$sql .= " ORDER BY u.userLastName ASC, u.userFirstName ASC, ";
		}
		else if($sort == 'team'){
			$sql .= " ORDER BY s.schoolName ASC, t.teamMascot ASC";
		}
		else if($sort == 'typeuser'){
			$sql .= " ORDER BY u.userType ASC";
		}
		else if($sort == 'login'){
			$sql .= " ORDER BY u.userLastLogin DESC";
		}
		else {
			$sql .= " ORDER BY u.userID ASC";
		}
					
		return $this->db->query($sql);
	} //end of function
	
	public function getActiveTotal() { //Gets active users
		$sql = "SELECT COUNT(userID) AS Count
				FROM USERS
				WHERE userStatus = 'Active'";
					
		return $this->db->query($sql);
	} // end of function 
	
	public function getInactiveTotal() { //Gets inactive users
		$sql = "SELECT COUNT(userID) AS Count 
				FROM USERS
				WHERE userStatus = 'Inactive'";
					
		return $this->db->query($sql);
	} // end of function 
	
	public function getAdminTotal() { //Gets number of admins
		$sql = "SELECT COUNT(userID) AS Count 
				FROM USERS
				WHERE userType = 'Admin'";
					
		return $this->db->query($sql);
	} // end of function 
	
	public function getAdminActivesTotal() { //Gets number of admins that are active
		$sql = "SELECT COUNT(userID) AS Count 
				FROM USERS
				WHERE userType = 'Admin' AND userStatus = 'Active'";
					
		return $this->db->query($sql);
	} // end of function 
	
	public function getAdminInactiveTotal() { //Gets number of admins that are inactive
		$sql = "SELECT COUNT(userID) AS Count 
				FROM USERS
				WHERE userType = 'Admin' AND userStatus = 'Inactive'";
					
		return $this->db->query($sql);
	} // end of function 

	
	public function getOfficerTotal() { //Gets number of officers
		$sql = "SELECT COUNT(userID) AS Count 
				FROM USERS
				WHERE userType = 'Officer'";
					
		return $this->db->query($sql);
	} // end of function 
	
	public function getOfficerActiveTotal() { //Gets number of officers that are active
		$sql = "SELECT COUNT(userID) AS Count 
				FROM USERS
				WHERE userType = 'Officer' AND userStatus = 'Active'";
					
		return $this->db->query($sql);
	} // end of function 
	
	public function getOfficerInactiveUsersTotal() { //Gets number of officers that are inactive
		$sql = "SELECT COUNT(userID) AS Count 
				FROM USERS
				WHERE userType = 'Officer' AND userStatus = 'Inactive'";
					
		return $this->db->query($sql);
	} // end of function 
	
	public function getUserProfile($userID) { //Gets profile information 
		$sql = 'SELECT u.userID, u.userEmail, u.userPhoneNumber, u.passEffectiveDate, u.userFirstName, u.userLastName, u.userType, s.schoolName, t.teamMascot, p.photoLink
				FROM SCHOOLS s join TEAMS t using (schoolID) join PHOTOS p using(photoID) join AVAILABILITY a using (teamID) join USERS u using(userID)
				WHERE u.userID = ?';
				
		$bind = array($userID);
				
		return $this->db->query($sql, $bind);
	} // end of function 
	
	public function getProfileLink($userID) { //Gets link of profile picture for header
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
	
	public function getUserInfo($userEmail) {
		$sql = 'SELECT DISTINCT u.userID, u.userFirstName, u.userLastName, u.passEffectiveDate, u.userType, t.teamID, s.schoolName,s.schoolAddress, s.schoolCity, s.schoolState, s.schoolZip
				FROM SCHOOLS s join TEAMS t using (schoolID) join AVAILABILITY a using (teamID) join USERS u using(userID)
				WHERE u.userEmail = ?';
				
		$bind = array($userEmail);
		
		return $this->db->query($sql, $bind);
	} // end of function
	
	
	public function getEmail($userEmail) {
		$sql = 'SELECT userEmail
				FROM USERS 
				WHERE userEmail = ?;';
				
		$bind = array($userEmail);
		
		return $this->db->query($sql, $bind);
	} // end of function
	
	public function getUsername($userID) {
		$sql = 'SELECT CONCAT(userFirstName, " ", userLastName)
				FROM USERS 
				WHERE userID = ?';
				
		$bind = array($userID);
		
		return $this->db->query($sql, $bind);
	} // end of function
	
	public function updateUserType($userID) { //Admin can change userType of users
		$userTypeInput = $this->input->post('userTypeInput');
				
		$sql = "UPDATE USERS SET userType= '$userTypeInput' WHERE userID=?";
				
		$bind = array($userID);
				
		return $this->db->query($sql, $bind);
	} // end of function 
	
	public function updateUserStatus($userID) { //Admin can change userStatus of inactive users
		$userStatus = $this->input->post('userStatus');
				
		$sql = "UPDATE USERS SET userType= '$userStatus' WHERE userID=?";
				
		$bind = array($userID);
				
		return $this->db->query($sql, $bind);
	} // end of function 
	
	public function validateLoginForm()	{ //validates user input upon login
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required'); // add more rules (if needed)		
		
		if($this->form_validation->run() == FALSE) {
			return validation_errors();
		}//end of if
		else { //if ok 
			$email = $this->input->post('email');
			
			$sql = "SELECT userFirstName, userLastName 
					FROM USERS 
					WHERE userEmail = '$email' 
					AND userStatus = 'Inactive'";
			
			return ''; //return error
		} //end of else
	} //end of function
	
	public function validateEmailInput() { //validates user email
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		
		if($this->form_validation->run() == FALSE) {
			return validation_errors();
		}
		else {
			return '';
		}
	} //end of function
	
	public function validateChangePasswordForm() { //validatechange password form
		$this->load->library('form_validation');
		$this->form_validation->set_rules('password', 'Password', 
			array(
				'trim',
				'required',
				'min_length[8]',
				array(
					'checkPasswordRequirements',
					array($this->UserModel, 'checkPasswordRequirements'))
				)
			);
		$this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'trim|required|matches[password]');
		$this->form_validation->set_message('checkPasswordRequirements', '{field} must contain at least one letter, one number, and one special character.'); // error message to display if password requirements fail
		
		if($this->form_validation->run() == FALSE) {
			return validation_errors();
		}
		else {
			return '';
		}
	} //end of function
	
	public function checkPasswordRequirements($Password) { //verify password meets requirements
		$hasLetter = preg_match('/[a-zA-Z]/', $Password);
		$hasNumber = preg_match('/\d/', $Password);
		$hasSpecial = preg_match('/[^a-zA-Z\d]/', $Password);
		if(!$hasLetter || !$hasNumber || !$hasSpecial){
			return FALSE;
		}
		else {
			return TRUE;
		}
	} // end of function
	
	public function updateTemporaryPassword($userEmail, $tempPassword){ //sets temporary password
		$sql = 'UPDATE USERS
				SET userPassword = SHA2(?, 256), passEffectiveDate = NOW()
				WHERE userEmail = ?';
		
		$bind = array($userEmail, $tempPassword,);
		
		return $this->db->query($sql, $bind);
	} //end of function
	 
	public function updatePassword(){ //updates password 
		$userID = $this->session->userdata('UserID'); 
		$password = $this->input->post('password');
		
		$sql = 'UPDATE USERS
				SET userPassword = SHA2(?, 256), passEffectiveDate = DATE_ADD(NOW(), INTERVAL 6 MONTH)
				WHERE userID = ?;';
		
		$bind = array($password, $userID);
		
		return $this->db->query($sql, $bind);
	} //end of function
	
	public function addUser(){ //Add user modal
		$userEmail = $this->input->post('userEmail');
		$userPassword = $this->input->post('password');
		$userType = ucwords($this->input->post('userType'));
		$passEffectiveDate = new DateTime("+8 months");
		$passEffectiveDate->modify("-" . ($passEffectiveDate->format('j')-1));
		$passEffectiveDate->format('Y-m-d');
		$userFirstName = ucwords($this->input->post('firstName'));
		$userLastName = ucwords($this->input->post('lastName'));	
		$userPhoneNumber = ucwords($this->input->post('phoneNumber'));			
		$userStatus = "Active";
				
		$sql = "INSERT INTO USERS(userID, userEmail, userPassword, passEffectiveDate, 
				userType, userFirstName, userLastName, userPhoneNumber, userLastLogin) 
				VALUES (?, ?, ?, $passEffectiveDate, ?, ?, ?, ?, NULL, ?)";
				
		$bind = array($userID, $userEmail, $userPassword, $userType, $userFirstName, $userLastName, $userPhoneNumber, $userStatus);
		
		return $this->db->query($sql, $bind);
	} //end of function	
	
	public function updateUserInfo($userID=''){ //Update user info modal
		$userEmail = $this->input->post('userEmail');
		$userPassword = $this->input->post('password');
		$userType = ucwords($this->input->post('userType'));
	
		$userFirstName = ucwords($this->input->post('firstName'));
		$userLastName = ucwords($this->input->post('lastName'));	
		$userPhoneNumber = ucwords($this->input->post('phoneNumber'));
		$userStatus = $this->input->post('status');
		
		$sql = "UPDATE USERS SET userID=  ? ,userEmail = ?,userPassword = ?, passEffectiveDate = ?, userType = ?, 
						userFirstName = ?, userLastName = ?, userPhoneNumber=?, userLastLogin = ?, userStatus = ?
						WHER userID = ?";
		
		$bind = array($userID, $userEmail, $userPassword, $userType, $userFirstName, $userLastName, $userPhoneNumber, $userStatus);
		
		return $this->db->query($sql, $bind);
	} //end of function	
	
	public function verifyUser(){ //Verifies user input for modals
		$this->load->library('form_validation');
		$this->form_validation->set_rules('userEmail','Name of the school', 'trim|required|valid_email');
		$this->form_validation->set_rules('userPassword','Name of the building', 'trim|required');
		$this->form_validation->set_rules('userFirstName', 'First Name of the User', 'trim|required');
		$this->form_validation->set_rules('userLastName','Last Name of the User', 'trim|required');
		$this->form_validation->set_rules('userPhoneNumber','Phone number of the building', 'trim|required|numeric|exact_length[10]');
				
		if($this->form_validation->run() == FALSE) {
			return validation_errors();
		}
		else {
			return '';
		}
		
		return $this->db->query($sql, $bind);
	} //end of function	
	
	public function removeUser($userID=''){ //Set user to inactive upon "deletion"
		$sql = 'UPDATE USERS
				SET userStatus = "Inactive"
				WHERE userID = ?;';
		
		$bind = array($userID);
				
		return $this->db->query($sql, $bind);
	} //end of function	
	
	
}//end of class
?>