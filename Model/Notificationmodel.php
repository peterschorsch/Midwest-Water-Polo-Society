<?php
class NotificationModel extends MY_Model {
	// define constants here	
		
	// define functions here	
	
	// INSERT FUNCTIONS
	public function createCRNotification($notificationType, $requestID, $receiverID, $reason='') {
		$currentUserID = $this->session->userdata('UserID');
		$currentUser = $this->session->userdata('FirstName').' '.$this->session->userdata('LastName');
		
		if($notificationType == 'accepted' || $notificationType == 'rejected')
			$message = 'Request #'.$requestID.' has been '.$notificationType.' by '.$currentUser;
		
		if(isset($reason) && !empty($reason))
			$message = $message."\n\nReason Given:\n".$reason;
		
		if(isset($message)) {
			$sql = 'INSERT INTO MESSAGES (messageDate, messageTime, messageContent, senderID, receiverID)
					VALUES (CURDATE(), CURTIME(), ?, ?, ?)';
			$bind = array($message, $currentUserID, $receiverID);
			
			return $this->db->query($sql, $bind);
		}
	}//end of function
	
	function getNotificationCount() { // used to select the number of notification for a specific user. Used in the header badge. 
		$userID = $this->session->userdata('UserID');
		$typeUser = $this->session->userdata('TypeUser');
				
		$sql = 'SELECT COUNT(messageID) as count
				FROM MESSAGES
				WHERE receiverID = ?'; 
		
		$bind = array($userID);
		
		return $this->db->query($sql, $bind);
	}//end of function
	
	function getMyNotifications() { // used to view all notifications for current user
		$currentUser = $this->session->userData('UserID');
		
		$sql = 'SELECT messageDate, messageTime, messageContent, senderID FROM MESSAGES WHERE receiverID = ?'; // SQL to select all notifications where userId = $currentUser
		$bind = array($currentUser);
		
		return $this->db->query($sql, $bind);
	}// end of function
	
}//end of model
?>