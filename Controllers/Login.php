<?php 
class Login extends MY_Controller{
	
	public function index($data=""){
		$this->load->library('form_validation');		//required to show the original form data
		$data['title'] = 'Midwest Water Polo - Login'; 	//specifies title for the page
		$data['view'] = 'login/index'; 					//specifies what view to load in the format 'folder/filename'
		$this->load->view($this->layout, $data); 		//loads the template with the specified parameters 
	}//end of function
		
	public function validatelogin() {
		$this->load->model('UserModel');
		
		//call a function to validate the form data. Returns an array with error messages
		$error = $this->UserModel->validateLoginForm();		
		
		if (!empty($error)) {
			$data['error'] = $error;						//if error exists, show it in the view
			$data['title'] = 'Midwest Water Polo - Login'; 	//specifies title for the page
			$data['view'] = 'login/index'; 					//specifies what view to load in the format 'folder/filename'
			$this->load->view($this->layout, $data); 		//loads the template with the specified parameters 
		} //end of if
		else {
			$check = $this->UserModel->checkCredentials()->row_array();
			
			if (!empty($check)) {
				$userInfo = $this->UserModel->getUserInfo($check['userEmail'])->row_array();
				
				$this->session->set_userdata('UserID', $userInfo['userID']);
				$this->session->set_userdata('FirstName', $userInfo['userFirstName']);
				$this->session->set_userdata('LastName', $userInfo['userLastName']);
				$this->session->set_userdata('TypeUser', $userInfo['userType']);
				$this->session->set_userdata('TeamID', $userInfo['teamID']);
				$this->session->set_userdata('SchoolName', $userInfo['schoolName']);
				$this->session->set_userdata('SchoolAddress', $userInfo['schoolAddress']);
				$this->session->set_userdata('SchoolCity', $userInfo['schoolCity']);
				$this->session->set_userdata('SchoolState', $userInfo['schoolState']);
				$this->session->set_userdata('SchoolZip', $userInfo['schoolZip']);
					
				if (strtotime($userInfo['passEffectiveDate']) < time()) {
					redirect('/login/changepassword', 'location');
				}//end of if
				else {
					redirect('/home/index', 'location');
				}//end of else
			
			} //end of if
			else {
				$data['error'] = 'Incorrect username or password!';
				$data['title'] = 'Midwest Water Polo - Login'; 	
				$data['view'] = 'login/index'; 					
				$this->load->view($this->layout, $data); 
			}//end of else

		}//end of else		
	} //end of function
	
	public function logout() {
		$this->session->sess_destroy();
		redirect('home/index', 'location');
	} // end of function
	
	//THIS PAGE CONTAINS THE INPUT FORM FOR EMAIL. WILL BE SHOWN WHEN 'RESET PASSWORD' LINK IS CLICKED
	public function resetpassword() {
		$this->load->library('form_validation');
		$typeUser = $this->session->userdata('TypeUser');
		if($typeUser == 'Guest') {
			//$data['error'] = phpinfo();
			$data['title'] = 'Midwest Water Polo - Reset Password';
			$data['view'] = 'login/resetpassword';
			$this->load->view($this->layout, $data);
		}//end of if
		else {
			redirect('home/index', 'location');
		}//end of else
	} // end reset password
	
	// Reset password form action link. Verifies that input is valid, but DOES NOT prove email exists in our DB.
	public function validateemail() {
		$this->load->library('form_validation');
		$this->load->model('UserModel');
		
		$error = $this->UserModel->validateEmailInput();
		
		if (!empty($error)) {
			$data['error'] = $error;									// if error exists, show it in the view
			$data['title'] = 'Midwest Water Polo - Reset Password'; 	// specifies title for the page
			$data['view'] = 'login/resetpassword'; 						// specifies what view to load in the format 'folder/filename'
			$this->load->view($this->layout, $data); 					//loads the template with the specified parameters 
		} //end of if
		else {
			$this->sendResetEmail($this->input->post('email'));
		}//end of else
	} // end validateemail
	
	//THIS FUNCTION GENERATES A RANDOM PASSWORD
	function generatePassword($chars_min=6, $chars_max=8, $use_upper_case=false, $include_numbers=false, $include_special_chars=false){
        $length = rand($chars_min, $chars_max);
        $selection = 'aeuoyibcdfghjklmnpqrstvwxz';
        if($include_numbers) {
            $selection .= "1234567890";
        }//end of if
        if($include_special_chars) {
            $selection .= "!@\"#$%&[]{}?|";
        }//end of if

        $password = "";
        for($i=0; $i<$length; $i++) {
            $current_letter = $use_upper_case ? (rand(0,1) ? strtoupper($selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))];            
            $password .=  $current_letter;
        }//end of for            

      return $password;
    } // end of function

	// THIS FUNCTION IS USED TO SEND EMAIL TO SPECIFIED EMAIL ADDRESS
	public function sendResetEmail($userEmail) {
		$this->load->model('UserModel');
		$userExists = $this->UserModel->getEmail($userEmail)->row_array(); // returns an empty array if email doesn't exist in DB
		
		if(!empty($userExists)) {
			$this->load->library('email');
			
			$this->email->from('officialmwwps@mwpolosociety.com', 'Midwest Water Polo Society'); 
			$this->email->to($userEmail);
			$this->email->subject('Password Reset Confirmation');
			
			//UPDATE PASSWORD WITH TEMPORARY PASSWORD
			$tempPassword = $this->generatePassword(8,8,FALSE, TRUE, TRUE);
			
			if ($this->UserModel->updatePassword($userEmail, $tempPassword)) {		
				/*MESSAGE IN HTML FORMAT*/;
				$message = '<p> Hello <strong>'.$userEmail.'</strong>,</p>
							<p>Here is your temporary password: <br/>' . $tempPassword .'</p>
							<p>Sincerely,<br/> 
							Midwest Water Polo Society (MWWPS)</p>';
								
				$this->email->message($message);
				
				if($this->email->send() == FALSE){
					// CREATE ERROR STATING THAT EMAIL COULDN'T BE SENT AND TO TRY AGAIN
					$data['error'] = $this->email->print_debugger(); //'Something went wrong attempting to send an email, please try again.';	
				}
				else {
					$data['error'] = 'If an account for '.$userEmail.' exists in our system, a reset email has been sent.';
				}
			}//end of if
		}//end of if
		
		
		$data['title'] = 'Midwest Water Polo - Reset Password';
		$data['view'] = 'login/resetpassword';
		$this->load->view($this->layout, $data);
	} //end of sendresetemail
	
	public function changepassword() {
		$typeUser = $this->session->userdata('TypeUser');
		if($typeUser != 'Guest') {
			$data['error'] = 'Password has expired and must be changed.';
			$data['title'] = 'Midwest Water Polo - Change Password';
			$data['view'] = 'login/changepassword';
					
			$this->load->view($this->layout, $data);
		}//end of if
		else {
			$data['title'] = 'Midwest Water Polo - UNAUTHORIZED';
			$data['view'] = 'error/unauthorized';
			$this->load->view($this->layout, $data);
		}//end of else
	} //end changepassword
	
	public function validatepassword() {
		$this->load->model('UserModel');
		$error = $this->UserModel->validateChangePasswordForm();
		if(!empty($error)) {
			$data['error'] = $error;
			$data['title'] = 'Midwest Water Polo - Change Password';
			$data['view'] = 'login/changepassword';
			
			$this->load->view($this->layout, $data);
		}//end of if
		else {
			if($this->UserModel->updatePassword()) {
				$this->session->sess_destroy(); // NEED WAY TO RELOAD PAGE WITHOUT LOSING SUCCESS DATA
			
				$data['success'] = "<p>Password has been updated successfully. Please log in with your new credentials.</p>";
				$data['title'] = 'Midwest Water Polo - Login';
				$data['view'] = 'login/index';
				
				$this->load->view($this->layout, $data);
			}//end of if
			else {
				$data['error'] = "<p>Something went wrong. Please try again.<p>";
				$data['title'] = 'Midwest Water Polo - Change Password';
				$data['view'] = 'login/changepassword';
				
				$this->load->view($this->layout, $data);
			}//end of else
		}//end of else
	} //end validate password
		
}//end of class
?>