<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends MY_Controller {

	public function index($sort=''){
		$this->load->model('TestModel');
			
		$result = $this->TestModel->getProducts()->result_array();	
		$data['productList'] = $result;	
		
		$result2 = $this->TestModel->getCar()->result_array();	
		$data['carResult'] = $result2;	
		
		$data['title'] = 'Test';
		$data['view'] = 'test/index';
		$this->load->view($this->layout, $data); 
	}
	
	public function getList($sort='') { //saves new user types
		$this->load->model('TestModel');
		
		$result2 = $this->TestModel->getCar($sort)->result_array();	
		$data['carResult'] = $result2;		
		
		$data['title'] = 'Test';
		$data['view'] = 'test/index';
	}//end of function
	
	
}
	