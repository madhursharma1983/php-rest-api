this example uses the security of basic authentication

First need to change the host_url to edit where you are putting these files.

ApiCall.php : calling the rest api's by CURL (change here the URLs to get the result of different API's)

Config.php : it contains global products array , testing url (need to edit for your server) , username and password

ApiHandler.php : Handler class between Product class and ApiController.php. display the result of desired format (json/xml/html)

Product.php : main class for CRUD. it add , delete and list the products from products array which is defined in config.php

ApiController.php : calling page in api.

.htaccess : rules defined for add , delte and listing.

HeaderFormation.php : header creation for the result.


Test Scenerios:
==========================
1) Unzip the zip and place the folder to document root and first need to change host_url in config.php
2) by commenting and un commenting the urls in ApiCall.php
3) change format to display (json,xml,html)

e.g. you can change the format for json to xml or html in commenting or uncommenting lines.

$host_url.'rest/product/list/json'   (list in json)
$host_url.'rest/product/list/xml'    (list in xml)
$host_url.'rest/product/list/html'   (list in html)
