<?php
class ScheduleModel extends MY_Model {	
	// define functions here
	// SELECTS
	function getSeasons() {
		$sql = "SELECT se.seasonID, se.seasonYear, tr.tournamentID, tr.tournamentTitle, s1.schoolAddress, s1.schoolCity, s1.schoolState, s1.schoolZip, tr.tournamentDate, s1.schoolName 'Home School', tm.teamMascot 'Home Team', s2.schoolName 'Away School', tms.teamMascot 'Away Team', g.gameID, g.gameDate, g.homeTeamScore, g.awayTeamScore, g.gameStartTime
				FROM SEASONS se 
				JOIN TOURNAMENTS tr ON se.seasonID = tr.seasonID
				JOIN GAMES g ON tr.tournamentID = g.tournamentID 
				JOIN TEAMS tm ON g.teamIDHome = tm.teamID 
				JOIN TEAMS tms ON g.teamIDAway = tms.teamID 
				JOIN SCHOOLS s1 ON s1.schoolID = tm.schoolID
				JOIN SCHOOLS s2 ON s2.schoolID = tms.schoolID 
				ORDER BY se.seasonYear DESC, g.gameDate ASC, g.gameStartTime ASC;";

		return $this->db->query($sql);
	}//end of function
	
	function getSeasonYears() { //for sidebar on schedule page
		$sql = "SELECT DISTINCT seasonYear
				FROM SEASONS 
				ORDER BY seasonYear DESC;"; 	
		
		return $this->db->query($sql);
	}//end of function
	
	function getRecentResults() { //for homepage
		$sql = "SELECT tr.tournamentTitle, sc.schoolName 'Home School', tm.teamMascot 'Home Team', sch.schoolName 'Away School',  tms.teamMascot 'Away Team', sc.schoolAddress, sc.schoolCity, sc.schoolState, sc.schoolZip, g.gameDate, g.homeTeamScore, g.awayTeamScore, g.gameStartTime, p.photoLink 'homePhoto', ps.photoLink 'awayPhoto'
				FROM TOURNAMENTS tr
				JOIN GAMES g
				ON tr.tournamentID = g.tournamentID
				JOIN TEAMS tm
				ON g.teamIDHome = tm.teamID
				JOIN SCHOOLS sc
				ON tm.schoolID = sc.schoolID
				JOIN TEAMS tms
				ON g.teamIDAway = tms.teamID
				JOIN SCHOOLS sch
				ON tms.schoolID = sch.schoolID
				JOIN PHOTOS p
				ON tm.photoID = p.photoID
				JOIN PHOTOS ps
				ON tms.photoID = ps.photoID
				ORDER BY gameDate DESC;";	
				
		/*$sql = "SELECT tr.tournamentTitle, sc.schoolName 'Home School', tm.teamMascot 'Home Team', sch.schoolName 'Away School',  tms.teamMascot 'Away Team', sc.schoolAddress, sc.schoolCity, sc.schoolState, g.gameDate, g.homeTeamScore, g.awayTeamScore, g.gameStartTime, p.photoLink 'homePhoto', ps.photoLink 'awayPhoto'
				FROM TOURNAMENTS tr
				JOIN GAMES g
				ON tr.tournamentID = g.tournamentID
				JOIN TEAMS tm
				ON g.teamIDHome = tm.teamID
				JOIN SCHOOLS sc
				ON tm.schoolID = sc.schoolID
				JOIN TEAMS tms
				ON g.teamIDAway = tms.teamID
				JOIN SCHOOLS sch
				ON tms.schoolID = sch.schoolID
				JOIN PHOTOS p
				ON tm.photoID = p.photoID
				JOIN PHOTOS ps
				ON tms.photoID = ps.photoID
				ORDER BY gameDate DESC;"; */
		
		return $this->db->query($sql);		
	}//end of function	
	
	function getSidebarSchoolAddress() {
		$sql = "SELECT s.schoolName, s.schoolAddress
				FROM TOURNAMENTS tr
				JOIN GAMES g
				ON tr.tournamentID = g.tournamentID
				JOIN TEAMS t
				ON g.teamIDHome = t.teamID
				JOIN SCHOOLS s
				ON t.schoolID = s.schoolID;";
					
		//$sql2 = "SELECT s.schoolName
				//FROM TOURNAMENTS tr
				//JOIN GAMES g
				//ON tr.tournamentID = g.tournamentID
				//JOIN TEAMS t
				//ON g.teamIDHome = t.teamID
				//JOIN SCHOOLS s
				//ON t.schoolID = s.schoolID
				//WHERE tr.tournamentLocation=s.schoolAddress;";	
						
				return $this->db->query($sql);		
	}//end of function	
			
	function addTournamentInfo($tournamentID='') {
		$tournamentTitle = $this->input->post('tournamentTitle');		
		$tournamentLocation = $this->input->post('tournamentLocation');
		$tournamentCity = $this->input->post('tournamentCity');
		$tournamentState = $this->input->post('tournamentState');
		$tournamentZip = $this->input->post('tournamentZip');
		$tournamentDescription = $this->input->post('tournamentDescription');
		$tournamentStartDate = $this->input->post('tournamentStartDate');
		$tournamentEndDate = $this->input->post('tournamentEndDate');
		$tournamentWinner = $this->input->post('tournamentWinner');
						
		$sql = "INSERT INTO TOURNAMENTS (tournamentTitle, tournamentLocation, 
				tournamentCity, tournamentState, tournamentZip, tournamentDescription, 
				tournamentStartDate, tournamentEndDate, tournamentWinner, seasonID) 
				VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
		
		$bind = array($tournamentID); 
		
		return $this->db->query($sql,$bind);
	}//end of function
	
	function addGameInfo($tournamentID='', $teamIDHome='', $teamIDAway='') {		
		$homeTeamScore = $this->input->post('homeTeamScore');
		$awayTeamScore = $this->input->post('awayTeamScore');
		$gameStartTime = $this->input->post('gameStartTime');
		$gameDate = $this->input->post('gameDate');		
		//$gameLocation = $this->input->post('gameLocation');	
		
		$sql = "INSERT INTO GAMES (homeTeamScore, awayTeamScore, gameStartTime, gameDate, tournamentID, teamIDHome, teamIDAway) 
				VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
		
		$bind = array($tournamentID, $teamIDHome, $teamIDAway); 
		
		return $this->db->query($sql,$bind);
	}//end of function
	
	function removeTournamentInfo($tournamentID='') {		
		$sql = "DELETE FROM TOURNAMENTS
				WHERE tournamentID = ?;";//Delete
		
		$bind = array($tournamentID);
		
		return $this->db->query($sql,$bind);
	}//end of function
	
	function removeGameInfo($gameID='') {		
		$sql = "DELETE FROM GAMES
				WHERE gameID = ?;";//Delete
		
		$bind = array($gameID);
		
		return $this->db->query($sql,$bind);
	}//end of function
	
	function updateTournamentInfo($tournamentID='') {
		$tournamentTitle = $this->input->post('tournamentTitle');		
		$tournamentLocation = $this->input->post('tournamentLocation');
		$tournamentCity = $this->input->post('tournamentCity');
		$tournamentState = $this->input->post('tournamentState');
		$tournamentZip = $this->input->post('tournamentZip');
		$tournamentDescription = $this->input->post('tournamentDescription');
		$tournamentDate = $this->input->post('tournamentDate');
		$tournamentWinner = $this->input->post('tournamentWinner');
		
		$sql = "UPDATE TOURNAMENTS
				SET tournamentTitle = ?, tournamentLocation= ?, 
				tournamentCity = ?, tournamentState = ?, 
				tournamentZip = ?, tournamentDescription = ?, 
				tournamentDate = ?, tournamentWinner = ?
				WHERE tournamentID = ?;";
				
		$bind = array($tournamentID); 
				
		return $this->db->query($sql,$bind);
	}//end of function
	
	function updateGameInfo($tournamentID='', $gameID='') {	
		$homeTeamScore = $this->input->post('homeTeamScore');
		$awayTeamScore = $this->input->post('awayTeamScore');
		$gameStartTime = $this->input->post('gameStartTime');
		$gameDate = $this->input->post('gameDate');		
		//$gameLocation = $this->input->post('gameLocation');
		$teamIDHome = $this->input->post('homeTeam');
		$teamIDAway = $this->input->post('awayTeam');
		
		$sql = "UPDATE GAMES 
				SET homeTeamScore = ?, awayTeamScore = ?, gameStartTime = ?, 
				gameDate = ?, tournamentID = ?, 
				teamIDHome = ?, teamIDAway = ?
				WHERE gameID = ?;";
				
		$bind = array($tournamentID, $gameID); 
				
		return $this->db->query($sql,$bind);
	}//end of function
		
	function showAvailableWeekends() { //shows list of available weekends			
		$sql = "SELECT a.availabilityDate, s.schoolName, a.availabilityLevel, a.timeOfCreation, u.userID, u.userFirstName, u.userLastName, u.userType, p.photoLink, pic.photoLink AS ProfilePic
				FROM USERS u
				LEFT JOIN AVAILABILITY a 
				ON u.userID = a.userID
				LEFT JOIN TEAMS t
				ON a.teamID = t.teamID
				LEFT JOIN SCHOOLS s
				ON t.schoolID = s.schoolID
				LEFT JOIN PHOTOS p
				ON t.photoID = p.photoID
				LEFT JOIN PHOTOS pic 
				ON u.userID = pic.uploaderID
				AND pic.photoLink LIKE 'public/images/profile/%'
				ORDER BY a.availabilityDate ASC, a.availabilityLevel ASC"; 
		
		return $this->db->query($sql);
	}//end of function
	
	function validateWeekend() { //validate choosen weekends, MAY NOT NEED				
		$availabilityDate = $this->input->post('availabilityDate');		
		$availabilityLevel = $this->input->post('availabilityLevel');
		
		if(validateDate($availabilityDate, 'm/d/Y') == FALSE) {
				if($availabilityLevel=='Yes' || $availabilityLevel=='Maybe' || $availabilityLevel=='No'){
					return $error = '';
				}//end of if
		}//end of if
		else {
			return $error;
		}//end of else
	} //end of function
	
	function saveChosenWeekend() { //Saves chosen weekends 				
		$availabilityDate = date('Y-m-d', strtotime($this->input->post('availabilityDate')));		
		$availabilityLevel = $this->input->post('availabilityValue');
		$userID = $this->session->userdata('UserID');
		$teamID = $this->session->userdata('TeamID');
		
		$sql = "INSERT INTO AVAILABILITY (availabilityDate, availabilityLevel, timeOfCreation, userID, teamID) 
				VALUES (?, ?, NOW(), ?, ?);";
				 
		$bind = array($availabilityDate, $availabilityLevel, $userID, $teamID);
				
		return $this->db->query($sql, $bind);
	}//end of function
	
	function updateWeekend() { //Saves updated choosen weekends 					
		$availabilityDate = $this->input->post('availabilityDate');		
		$availabilityLevel = $this->input->post('availabilityValue');
		$userID = $this->session->userdata('UserID');
		$teamID = $this->session->userdata('TeamID');
		
		$sql = "UPDATE AVAILABILITY SET availabilityLevel = ?,
										timeOfCreation = NOW()
										WHERE teamID = ? AND userID = ? AND availabilityDate = ?"; // LOOK AT THIS!
		$bind = array($availabilityLevel, $teamID, $userID, $availabilityDate);
				
		return $this->db->query($sql, $bind);
	}//end of function
	
}//end of class
?>