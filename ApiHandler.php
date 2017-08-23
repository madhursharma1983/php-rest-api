<?php
require_once("HeaderFormation.php");
require_once("Product.php");

/*
Handler class between main class and getter page
*/		
		
class ApiHandler extends HeaderFormation {
	/*
	Format set of result (JSON/XML/HTML)
	*/
	function __construct() {
        global $format;
		$this->format = $format;
    }
	
	function getAllProducts() {	
		$product = new Product();
		$rawData = $product->getAllProduct();
		$this->getResult($rawData,'all');
	}
	
	public function getProduct($id) {
		$product = new Product();
		$rawData = $product->getProduct($id);
        $this->getResult($rawData,'single');
	}
	
	public function addProduct($mbname) {
        $product = new Product();
		$rawData = $product->addProduct($mbname);
		$this->getResult($rawData,'add');
	}
	
	public function delProduct($id) {
        $product = new Product();
		$rawData = $product->delProduct($id);
		$this->getResult($rawData,'del');
	}
	
	public function getResult($rawData,$opt){
	    if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No products found!');		
			if( in_array($opt,array('add','del')) )
			$rawData = array('error' => 'Some error occured!');		
		} else {
			$statusCode = 200;
		}
		echo $response =  $this->getsetencoding($statusCode,$rawData);
	}
	
	public function getsetencoding($statusCode,$rawData){
	    $requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
		
		if($this->format == 'json'){
			$response = $this->encodeJson($rawData);
			return $response;
		} else if($this->format == 'html'){
			$response = $this->encodeHtml($rawData);
			return $response;
		} else if($this->format == 'xml'){
			$response = $this->encodeXml($rawData);
			return $response;
		}else{
			$response = $this->encodeJson($rawData);
			return $response;
		}
	}
	
	public function encodeHtml($responseData) {
		$htmlResponse = "<table border='1'>";
		foreach($responseData as $key=>$value) {
    			$htmlResponse .= "<tr><td>". $key. "</td><td>". $value. "</td></tr>";
		}
		$htmlResponse .= "</table>";
		return $htmlResponse;		
	}
	
	public function encodeJson($responseData) {
		$jsonResponse = json_encode($responseData);
		return $jsonResponse;		
	}
	
	public function encodeXml($responseData) {
		// creating object of SimpleXMLElement
		$xml = new SimpleXMLElement('<?xml version="1.0"?><product></product>');
		foreach($responseData as $key=>$value) {
			$xml->addChild($key, $value);
		}
		return $xml->asXML();
	}
	
	
}
?>