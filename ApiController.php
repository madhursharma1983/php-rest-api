<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

require_once("Config.php");

if (isset($_SERVER['PHP_AUTH_USER']) && $_SERVER['PHP_AUTH_USER']==$authentication_user &&  $_SERVER['PHP_AUTH_PW']==$authentication_password) {
} else {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'You are not authorized to view this page';
    exit;
}

require_once("ApiHandler.php");
		
$view = "";
if(!empty($_GET["action"]))
	$view = $_GET["action"];

$format = $_GET["format"];	
if(empty($_GET["format"]))	
    $format = 'json';
	
/*
controls the RESTful services
URL mapping
*/
switch($view){

	case "all":
		// to handle REST Url rest/product/list/json
		$apihandler = new ApiHandler();
		$apihandler->getAllProducts();
		break;
	case "single":
		// to handle REST Url rest/product/show/<id>
		$apihandler = new ApiHandler();
		$apihandler->getProduct($_GET["id"]);
		break;
	case "del":
		// to handle REST Url rest/product/delete/<id>
		$apihandler = new ApiHandler();
		$apihandler->delProduct($_GET["id"]);
		break;
	case "add":
		// to handle REST Url rest/product/add/<name of product>
		$apihandler = new ApiHandler();
		$apihandler->addProduct($_GET["mbname"]);
		break;		
	case "" :
		//404 - not found;
		break;
}
?>