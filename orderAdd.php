<?php

class Magento_order
{
/**
* Construtor. Set properties in Magento_order
* @param object data;
*/
public function Magento_order($dadosVenda)
{
  $this->data = new stdClass();

  $this->data->mlb_produto = $dadosVenda->mlb_produto;
  $this->data->sku_produto = $dadosVenda->sku_produto;
  $this->data->nome_produto = $dadosVenda->nome_produto;
  $this->data->qtd_produto = $dadosVenda->qtd_produto;
  $this->data->preco_unidade_produto =$dadosVenda->preco_unidade_produto;
  $this->data->preco_total_produto = $dadosVenda->preco_total_produto;

  //--------------PAGAMENTO---------
  $this->data->id_meio_pagamento = $dadosVenda->id_meio_pagamento;
  $this->data->tipo_pagamento = $dadosVenda->tipo_pagamento;
  $this->data->custo_envio = $dadosVenda->custo_envio;
  $this->data->total_pagar = $dadosVenda->total_pagar;
  $this->data->status_pagamento = $dadosVenda->status_pagamento;

  //-----------ENDEREÇO---------
  $this->data->rua = $dadosVenda->rua;
  $this->data->numero = $dadosVenda->numero;
  $this->data->bairro = $dadosVenda->bairro;
  $this->data->cep = $dadosVenda->cep;
  $this->data->cidade = $dadosVenda->cidade;
  $this->data->estado = $dadosVenda->estado;
  $this->data->pais = $dadosVenda->pais;

  // ---------USUARIO---------
  $this->data->id_comprador = $dadosVenda->id_comprador;
  $this->data->apelido_comprador = $dadosVenda->apelido_comprador;
  $this->data->email_comprador = $dadosVenda->email_comprador;
  $this->data->cod_area_comprador = $dadosVenda->cod_area_comprador;
  $this->data->telefone_comprador = $dadosVenda->telefone_comprador;
  $this->data->nome_comprador = $dadosVenda->nome_comprador;
  $this->data->sobrenome_comprador = $dadosVenda->sobrenome_comprador;
  $this->data->tipo_documento_comprador = $dadosVenda->tipo_documento_comprador;
  $this->data->numero_documento_comprador = $dadosVenda->numero_documento_comprador;


// function magento_customerCustomerCreate()
// {
  global $magento_soap_user;
  global $magento_soap_password;
  global $store_id;
  global $DEBUG;
  global $shipping_method;

  $obj_magento = magento_obj();
  $session = magento_session();

  $customer = array(
    'firstname' => $this->data->nome_comprador,
    'lastname' => $this->data->sobrenome_comprador,
    'email' => $this->data->email_comprador,
    'telephone' => $this->data->cod_area_comprador.$this->data->telefone_comprador,
    'taxvat' => $this->data->numero_documento_comprador,
    'group_id' => "1",
    'store_id' => "21",
    'website_id' => "2"
  );

  $complexFilter = array(
    'complex_filter' => array(
        array(
            'key' => 'email',
            'value' => array('key' => 'in', 'value' => $customer['email'])
        )
    )
  );

  $return = $obj_magento->customerCustomerList($session, $complexFilter);

  if(!$return){
    $id_customer = $obj_magento->customerCustomerCreate($session, $customer);
    if($DEBUG == TRUE) var_dump($id_customer);
  }
  else
  {
    $id_customer = $return[0]->customer_id;
    if($DEBUG == TRUE) var_dump($id_customer);
    if($DEBUG == TRUE) var_dump($return);
  }

// function magento_customerAddressCreate($id_customer)
// {


  $customer_address = array(
  'firstname' => $this->data->nome_comprador,
  'lastname' => $this->data->sobrenome_comprador,
  'street' => array($this->data->rua.", ".$this->data->numero." - ".$this->data->bairro,'' ),
  'city' => $this->data->cidade,
  'country_id' => $this->data->pais,
  'region' => $this->data->estado,
  'postcode' => $this->data->cep,
  'telephone' => $this->data->cod_area_comprador.$this->data->telefone_comprador,
  'is_default_billing' => FALSE,
  'is_default_shipping' => FALSE);

  $return = $obj_magento->customerAddressCreate($session, $id_customer, $customer_address);

  if($DEBUG == TRUE) echo $return;


  $obj_mag = $obj_magento->customerAddressList($session, $id_customer);

  if($DEBUG == TRUE) echo "<h1>Debug</h1>";var_dump($obj_mag);

  $obj_mag_email = $obj_magento->customerCustomerInfo($session, $id_customer);
  $obj_mag = $obj_mag['0'];

  if($DEBUG == TRUE) var_dump($obj_mag);

  $name = $obj_mag->firstname." ".$obj_mag->lastname;
  $email = $obj_mag_email->email;
  $document = preg_replace('/\D/', '',$obj_mag_email->taxvat);
  $city = $obj_mag->city;
  $region = $obj_mag->region;
  $postcode = preg_replace('/\D/', '',$obj_mag->postcode);
  $street = $obj_mag->street;
  $phone = preg_replace('/\D/', '',$obj_mag->telephone);


  $return = array(
    'name' => $name,
    'email' => $email,
    'document' => $document,
    'city' => $city,
    'region' => $region,
    'postcode' => $postcode,
    'street' => $street,
    'phone' => $phone,
  );

  if($DEBUG == true) var_dump($return);
// }

// function magento_shoppingCartCreate($store_id)
// {
//   global $magento_soap_user;
// 	global $magento_soap_password;
//
// 	$obj_magento = magento_obj();
// 	$session = magento_session();

	$cart_id = $obj_magento->shoppingCartCreate($session, $store_id);

	if($DEBUG == TRUE) var_dump($cart_id);
// }

// function magento_shoppingCartProductAdd($cart_id, $store_id)
// {
  //$prods Array template
	// array(
	// 	array($sku,$qty),
	// 	array($sku,$qty)
	// )

	// global $magento_soap_user;
	// global $magento_soap_password;

	$return = 0;

	// $obj_magento = magento_obj();
	// $session = magento_session();

  $prods = array(
    array($this->data->sku_produto, $this->data->qtd_produto)
    );

	foreach ($prods as $key => $value) {
		$sku_ = $value[0]; //very very very wrong...but...
		$qty_ = $value[1];	//If I were to use another array, safer


	$shoppingCartProductEntity[] =
		array(
			'sku' => $sku_,
			'qty' => $qty_
		);
		// var_dump($shoppingCartProductEntity); //DEBUG

  }

  $result_prod_add = $obj_magento->shoppingCartProductAdd($session, $cart_id, $shoppingCartProductEntity, $store_id);
	if($result_prod_add) $return++;
	// var_dump($return);

	if($DEBUG == TRUE) var_dump($return);
// }

// function magento_shoppingCartProductList($cart_id, $store_id)
// {
//   global $magento_soap_user;
//   global $magento_soap_password;
//
//   $obj_magento = magento_obj();
//   $session = magento_session();

  $result = $obj_magento->shoppingCartProductList($session, $cart_id, $store_id);

  	if($DEBUG == TRUE) var_dump($result);
// }

// function magento_shoppingCartCustomerSet($cart_id, $id_customer, $store_id)
// {
//   global $magento_soap_user;
//   global $magento_soap_password;
//
//   $obj_magento = magento_obj();
//   $session = magento_session();

  $customer = array(
    'customer_id' => $id_customer,
    'mode' => "customer"
    );

  	$return = $obj_magento->shoppingCartCustomerSet($session, $cart_id, $customer, $store_id);

  	if($DEBUG == TRUE) echo $return;
// }

// function magento_shoppingCartCustomerAddresses($cart_id, $store_id)
// {
// 	global $magento_soap_user;
// 	global $magento_soap_password;
//
// 	$obj_magento = magento_obj();
// 	$session = magento_session();

  $billing =
  array(
    array(
      'mode' => 'billing',
      'firstname' => $this->data->nome_comprador,
      'lastname' => $this->data->sobrenome_comprador,
      'street' => $this->data->rua.", ".$this->data->numero." - ".$this->data->bairro,
      'city' => $this->data->cidade,
      'region' => $this->data->estado,
      'postcode' => $this->data->cep,
      'country_id' => $this->data->pais,
      'telephone' => $this->data->cod_area_comprador.$this->data->telefone_comprador,
      'is_default_billing' => 0,
      'is_default_shipping' => 0),
    array(
      'mode' => 'shipping',
      'firstname' => $this->data->nome_comprador,
      'lastname' => $this->data->sobrenome_comprador,
      'street' => $this->data->rua.", ".$this->data->numero."-".$this->data->bairro,
      'city' => $this->data->cidade,
      'region' => $this->data->estado,
      'postcode' => $this->data->cep,
      'country_id' => $this->data->pais,
      'telephone' => $this->data->cod_area_comprador.$this->data->telefone_comprador,
      'is_default_billing' => 0,
      'is_default_shipping' => 0)
    );

	$return = $obj_magento->shoppingCartCustomerAddresses($session, $cart_id, $billing, $store_id);

if($DEBUG == TRUE) var_dump($return);
// }

// function magento_shoppingCartShippingMethod($cart_id, $store_id)
// {
// 	global $magento_soap_user;
// 	global $magento_soap_password;
//   global $shipping_method;
//
// 	$obj_magento = magento_obj();
// 	$session = magento_session();

	$return =  $obj_magento->shoppingCartShippingMethod($session, $cart_id, $shipping_method, $store_id);

	if($DEBUG == TRUE) var_dump($return);
// }
//
// function magento_shoppingCartPaymentMethod($cart_id, $store_id){
// 	global $magento_soap_user;
// 	global $magento_soap_password;
//
// 	$obj_magento = magento_obj();
// 	$session = magento_session();

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

	$return =  $obj_magento->shoppingCartPaymentMethod($session, $cart_id, $payment, $store_id);

	if($DEBUG == TRUE) var_dump($return);
// }
//
// function magento_shoppingCartOrder($cart_id, $store_id)
// {
// 	global $magento_soap_user;
// 	global $magento_soap_password;
//
// 	$obj_magento = magento_obj();
// 	$session = magento_session();

	$order_id =  $obj_magento->shoppingCartOrder($session, $cart_id, $store_id);

if($DEBUG == TRUE) var_dump($order_id);
// }
//
// function magento_salesOrderAddComment($order_id, $status, $comment)
// {
// 	global $magento_soap_user;
// 	global $magento_soap_password;
//
// 	$obj_magento = magento_obj();
// 	$session = magento_session();

  $comment = 'Id do Pedido MLB: '.$this->data->mlb_produto;

	$return = $obj_magento->salesOrderAddComment($session, $order_id, 'pending', $comment, null);

if($DEBUG == TRUE) var_dump($return);
}
}
