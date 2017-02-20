<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Links extends MY_Controller {

	public function index(){
		$this->load->model('LinksModel');
			
		$result = $this->LinksModel->getLinks()->result_array();	
		$data['links'] = $result;		
		
		$data['title'] = 'Midwest Water Polo - Links';
		$data['view'] = 'links/index';
		$this->load->view($this->layout, $data); 
	}//end of function
		
	public function addLink(){
		$this->load->model('LinksModel');
		
		$error = $this->LinksModel->verifyLinkInfo();

		if(!empty($error)) {
			// send error
		}//end of if
		else {
			if($this->LinksModel->addLinkInfo()) {
				//$this->index();
			}//end of if 
			else {
				//
			}//end of else
		}//end of else
	}
	
	public function updateLink($linkID=''){
		$this->load->model('LinksModel');
		
		$error = $this->LinksModel->verifyLinkInfo(); 
		if(!empty($error)) {
			echo '<p>'.$error.'</p>';
		}//end of if
		else {
			if($this->LinksModel->updateLinkInfo($linkID)) {
				$this->index();
			}//end of if 
			else {
				//failure to update DB
			}//end of else
		}//end of else
	}
	
	public function removeLink($linkID=''){
		$this->load->model('LinksModel');
		
		if($this->LinksModel->removeLink($linkID)) {
			$message = "<p>Link for #".$linkID." has been removed successfully</p>";
			$this->index($message);
		}//end of if		
		else {
			//something went wrong
		}//end of else
		
	}//end of function
	
	
}//end of class
?>