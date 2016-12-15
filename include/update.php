<?php
function magento_catalogInventoryStockItemUpdate($sku,$qty)
{
	$mod = array(
		'qty' => $qty
	);

	$return = magento_obj()->catalogInventoryStockItemUpdate(magento_session(),$sku,$mod);

	return $return;
}

function magento_catalogProductUpdate($sku,$mod)
{

	/* $mod Array template
	$mod = array(
		'name' => $data_product['name'],
		'description' => $data_product['description'],
		'short_description' => $data_product['short_description'],
		'weight' => $data_product['weight'],
		'price' => $data_product['price']
	);
	*/

	$return = magento_obj()->catalogProductUpdate(magento_session(),$sku,$mod);

	return $return;
}

function magento_catalogProductUpdate_and_stock($sku,$mod)
{
	global $magento_soap_user;
  	global $magento_soap_password;

	$obj_magento = magento_obj();
	$session = $obj_magento->login($magento_soap_user,$magento_soap_password);

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

	/*if(!empty($mod)) {
		$mod_update = [];
		$mod_update['name'] = $mod['name'];
		$mod_update['description'] = $mod['description'];
		$mod_update['short_description'] = $mod['short_description'];
		$mod_update['weight'] = $mod['weight'];
		$mod_update['price'] = $mod['price'];

		$update_product = $obj_magento->catalogProductUpdate($session,$sku,$mod_update);
	}*/

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
