<?php
class AboutUsModel extends MY_Model {
		
	function loadConferenceInfo(){
		$tabName = "About Us";					
		$sql = "SELECT contentID, contentTitle, contentText, tabName
				FROM CONTENTS JOIN TABS USING(tabID)
				WHERE TABS.tabName = ?
				ORDER BY contentID ASC;";
		
		$bind = array($tabName);
		
		return $this->db->query($sql, $bind);
	}//end of function
	
	function validateContent($contentTitle='', $contentText='') {
		if(empty($contentText) || empty($contentTitle)) {
			$error = "<p>All fields must be completed before content can be updated.</p>";
		}
		else {
			$error = [];
		}
		
		return $error;
	}//end of function
	
	function updateContent($contentID, $contentTitle, $contentText) { 
		$userID = $this->session->userdata('UserID');
		
		$sql = "UPDATE CONTENTS SET contentTitle = ?, contentText = ?, timeCreated = NOW(), userID = ?
				WHERE contentID = ?";
				
		$bind = array($contentTitle, $contentText, $userID, $contentID);
	
		return $this->db->query($sql, $bind);	
	}//end of function
	
}//end of class
?>
	