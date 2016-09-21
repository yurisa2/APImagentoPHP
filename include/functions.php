<?php
require_once 'include/config.php';

function magento_obj()
{
  global $wsdl;

  $client = new SoapClient($wsdl, array(
  'trace' => 1,
  "exceptions" => 0,
  'style'=> SOAP_DOCUMENT,
  'use'=> SOAP_LITERAL));

return $client;

}

function magento_session()
{
  global $magento_soap_user;
  global $magento_soap_password;

  $session = magento_obj()->login($magento_soap_user,$magento_soap_password);

return $session;

}

function magento_info()
{
  $result = magento_obj()->magentoInfo(magento_session());

// var_dump($result);

return $result;
}

function magento_catalogProductList()
{
  $result = magento_obj()->catalogProductList(magento_session());

var_dump($result);

}


?>
