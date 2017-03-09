<?php
function magento_catalogInventoryStockItemUpdate($sku,$qty)
{
	global $magento_soap_user;
  global $magento_soap_password;

  $obj_magento = magento_obj();
  $session = magento_session();

	$mod = array(
		'qty' => $qty
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
			$mod_qty = array(
				'qty' => $mod['qty_in_stock']
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

//desmontar o array para comparar os valores

?>
