<?php
class TestModel extends MY_Model {
	function getProducts(){
		$sql="SELECT productName
			  FROM test_products";
		
		return $this->db->query($sql);
	}
	
	function getCar($sort=''){
		$sql="SELECT test_categories.cat_name, test_products.product_name
				FROM test_products JOIN test_categories ON (test_products.cat_id)
				WHERE test_products.product_name = $sort
				AND test_products.cat_id=test_categories.cat_id";
		
		return $this->db->query($sql);
	}
}

?>