<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set("soap.wsdl_cache_enabled","1");
ini_set('xdebug.var_display_max_depth', 5);
ini_set('xdebug.var_display_max_children', 350);
ini_set('xdebug.var_display_max_data', 1024);

require_once 'include/all_include.php';
require_once 'orderAdd.php';
echo '<pre>';


$dadosVenda = new stdClass;

//------------PRODUTO--------

  $dadosVenda->mlb_produto = "1038933651";
  $dadosVenda->sku_produto = "EP-51-40983";
  $dadosVenda->nome_produto = "MOSQUETÃO COM OLHAL E TRAVA ROSQUEÁVEL AÇO INOX6MM";
  $dadosVenda->qtd_produto = "2";
  $dadosVenda->preco_unidade_produto = "10,50";
  $dadosVenda->preco_total_produto = "21,00";


//--------------PAGAMENTO---------
$dadosVenda->id_meio_pagamento = "Sei la";
$dadosVenda->tipo_pagamento = "teste";
$dadosVenda->custo_envio = "teste";
$dadosVenda->total_pagar = "teste";
$dadosVenda->status_pagamento = "teste";


//----- ------ENDEREÇO---------
$dadosVenda->rua = "Teste";
$dadosVenda->numero ="1";
$dadosVenda->bairro = "Testando";
$dadosVenda->cep = "Teste";
$dadosVenda->cidade = "Testado";
$dadosVenda->estado = "SP";
$dadosVenda->pais = "BR";
//PEGAR O ID DO PAIS -- COUNTRY_ID
// -------USUARIO --------
$dadosVenda->id_comprador = "123213";
$dadosVenda->apelido_comprador = "Zé do Teste";
$dadosVenda->email_comprador = "testemagentoorder5@mail.com";
$dadosVenda->cod_area_comprador = "11";
$dadosVenda->telefone_comprador = "123456789";
$dadosVenda->nome_comprador = "Teste do order";
$dadosVenda->sobrenome_comprador = "Testado";
$dadosVenda->tipo_documento_comprador = "CPF";
$dadosVenda->numero_documento_comprador = "123456789";


$DEBUG =TRUE;

$teste = new Magento_order($dadosVenda);


var_dump($teste);

// magento_info();

// echo magento_session();

// var_dump(magento_catalogProductList());

//var_dump(magento_catalogProductInfo('EP-51-35051'));

// var_dump(magento_catalogProductInfo_description('EP-51-35051'));

// var_dump(magento_catalogInventoryStockItemList('EP-51-35051'));

//var_dump(magento_product_summary('EP-51-35051'));

// var_dump(magento_catalogInventoryStockItemUpdate('EP-51-35051','665'));

// var_dump(magento_shoppingCartCreate());


// $prods = array(
//   array('EP-51-40983','1'),
//   array('EP-51-40654','4')
// );
//
// $billing =
// array(
//   array(
//     'mode' => 'billing',
//     'firstname' => 'Teste Magento',
//     'lastname' => 'Teste Magento',
//     'street' => 'street address',
//     'city' => 'Ficticio de Teste',
//     'region' => 'SP',
//     'postcode' => 'postcode',
//     'country_id' => 'BR',
//     'telephone' => '34343434343434',
//     'is_default_billing' => 0,
//     'is_default_shipping' => 0),
//   array(
//     'mode' => 'shipping',
//     'firstname' => 'Teste Magento',
//     'lastname' => 'Teste Magento',
//     'street' => 'street address',
//     'city' => 'Ficticio de Teste',
//     'region' => 'SP',
//     'postcode' => 'postcode',
//     'country_id' => 'BR',
//     'telephone' => '34343434343434',
//     'is_default_billing' => 0,
//     'is_default_shipping' => 0)
//   );
//
// // $customerCreate = array(
// //   'email' => 'cust-tst-mail@example.org',
// //   'firstname' => 'Dough',
// //   'lastname' => 'Deeks',
// //   'password' => 'password',
// //   'website_id' => 1,
// //   'store_id' => 1,
// //   'group_id' => 1);
// //
// // var_dump(magento_customerCustomerCreate($customerCreate));
//
// // $cust = array(
// //   //concatenar o email no nome
// //     'email' => 'customer-mail@example.org',
// //     'firstname' => "testFirstname",
// //     'lastname' => "testLastName",
// //     'mode' => "guest",
// //     'group_id' => "1"
// //     );
//
// $customer = array(
//   'firstname' => rand(1,100)."testFirstname",
//   'lastname' => "testLastName1",
//   'email' => rand(1,100)."testmailcustomer1@mail.com",
//   'telephone' => rand(1,100)."0001234567",
//   'taxvat' => rand(100000, 150000),
//   'group_id' => "1",
//   'store_id' => "21",
//   'website_id' => "2"
// );
//
// $id_customer = magento_customerCustomerCreate($customer);
//
// $session = magento_session();
// $obj_magento = magento_obj();
// $obj_magento->customerAddressCreate($session, 34, array(
// 'firstname' => rand(1,100).'teste1',
// 'lastname' => 'testando',
// 'street' => array('Street line 1', 'Streer line 2'),
// 'city' => 'teste',
// 'country_id' => 'BR',
// 'region' => 'SP',
// 'postcode' => rand(1,100).'96093',
// 'telephone' => rand(1,100).'-623-2513',
// 'is_default_billing' => FALSE,
// 'is_default_shipping' => FALSE));
//
// //var_dump($obj_magento);
//
//
// $dados_customer = magento_customerCustomerList($id_customer);
// var_dump($dados_customer);
//
//
// $cust = array(
//     'customer_id' => $id_customer,
//     'mode' => "customer"
//    );
//
// $payment = array(
//     'po_number' => null,
//     'method' => 'cashondelivery',
//     'cc_cid' => null,
//     'cc_owner' => null,
//     'cc_number' => null,
//     'cc_type' => null,
//     'cc_exp_year' => null,
//     'cc_exp_month' => null
//     );
//
//   // var_dump($prods);
//
//
//
//   $store_id = '21';
//
//   $carrinho = magento_shoppingCartCreate($store_id);
//
// $id = magento_session();
//
// // $obj_cust = magento_customerCustomerList($id);
// // $obj_cust = (array) $obj_cust;
//
// // var_dump($obj_cust);
// //
// // var_dump(magento_obj()->customerGroupList($id));
// //
//
//   echo "Retorno cartProdAdd: <br>";
//   var_dump(magento_shoppingCartProductAdd($carrinho,$prods,$store_id));
//   echo "<br>";
//
//   echo "Lista shoppingCartProductList: <br>";
//   $lista_carrinho = magento_shoppingCartProductList($carrinho, $store_id);
//   var_dump($lista_carrinho);
//
//   echo "# de itens shoppingCartProductList: ".count($lista_carrinho)." <br>";
//   var_dump($cust);
//   echo "Customer Set: ".magento_shoppingCartCustomerSet($carrinho,$cust ,$store_id)." <br>";
//
//   var_dump($billing);
//   echo "Billing Set: ".magento_shoppingCartCustomerAddresses($carrinho, $billing,$store_id)." <br>";
//
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
//
//   //var_dump(magento_StoreList());
// $mod_email= array(
//   'orderIncrementId' => $order_id,
//   'status' => 'pending',
//   'comment' => 'Email'
//   );
//
//   $mod_id_pedido= array(
//     'orderIncrementId' => $order_id,
//     'status' => 'pending',
//     'comment' => 'Id Pedido: '
//     );
//
//
// var_dump(magento_salesOrderAddComment($mod_email));
// var_dump(magento_salesOrderAddComment($mod_id_pedido));

?>
