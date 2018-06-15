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
    'lastname' => 'Teste Magento',
    'street' => 'street address',
    'city' => 'Ficticio de Teste',
    'region' => 'SP',
    'postcode' => 'postcode',
    'country_id' => 'BR',
    'telephone' => '34343434343434',
    'is_default_billing' => 0,
    'is_default_shipping' => 0),
  array(
    'mode' => 'shipping',
    'firstname' => 'Teste Magento',
    'lastname' => 'Teste Magento',
    'street' => 'street address',
    'city' => 'Ficticio de Teste',
    'region' => 'SP',
    'postcode' => 'postcode',
    'country_id' => 'BR',
    'telephone' => '34343434343434',
    'is_default_billing' => 0,
    'is_default_shipping' => 0)
  );

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
  //concatenar o email no nome
    'email' => 'customer-mail@example.org',
    'firstname' => "testFirstname",
    'lastname' => "testLastName",
    'mode' => "guest",
    'group_id' => "1"
    );

$payment = array(
    'po_number' => null,
    'method' => 'cashondelivery',
    'cc_cid' => null,
    'cc_owner' => null,
    'cc_number' => null,
    'cc_type' => null,
    'cc_exp_year' => null,
    'cc_exp_month' => null
    );
  // var_dump($prods);

  $store_id = '21';

  $carrinho = magento_shoppingCartCreate($store_id);

$id = magento_session();

// $obj_cust = magento_customerCustomerList($id);
// $obj_cust = (array) $obj_cust;
// var_dump($obj_cust);
var_dump(magento_obj()->customerGroupList($id));
//
//   echo "Retorno cartProdAdd: <br>";
//   var_dump(magento_shoppingCartProductAdd($carrinho,$prods,$store_id));
//   echo "<br>";
//
//   echo "Lista shoppingCartProductList: <br>";
//   $lista_carrinho = magento_shoppingCartProductList($carrinho, $store_id);
//   var_dump($lista_carrinho);
//   echo "# de itens shoppingCartProductList: ".count($lista_carrinho)." <br>";
//   var_dump($cust);
//   echo "Customer Set: ".magento_shoppingCartCustomerSet($carrinho,$cust,$store_id)." <br>";
//
//
//
//   var_dump($billing);
//   echo "Billing Set: ".magento_shoppingCartCustomerAddresses($carrinho, $billing,$store_id)." <br>";
//
//
//       // echo "<h1>INFORMAÇÕES DA LOJA-PAYMENT:</h1> <BR>";
//       // var_dump(magento_shoppingCartPaymentList($carrinho, $store_id));
//       // echo "<h1>INFORMAÇÕES DA LOJA-SHIPPING:</h1> <BR>";
//       // var_dump(magento_shoppingCartshippingList($carrinho, $store_id));
//
//
//   echo "Cart Shipping: ".magento_shoppingCartShippingMethod($carrinho,$store_id)."<br>";
//   //var_dump($payment);
//   echo "Dados de pagamento: ".magento_shoppingCartPaymentMethod($carrinho, $payment,$store_id)."<br>";
//
//
// // var_dump(magento_shoppingCartInfo($carrinho));
// $order_id = magento_shoppingCartOrder($carrinho,$store_id);
// echo "Cart Order: ".$order_id."<br>";
//
//   //var_dump(magento_StoreList());
// $mod_email= array(
//   'orderIncrementId' => $order_id,
//   'status' => 'pending',
//   'comment' => 'Email'.$cust['email']
//   );
//
//   $mod_id_pedido= array(
//     'orderIncrementId' => $order_id,
//     'status' => 'pending',
//     'comment' => 'MLB: '
//     );
//
//
// var_dump(magento_salesOrderAddComment($mod_email));
// var_dump(magento_salesOrderAddComment($mod_id_pedido));

?>
