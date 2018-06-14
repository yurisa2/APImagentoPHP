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

$address = array(
        array(
            'mode' => 'shipping',
            'firstname' => 'Teste Magento',
            'lastname' => 'Teste Magento',
            'street' => 'street address',
            'city' => 'Ficticio de Teste',
            'region' => 'SP',
            'telephone' => '34343434343434',
            'postcode' => 'postcode',
            'country_id' => 'BR',
            'is_default_shipping' => 0,
            'is_default_billing' => 0
        ),
        array(
            'mode' => 'billing',
            'firstname' => 'Teste Magento',
            'lastname' => 'Teste Magento',
            'street' => 'street address',
            'city' => 'Ficticio de Teste',
            'region' => 'SP',
            'telephone' => '34343434343434',
            'postcode' => 'postcode',
            'country_id' => 'BR',
            'is_default_shipping' => 0,
            'is_default_billing' => 0
        ),
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
    'is_default_billing' => 1
  ));

// $customerCreate = array(
//   'email' => 'cust-tst-mail@example.org',
//   'firstname' => 'Dough',
//   'lastname' => 'Deeks',
//   'password' => 'password',
//   'website_id' => 1,
//   'store_id' => 1,
//   'group_id' => 1);
//
// var_dump(magento_customerCustomerCreate($customerCreate));

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


echo "Customer List: <br>";
$id = magento_session();

// $obj_cust = magento_customerCustomerList($id);
// $obj_cust = (array) $obj_cust;
// var_dump($obj_cust);

  echo "Retorno cartProdAdd: <br>";
  var_dump(magento_shoppingCartProductAdd($carrinho,$prods));
  echo "<br>";

  echo "Lista shoppingCartProductList: <br>";
  $lista_carrinho = magento_shoppingCartProductList($carrinho);
  var_dump($lista_carrinho);
  echo "# de itens shoppingCartProductList: ".count($lista_carrinho)." <br>";
  //var_dump($cust);
  echo "Customer Set: ".magento_shoppingCartCustomerSet($carrinho,$cust)." <br>";

  var_dump($billing);
  echo "Billing Set: ".magento_shoppingCartCustomerAddresses($carrinho,$address)." <br>";

  echo "Cart Shipping: ".magento_shoppingCartShippingMethod($carrinho)."<br>";

  echo "Dados de pagamento: ".magento_shoppingCartPaymentMethod($carrinho, $payment)."<br>";
  var_dump($payment);

// var_dump(magento_shoppingCartInfo($carrinho));
  echo "Cart Order: ".var_dump(magento_shoppingCartOrder($carrinho))."<br>";
  ?>
