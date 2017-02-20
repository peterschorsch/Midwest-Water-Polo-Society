<?php
class TravelModel extends MY_Model {
	function getActiveList() { 					
		$sql = "SELECT s.*, t.teamStatus, p.photoLink
				FROM SCHOOLS s, TEAMS t, PHOTOS p 
				WHERE s.schoolID = t.schoolID
				AND t.photoID = p.photoID
				AND t.teamStatus = 'Active'
				ORDER BY s.schoolName ASC"; 				
				
		return $this->db->query($sql);
	}//end of function
	
	function getInactiveList() { 					
		$sql = "SELECT s.*, t.teamStatus, p.photoLink
				FROM SCHOOLS s, TEAMS t, PHOTOS p 
				WHERE s.schoolID = t.schoolID
				AND t.photoID = p.photoID
				AND t.teamStatus = 'Inactive'
				ORDER BY schoolName ASC"; 				
				
		return $this->db->query($sql);
	}//end of function
	
	function verifyTravelInfo() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('schoolName','Name of the school', 'trim|required');
		$this->form_validation->set_rules('schoolFacility','Name of the facility', 'trim|required');
		$this->form_validation->set_rules('schoolFacilityPhone', 'Phone number of the facility', 'trim|required|numeric|exact_length[10]');
		$this->form_validation->set_rules('schoolFacilityWebsite','Website for the facility', 'trim|required|valid_url');
		$this->form_validation->set_rules('schoolAddress','Street address of the building', 'trim|required');
		$this->form_validation->set_rules('schoolCity','City of the building', 'trim|required');
		$this->form_validation->set_rules('schoolState','State the city is in', 'trim|required|exact_length[2]|alpha');
		$this->form_validation->set_rules('schoolZip','Zip code of the building', 'trim|required|numeric|exact_length[5]');
		
		if($this->form_validation->run() == FALSE) {
			return validation_errors();
		}
		else {
			return '';
		}
	}//end of function
	
	function addTravelInfo() { 
		$schoolName = ucwords($this->input->post('schoolName'));
		$schoolAddress = ucwords($this->input->post('schoolAddress'));
		$schoolCity = ucwords($this->input->post('schoolCity'));
		$schoolState = strtoupper($this->input->post('schoolState'));
		$schoolZip = $this->input->post('schoolZip');
		$schoolFacility = ucwords($this->input->post('schoolFacility'));
		$schoolFacilityPhone = $this->input->post('schoolFacilityPhone');
		$schoolFacilityWebsite = $this->input->post('schoolFacilityWebsite');
		
		$sql = "INSERT INTO SCHOOLS (schoolName, schoolAddress, schoolCity, schoolState, schoolZip, schoolFacility, schoolFacilityPhone, schoolFacilityWebsite) 
				VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
		
		$bind = array($schoolName, $schoolAddress, $schoolCity, $schoolState, $schoolZip, $schoolFacility, $schoolFacilityPhone, $schoolFacilityWebsite);
		
		return $this->db->query($sql, $bind);
	}//end of function
	
	function updateTravelInfo($schoolID='') {
		$schoolName = ucwords($this->input->post('schoolName'));
		$schoolAddress = ucwords($this->input->post('schoolAddress'));
		$schoolCity = ucwords($this->input->post('schoolCity'));
		$schoolState = strtoupper($this->input->post('schoolState'));
		$schoolZip = $this->input->post('schoolZip');
		$schoolFacilityPhone = $this->input->post('schoolFacility');
		$schoolFacilityWebsite = $this->input->post('schoolFacilityWebsite');
				
		$sql = "UPDATE SCHOOLS 
				SET schoolName = ?, schoolAddress = ?, schoolCity = ?, schoolState = ?, 
				schoolZip = ?, schoolFacility = ?, schoolFacilityPhone = ?, schoolFacilityWebsite = ?
				WHERE schoolID = ?";
				
		$bind = array($schoolName, $schoolAddress, $schoolCity, $schoolState, $schoolZip, $schoolFacility, $schoolFacilityPhone, $schoolFacilityWebsite, $schoolID);
		
		return $this->db->query($sql, $bind);	
	}//end of function
	
	function removeTravelInfo($schoolID='') { 
		$sql = "UPDATE TEAM 
				SET teamStatus = 'Inactive'
				WHERE schoolID = ?";
		
		$bind = array($schoolID);
		
		return $this->db->query($sql, $bind);
	}//end of function
	
}//end of class
	