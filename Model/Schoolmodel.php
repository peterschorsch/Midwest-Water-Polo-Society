<?php
class SchoolModel extends MY_Model {
	// define constants here	
		
	/*** define functions here ***/
	function verifySchoolInfo() { // DONE
		$this->load->library('form_validation');
		$this->form_validation->set_rules('schoolName','Name of the school', 'trim|required|alpha_dash');
		$this->form_validation->set_rules('schoolAddress','Street address of the school', 'trim|required|alpha_numeric');
		$this->form_validation->set_rules('schoolCity','City of the school', 'trim|required|alpha_dash');
		$this->form_validation->set_rules('schoolState','Abbreviated state of the school', 'trim|required|alpha|exact_length[2]');
		$this->form_validation->set_rules('schoolZip','Zip code of the school', 'trim|required|numeric|integer');
		
		if($this->form_validation->run() == FALSE) {
			return vaildation_errors();
		}
		else {
			return '';
		}
	}//end of function
	
	/**** SELECTS ****/	
	function getSchoolInfo($schoolID="") {
		$sql = "SELECT * FROM SCHOOLS";
		
		if(!empty($schoolID)) {
			$sql = $sql." WHERE schoolID = ?";
		}
		
		$bind = array($schoolID);
		
		return $this->db->query($sql);
	}//end of function	
		
	/**** INSERTS ****/
/* function addSchoolInfo() {
		$schoolName = $this->input->post('schoolName');
		$schoolAddress = $this->input->post('schoolAddress');
		$schoolCity = $this->input->post('schoolCity');
		$schoolState = $this->input->post('schoolState');
		$schoolZip = $this->input->post('schoolZip');
		
		$sql = "INSERT SQL";//Insert needed!
		
		$bind = array($schoolName, $schoolAddress, $schoolCity, $schoolState, $schoolZip);
		
		return $this->db->query($sql, $bind);
	}//end of function */
	
	/**** UPDATES ****/
/*	function updateSchoolInfo($schoolID) {
		$schoolName = $this->input->post('schoolName');
		$schoolAddress = $this->input->post('schoolAddress');
		$schoolCity = $this->input->post('schoolCity');
		$schoolState = $this->input->post('schoolState');
		$schoolZip = $this->input->post('schoolZip');
		
		$sql = "UPDATE SQL";//Insert needed!
		
		$bind = array($schoolName, $schoolAddress, $schoolCity, $schoolState, $schoolZip);
		
		return $this->db->query($sql, $bind);
	}//end of function */
	
	/**** DELETES ****/
/*	function deleteSchoolInfo($schoolID) {
		$sql = "DELETE FROM SCHOOLS WHERE schoolID = ?;";
		
		$bind = array($schoolID);
		
		return $this->db->query($sql,$bind);
	}//end of function */
	
	function listOfSchools(){
		$sql = "SELECT schoolName
				FROM SCHOOLS";
		
		return $this->db->query($sql);
	} 
}//end of class
?>