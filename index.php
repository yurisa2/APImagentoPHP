<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set("soap.wsdl_cache_enabled","0");

require_once 'include/functions.php';

echo '<pre>';

// magento_info();

// echo magento_session();

// magento_catalogProductList();


var_dump(magento_catalogProductInfo('EP-51-35051'));

 ?>
