<?php
function magento_catalogInventoryStockItemUpdate($sku,$qty)
{
	global $magento_soap_user;
	global $magento_soap_password;

	$obj_magento = magento_obj();
	$session = magento_session();

	$is_in_stock = 1;
	if($qty <= 0) $is_in_stock = 0;

	$mod = array(
		'qty' => $qty,
		'is_in_stock' => $is_in_stock
	);

	$return = $obj_magento->catalogInventoryStockItemUpdate($session,$sku,$mod);

	return $return;
}

function magento_catalogProductUpdate($sku,$mod)
{
	global $magento_soap_user;
	global $magento_soap_password;

	$obj_magento = magento_obj();
	$session = magento_session();

	/* $mod Array template
	$mod = array(
	'name' => $data_product['name'],
	'description' => $data_product['description'],
	'short_description' => $data_product['short_description'],
	'weight' => $data_product['weight'],
	'price' => $data_product['price']
);
*/

$return = $obj_magento->catalogProductUpdate($session,$sku,$mod);

return $return;
}

function magento_catalogProductUpdate_and_stock($sku,$mod)
{
	global $magento_soap_user;
	global $magento_soap_password;

	$obj_magento = magento_obj();
	$session = magento_session();

	/* $mod Array template
	$mod = array(
	'name' => $data_product['name'],
	'description' => $data_product['description'],
	'short_description' => $data_product['short_description'],
	'weight' => $data_product['weight'],
	'price' => $data_product['price'],
	'qty_in_stock' => $data_product['qty_in_stock']
);
*/

if($mod) {
	$mod_update = [];
	$mod_update_return = [];

	if(!empty($mod['name'])) {
		$mod_update['name'] = $mod['name'];
		$mod_update_return['name'] = $mod['name'];
	}

	if(!empty($mod['description'])) {
		$mod_update['description'] = $mod['description'];
		$mod_update_return['description'] = $mod['description'];
	}

	if(!empty($mod['short_description'])) {
		$mod_update['short_description'] = $mod['short_description'];
		$mod_update_return['short_description'] = $mod['short_description'];
	}

	if(!empty($mod['weight'])) {
		$mod_update['weight'] = $mod['weight'];
		$mod_update_return['weight'] = $mod['weight'];
	}

	if(!empty($mod['price'])) {
		$mod_update['price'] = $mod['price'];
		$mod_update_return['price'] = $mod['price'];
	}

	$update_product = $obj_magento->catalogProductUpdate($session,$sku,$mod_update);

	$mod_update['tier_price'] = $mod['tier_price'];
	$mod_update_return['tier_price'] = $mod['tier_price'];

	$update_tier_price = $obj_magento->catalogProductAttributeTierPriceUpdate($session,$sku, $mod_update['tier_price']);

	if(!empty($mod['qty_in_stock'])) {
		$qty = $mod['qty_in_stock'];
		$is_in_stock = 1;
		if($qty <= 0) $is_in_stock = 0;

		$mod_qty = array(
			'qty' => $qty,
			'is_in_stock' => $is_in_stock
		);
		$mod_update_return['qty_in_stock'] = $mod['qty_in_stock'];
		$obj_magento->catalogInventoryStockItemUpdate($session,$sku,$mod_qty);
	}
}


if(isset($update_product)) {
	$return = $mod_update_return;
} else {
	$return = false;
}

return $return;
}

//changing order status
function magento_salesOrderAddComment($mod)
{
	global $magento_soap_user;
	global $magento_soap_password;

	$obj_magento = magento_obj();
	$session = magento_session();

	$orderIncrementId = $mod['orderIncrementId'];
	$status = $mod['status'];
	$comment = $mod['comment'];
	$notify = null;


	$return = $obj_magento->salesOrderAddComment($session, $orderIncrementId, $status, $comment, $notify);

	return $return;
}

function magento_shoppingCartProductAdd($cart_id,$prods,$store_id)
{
	//$prods Array template
	// array(
	// 	array($sku,$qty),
	// 	array($sku,$qty)
	// )

	global $magento_soap_user;
	global $magento_soap_password;

	$return = 0;

	$obj_magento = magento_obj();
	$session = magento_session();

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
	$result_prod_add = $obj_magento->shoppingCartProductAdd($session,$cart_id,$shoppingCartProductEntity,$store_id);
	if($result_prod_add) $return++;
	// var_dump($return);

	return $return;
}

function magento_shoppingCartCustomerSet($ord_id,$cust,$store_id)
{
	global $magento_soap_user;
	global $magento_soap_password;

	$obj_magento = magento_obj();
	$session = magento_session();

	$return = $obj_magento->shoppingCartCustomerSet($session, $ord_id, $cust,$store_id);

	return $return;
}

function magento_shoppingCartCustomerAddresses($ord_id,$billing,$store_id)
{
	global $magento_soap_user;
	global $magento_soap_password;

	$obj_magento = magento_obj();
	$session = magento_session();

	$return = $obj_magento->shoppingCartCustomerAddresses($session, $ord_id, $billing,$store_id);

	return $return;
}

function magento_shoppingCartShippingMethod($ord_id, $store_id )
{
	global $magento_soap_user;
	global $magento_soap_password;

	$obj_magento = magento_obj();
	$session = magento_session();

	$return =  $obj_magento->shoppingCartShippingMethod($session, $ord_id, "freeshipping_freeshipping", $store_id);

	return $return;
}

function magento_shoppingCartPaymentMethod($ord_id, $payment, $store_id){
	global $magento_soap_user;
	global $magento_soap_password;

	$obj_magento = magento_obj();
	$session = magento_session();

	$return =  $obj_magento->shoppingCartPaymentMethod($session, $ord_id, $payment,$store_id);

	return $return;
}

function magento_shoppingCartOrder($ord_id, $store_id)
{
	global $magento_soap_user;
	global $magento_soap_password;

	$obj_magento = magento_obj();
	$session = magento_session();

	$return =  $obj_magento->shoppingCartOrder($session, $ord_id,$store_id);

	return $return;
}

function magento_shoppingCartPaymentList($carrinho, $store_id)
{
	global $magento_soap_user;
	global $magento_soap_password;

	$obj_magento = magento_obj();
	$session = magento_session();

	$return =  $obj_magento->shoppingCartPaymentList($session, $carrinho, $store_id);

	return $return;
}

function magento_shoppingCartShippingList($carrinho, $store_id)
{
	global $magento_soap_user;
	global $magento_soap_password;

	$obj_magento = magento_obj();
	$session = magento_session();

	$return =  $obj_magento->shoppingCartShippingList($session, $carrinho, $store_id);

	return $return;
}

function magento_shoppingCartInfo($carrinho)
{
	global $magento_soap_user;
	global $magento_soap_password;

	$obj_magento = magento_obj();
	$session = magento_session();

	$return =  $obj_magento->shoppingCartInfo($session, $carrinho);

	return $return;
}

// function magento_salesOrderAddComment($order_id, $status, $comment)
// {
// 	global $magento_soap_user;
// 	global $magento_soap_password;
//
// 	$obj_magento = magento_obj();
// 	$session = magento_session();
//
// 	$return =  $obj_magento->salesOrderAddComment($session, $order_id, $status, $comment);
//
// 	return $return;
// }
?>
