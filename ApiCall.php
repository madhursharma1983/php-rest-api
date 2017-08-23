<?php
require_once("Config.php");

$url = $host_url.'rest/product/list/json';           //get list of all products defined in global products array (config.php)
//$url = $host_url.'rest/mobile/list/2/json';          //get product by id
//$url = $host_url.'rest/mobile/delete/1/json';        //delete product by id
//$url = $host_url.'rest/mobile/add/HTC Desire/json';  //add product by name

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, "$authentication_user:$authentication_password");
$result = curl_exec($ch);
curl_close($ch);  
echo($result);