<?php
class PhotosModel extends MY_Model {
	function getCarouselPics(){
		$sql="SELECT photoLink, photoDescription
			  FROM PHOTOS
			  WHERE photoLink LIKE 'public/images/home/carousel/%'
			  ORDER BY photoID DESC
			  LIMIT 0,4";
		
		return $this->db->query($sql);		
	}//end of function
	
	function addCarouselPics($carouselDescription, $carouselPic) {
		$userID = $this->session->userdata('UserID');
		
		$sql = "INSERT INTO PHOTOS(photoDate, photoTime, photoDescription, photoLink, uploaderID)
				VALUES ";
				
		$bind = array();
		
		for($i = 3; $i > 0; $i--) {
			$sql = $sql."(CURDATE(), NOW(), ?, ?, ?), ";
			array_push($bind, $carouselDescription[$i], $carouselPic[$i], $userID);
		}
		
		$sql = $sql."(CURDATE(), NOW(), ?, ?, ?)";
		array_push($bind, $carouselDescription[0], $carouselPic[0], $userID);
		
		return $this->db->query($sql, $bind);
	}
	
	function addTeamLogo($description, $filename) {
		$userID = $this->session->userdata('UserID');
		
		$sql = "INSERT INTO PHOTOS(photoDate, photoTime, photoDescription, photoLink, uploaderID)
				VALUES (CURDATE(), NOW(), ?, ?, ?)";
				
		$bind = array($description, $filename, $userID);
		
		return $this->db->query($sql, $bind);
	}
	
	function getMaxID() {
		$sql = "SELECT MAX(photoID) FROM PHOTOS";
		
		return $this->db->query($sql);
	}

} //end of class
?>