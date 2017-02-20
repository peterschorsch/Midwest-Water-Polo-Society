<?php
class LinksModel extends MY_Model {
		
	function getLinks(){			
		$sql = "SELECT DISTINCT l.*, u.userFirstName, u.userLastName, s.schoolName
				FROM LINKS l, USERS u, AVAILABILITY a, TEAMS t, SCHOOLS s 
				WHERE u.userID = l.userID
				AND u.userID = a.userID
				AND a.teamID = t.teamID
				AND t.teamID = s.schoolID
				ORDER BY l.linkName ASC";	
		
		return $this->db->query($sql);
	}//end of function
	
	function verifyLinkInfo(){			
		$this->load->library('form_validation');
		$this->form_validation->set_rules('linkName','Name of the link', 'trim|required');
		$this->form_validation->set_rules('linkDescription','Description for the Link', 'trim|required');
		$this->form_validation->set_rules('linkURL','URL for the Link', 'trim|required|valid_url');
				
		if($this->form_validation->run() == FALSE) {
			return validation_errors();
		}
		else {
			return '';
		}
		
		return $this->db->query($sql);
	}//end of function
	
	function addLinkInfo(){			
		$linkName = ucwords($this->input->post('linkName'));
		$linkDescription = $this->input->post('linkDescription');
		$linkURL = $this->input->post('linkURL');
		$linkDateTime = date("Y-m-d H:i:s");
		$userID = $this->session->userdata('UserID'); 	

		$sql = "INSERT INTO LINKS (linkName, linkDescription, linkURL, linkDateTime, userID) 
				VALUES (?, ?, ?, ?, ?)";
		
		$bind = array($linkName, $linkDescription, $linkURL, $linkDateTime, $userID);
		
		return $this->db->query($sql, $bind);
	}//end of function
	
	function updateLinkInfo($linkID=''){			
		$linkName = ucwords($this->input->post('linkName'));
		$linkDescription = $this->input->post('linkDescription');
		$linkURL = $this->input->post('linkURL');
		$linkDateTime = date("Y-m-d H:i:s");
		$userID = $this->session->userID;	
		
		$sql = "UPDATE LINKS 
				SET linkName = '$linkName', linkDescription = '$linkDescription', linkURL = '$linkURL', linkDateTime = '$linkDateTime', userID = '$userID'
				WHERE linkID = '$linkID'";
				
		$bind = array($linkID, $linkName, $linkDescription, $linkURL, $linkDateTime, $userID);
		
		return $this->db->query($sql, $bind);	
	}//end of function
	
	function removeLink($linkID=''){			
		$sql = "DELETE FROM LINKS
				WHERE linkID = ?";	
		
		$bind = array($linkID);
		
		return $this->db->query($sql, $bind);
	}//end of function	
		
}//end of class
?>
	