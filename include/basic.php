<?php

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

  $filename = 'magento_session.json';

  if(!file_exists($filename))
  {
    $session = magento_obj()->login($magento_soap_user,$magento_soap_password);

    $mag_ses = array(
    'session' => $session,
    'time' => time()
    );
    file_put_contents($filename, json_encode($mag_ses));
  }

  $file = file_get_contents($filename);
  $file_array = json_decode($file);

  // var_dump($file_array); //DEBUG

  if($file_array->session < time() - 3000) //Default value for Magento API session is 3600 - I should put that as a config... Think about it
  {
    $session = magento_obj()->login($magento_soap_user,$magento_soap_password);

    $mag_ses = array(
    'session' => $session,
    'time' => time()
    );
    file_put_contents($filename, json_encode($mag_ses));
  }

  $file = file_get_contents($filename);
  $file_array = json_decode($file);

  $return = $file_array->session;

return $return;
}

function magento_info()
{
  $result = magento_obj()->magentoInfo(magento_session());

return $result;
}




 ?>
