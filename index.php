<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set("soap.wsdl_cache_enabled","1");
ini_set('xdebug.var_display_max_depth', 5);
ini_set('xdebug.var_display_max_children', 350);
ini_set('xdebug.var_display_max_data', 1024);

require_once 'include/all_include.php';

echo '<pre>';

// magento_info();

// echo magento_session();

// var_dump(magento_catalogProductList());

//var_dump(magento_catalogProductInfo('EP-51-35051'));

// var_dump(magento_catalogProductInfo_description('EP-51-35051'));

// var_dump(magento_catalogInventoryStockItemList('EP-51-35051'));

//var_dump(magento_product_summary('EP-51-35051'));

// var_dump(magento_catalogInventoryStockItemUpdate('EP-51-35051','665'));

// var_dump(magento_shoppingCartCreate());

$prods = array(
  array('EP-51-40983','1'),
  array('EP-51-40654','4')
);

$billing =
array(
  array(
    'mode' => 'billing',
    'firstname' => 'first name',
    'lastname' => 'last name',
    'street' => 'street address',
    'city' => 'city',
    'region' => 'region',
    'postcode' => 'postcode',
    'country_id' => 'US',
    'telephone' => '123456789',
    'is_default_billing' => 1
  ));

$cust = array(
    "firstname" => "testFirstname",
    "lastname" => "testLastName",
    "email" => "testEmail@mail.com",
    "mode" => "guest"
      );

  // var_dump($prods);

  $carrinho = magento_shoppingCartCreate();

  echo "Retorno cartProdAdd: <br>";
  var_dump(magento_shoppingCartProductAdd($carrinho,$prods));
  echo "<br>";

  echo "Lista shoppingCartProductList: <br>";
  $lista_carrinho = magento_shoppingCartProductList($carrinho);
  var_dump($lista_carrinho);
  echo "# de intens shoppingCartProductList: ".count($lista_carrinho)." <br>";
  var_dump($cust);
  echo "Cutomer Set: ".magento_shoppingCartCustomerSet($carrinho,$cust)." <br>";

  var_dump($billing);
  echo "Billing Set: ".shoppingCartCustomerAddresses($carrinho,$billing)." <br>";


  ?>
