<?php
class ContactUsModel extends MY_Model {
	
	function getActiveTeams() { //Gets Active List of teams 					
		$sql = "SELECT photoLink, teamID, schoolName, teamMascot, teamCaptain, teamCoach, teamPhone, teamEmail, teamWebsite, schoolID
				FROM PHOTOS JOIN TEAMS USING(photoID) JOIN SCHOOLS USING(schoolID)
				WHERE teamStatus = 'Active'
				ORDER BY schoolName;"; 
		
		return $this->db->query($sql);
	}//end of function
	
	function getInactiveTeams() { //gets Inactive List of teams			
		$sql = "SELECT photoLink, teamID, schoolName, teamMascot, teamCaptain, teamCoach, teamPhone, teamEmail, teamWebsite, schoolID
				FROM PHOTOS JOIN TEAMS USING(photoID) JOIN SCHOOLS USING(schoolID)
				WHERE teamStatus = 'Inactive'
				ORDER BY schoolName;"; 
		
		return $this->db->query($sql);
	}//end of function
	
	function getActiveCount() { //DONE 					
		$sql = "SELECT COUNT(teamStatus) AS COUNT
				FROM TEAMS
				WHERE teamStatus = 'Active';"; 
		
		return $this->db->query($sql);
	}//end of function
	
	function getInactiveCount() { //DONE 					
		$sql = "SELECT COUNT(teamStatus) AS COUNT
				FROM TEAMS
				WHERE teamStatus = 'Inactive';"; 
		
		return $this->db->query($sql);
	}//end of function
	
	function verifyTeamInfo() { //DONE
		$this->load->library('form_validation');
		$this->form_validation->set_rules('schoolID','Name of the school', 'trim|required');
		$this->form_validation->set_rules('teamName','Name of the team', 'trim|required');
		$this->form_validation->set_rules('teamCoach','Name of the coach', 'trim|required');
		$this->form_validation->set_rules('teamCaptain','Name of the captain', 'trim|required');
		$this->form_validation->set_rules('teamPhone','Phone number for team', 'trim|required|numeric');
		$this->form_validation->set_rules('teamEmail','Email address for team', 'trim|required|valid_email');
		$this->form_validation->set_rules('teamWebsite','Website for team', 'trim|required|valid_url');
		
		if($this->form_validation->run() == FALSE) {
			return validation_errors();
		}
		else {
			return '';
		}
	}//end of function
	
	function removeTeamInfo($teamID) { //DONE
		$sql = "UPDATE TEAMS SET teamStatus = 'Active' 
				WHERE teamID = ?";
		
		$bind = array($teamID);
		
		return $this->db->query($sql, $bind);
	}//end of function
	
	function addTeamInfo($photoID) { 
		$schoolID = $this->input->post('schoolID');
		$teamName = ucwords($this->input->post('teamName'));
		$teamCoach = ucwords($this->input->post('teamCoach'));
		$teamCaptain = ucwords($this->input->post('teamCaptain'));
		$teamPhone = $this->input->post('teamPhone');
		$teamEmail = $this->input->post('teamEmail');
		$teamWebsite = $this->input->post('teamWebsite');
		
		$sql = "INSERT INTO TEAMS(teamName, teamCoach, teamCaptain, teamPhone, teamEmail, teamWebsite, schoolID, photoID) 
				VALUES (?, ?, ?, ?, ?, ?, ?)";
		
		$bind = array($teamName, $teamCoach, $teamCaptain, $teamPhone, $teamEmail, $teamWebsite, $schoolID, $photoID);
		
		return $this->db->query($sql, $bind);
	}//end of function
	
	function updateTeamInfo($teamID, $photoID) {
		$schoolID= $this->input->post('schoolID');
		$teamName = ucwords($this->input->post('teamName'));
		$teamCoach = ucwords($this->input->post('teamCoach'));
		$teamCaptain = ucwords($this->input->post('teamCaptain'));
		$teamPhone = $this->input->post('teamPhone');
		$teamEmail = $this->input->post('teamEmail');
		$teamWebsite = $this->input->post('teamWebsite');
				
		$sql = "UPDATE TEAMS
				SET TEAMS.teamMascot = ?, TEAMS.teamCaptain = ?, TEAMS.teamCoach = ?, TEAMS.teamPhone = ?, TEAMS.teamEmail = ?, TEAMS.teamWebsite = ?, TEAMS.schoolID = ?, TEAMS.photoID = ?
				WHERE TEAMS.teamID = ?;";

		$bind = array($teamName, $teamCaptain, $teamCoach, $teamPhone, $teamEmail, $teamWebsite, $schoolID, $photoID, $teamID);
		
		return $this->db->query($sql, $bind);	
	}//end of function
	
	function viewTeams() {
		$status = $this->input->post('status');
		
		$sql = "SELECT DISTINCT u.*, s.schoolName, t.teamMascot, p.photoLink
				FROM SCHOOLS s, TEAMS t, AVAILABILITY a, USERS u, PHOTOS p 
				WHERE s.schoolID = t.schoolID 
				AND t.teamID = a.teamID 
				AND a.userID = u.userID 
				AND t.photoID = p.photoID
				AND u.userStatus = 'Active'";
		 	
		if($status == 'Active'){
			$sql .= " AND u.userStatus = 'Active' ORDER BY s.schoolName ASC";
		}
		else {
			$sql .= " AND u.userStatus = 'Inactive' ORDER BY s.schoolName ASC";
		}
					
		return $this->db->query($sql);	
	} //end of function
	
}//end of class
?>