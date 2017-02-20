<?php
class FooterModel extends MY_Model {
	function address(){ 	
		$sql="SELECT schoolName, schoolAddress, schoolCity, schoolState, schoolZip, schoolFacilityPhone 
			  FROM SCHOOLS 
			  WHERE schoolName = 'Southern Illinois University Carbondale'";
		
		return $this->db->query($sql);	
	}//end of function

} //end of class
?>