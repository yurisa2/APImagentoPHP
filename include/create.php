<?php
function magento_shoppingCartCreate($store_id)
{
	global $magento_soap_user;
	global $magento_soap_password;

	$obj_magento = magento_obj();
	$session = magento_session();

	$cart_id = $obj_magento->shoppingCartCreate($session,$store_id);

	return $cart_id;
}




?>
