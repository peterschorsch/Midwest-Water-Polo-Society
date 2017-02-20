<?php
class FileModel extends MY_Model {
	function uploadFile($path="public/images/", $file) {
		$config['upload_path'] = './'.$path;
		$config['allowed_types'] = 'gif|jpg|png';
		
		$this->load->library('upload', $config);
		
		$result = $this->upload->do_upload($file);
		if($result) {
			return $this->upload->data();
		}//end of if
		else {
			return FALSE;
		}//end of else
	}//end of function
	
	function moveFile($origLocation, $newLocation) {
		$this->load->helper('file');
		
		$file = read_file($origLocation);
		write_file($newLocation, $file);
		
		delete_files($origLocation);
	}//end of function
}//end of class ?>