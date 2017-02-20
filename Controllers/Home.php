<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/home
	 *	- or -
	 * 		http://example.com/index.php/home/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/home/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()	{
		$this->load->model('ScheduleModel');
		$result = $this->ScheduleModel->getRecentResults()->result_array();
		
		if(isset($result) && !empty($result)){
			$data['sidebarInfo'] = $result;
		}
		else {
			$error = $this->ScheduleModel->getError();
			// send error somewhere!
		}			
			
		$this->load->model('PhotosModel');
		$result2 = $this->PhotosModel->getCarouselPics()->result_array();
		$data['carouselPics'] = $result2;
		
		//$result3 = $this->ScheduleModel->getSidebarSchoolAddress()->result_array();
		//$data['schoolAddress'] = $result3;
							
		// CODY - Get Article Contents
		$this->load->model('HomeModel');
		$articles = $this->HomeModel->getArticles()->result_array();
		$data['articles'] = $this->HomeModel->getArticles()->result_array();
							
		$data['title'] = 'Midwest Water Polo - Home';
		$data['view'] = 'home/index';
		$this->load->view($this->layout, $data);
	}//end of function
	
	public function updateContent($contentID) {
		$contentTitle = $this->input->post('contentTitle');
		$contentText = $this->input->post('contentText');
		$typeUser = $this->session->userdata('TypeUser');	
		$this->load->model('HomeModel');
		
		if ($typeUser == 'Admin') {	
			$error = $this->HomeModel->validateContent($contentTitle, $contentText);
			
			if(!empty($error)) {
				// redirect back to index and show error in div
				$data['title'] = 'Midwest Water Polo - Home';
				$data['view'] = 'home/index';
				$this->load->view($this->layout, $data);
			}
			else {
				if($this->HomeModel->updateContent($contentID, $contentTitle, $contentText)) {
					$this->index();
				}//end of if
				else {
					// something went wrong
					
				}//end of else
			}//end of else
		}//end of if
		else {
			$data['title'] = 'Midwest Water Polo - UNAUTHORIZED';
			$data['view'] = 'error/unauthorized';
			$this->load->view($this->layout, $data);
		}//end of else
		
	}//end of function
	
	public function updateCarousel() {
		$typeUser = $this->session->userdata('TypeUser');
		$this->load->model('HomeModel');
		$this->load->model('PhotosModel');
		$this->load->model('FileModel');
		
		if ($typeUser == 'Admin') {
			$path = 'public/images/home/carousel/';
			$error = $this->HomeModel->validateCarousel();
			
			if(!empty($error)) {
				// redirect back to index and show error in div
				$data['error'] = $error;
				$data['title'] = 'Midwest Water Polo - Home';
				$data['view'] = 'login/index';
				$this->load->view($this->layout, $data);
			}
			else {
				$desc1 = $this->input->post('carouselDescription1');
				$desc2 = $this->input->post('carouselDescription2');
				$desc3 = $this->input->post('carouselDescription3');
				$desc4 = $this->input->post('carouselDescription4');
				$carouselDesc = array($desc1, $desc2, $desc3, $desc4);
				
				
				
				$photo1 = ($_FILES['carouselPhoto1']['size'] > 0) ? $this->FileModel->uploadFile($path, 'carouselPhoto1') : array('file_name' => $this->input->post('carouselFilename1'));
				$photo2 = ($_FILES['carouselPhoto2']['size'] > 0) ? $this->FileModel->uploadFile($path, 'carouselPhoto2') : array('file_name' => $this->input->post('carouselFilename2'));
				$photo3 = ($_FILES['carouselPhoto3']['size'] > 0) ? $this->FileModel->uploadFile($path, 'carouselPhoto3') : array('file_name' => $this->input->post('carouselFilename3'));
				$photo4 = ($_FILES['carouselPhoto4']['size'] > 0) ? $this->FileModel->uploadFile($path, 'carouselPhoto4') : array('file_name' => $this->input->post('carouselFilename4'));
				$carouselPhoto = array($path.$photo1['file_name'], $path.$photo2['file_name'], $path.$photo3['file_name'], $path.$photo4['file_name']);
				
				if($this->PhotosModel->addCarouselPics($carouselDesc, $carouselPhoto)) {
					redirect('home/index');
				}//end of if
				else {
					$data['title'] = 'Midwest Water Polo - Home';
					$data['view'] = 'login/index';
					$this->load->view($this->layout, $data);
				}//end of else
			}//end of else
		}//end of if
		else {
			$data['title'] = 'Midwest Water Polo - UNAUTHORIZED';
			$data['view'] = 'error/unauthorized';
			$this->load->view($this->layout, $data);
		}//end of else
		
	}//end of function
	
}//end of class
