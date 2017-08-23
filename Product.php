<?php
/* 
CRUD operations class
*/
Class Product {
	/*
	initialize the global product array.
	*/
	function __construct() {
        global $products;
		$this->products = $products;
    }

	/*
	get all products list
	*/
	public function getAllProduct(){
		return $this->products;
	}
	
	/*
	get a product from the list
	*/
	public function getProduct($id){
		$product = array($id => ($this->products[$id]) ? $this->products[$id] : $this->products[1]);
		return $product;
	}
	
	/*
	add a product to global product array and display the final list
	*/
	public function addProduct($mbname){
		$max_index = max(array_keys($this->products));
		$this->products[$max_index+1] = $mbname;
		return $this->products;
	}	
	
	/*
	delete a product from global product array and display the final list
	*/
	public function delProduct($id){
		unset($this->products[$id]);
		return $this->products;
	}
}
?>