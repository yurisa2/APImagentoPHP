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
    'firstname' => 'Teste Magento',
    'lastname' => 'Testando',
    'street' => 'Rua Ficticia para Teste',
    'city' => 'Ficticio de Teste',
    'region' => 'SP',
    'postcode' => '12123456',
    'country_id' => 'BR',
    'telephone' => '11985655215',

  ));

$cust = array(
    "firstname" => "testFirstname",
    "lastname" => "testLastName",
    "email" => "testEmail@mail.com",
    "mode" => "guest"
      );

$payment = array(
    'po_number' => null,
    'method' => 'checkmo',
    'cc_cid' => null,
    'cc_owner' => null,
    'cc_number' => null,
    'cc_type' => null,
    'cc_exp_year' => null,
    'cc_exp_month' => null
    );
  // var_dump($prods);

  $carrinho = magento_shoppingCartCreate();

  echo "Retorno cartProdAdd: <br>";
  var_dump(magento_shoppingCartProductAdd($carrinho,$prods));
  echo "<br>";

  echo "Lista shoppingCartProductList: <br>";
  $lista_carrinho = magento_shoppingCartProductList($carrinho);
  var_dump($lista_carrinho);
  echo "# de itens shoppingCartProductList: ".count($lista_carrinho)." <br>";
  var_dump($cust);
  echo "Customer Set: ".magento_shoppingCartCustomerSet($carrinho,$cust)." <br>";

  var_dump($billing);
  echo "Billing Set: ".magento_shoppingCartCustomerAddresses($carrinho,$billing)." <br>";

  echo "Cart Shipping: ".magento_shoppingCartShippingMethod($carrinho)."<br>";

  echo "Dados de pagamento: ".magento_shoppingCartPaymentMethod($carrinho, $payment)."<br>";
  var_dump($payment);

  echo "Cart Order: ".var_dump(magento_shoppingCartOrder($carrinho))."<br>";
  ?>
