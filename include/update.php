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
	$data_product_mercosistem = write_product_mercosistem_magento($sku);

	$mod = array(
		'name' => $data_product_mercosistem['name'],
		'description' => $data_product_mercosistem['description'],
		'short_description' => $data_product_mercosistem['short_description'],
		'weight' => $data_product_mercosistem['weight'],
		'price' => $data_product_mercosistem['price'],
		'qty_in_stock' => $data_product_mercosistem['qty_in_stock']
	);

	$return = magento_obj()->catalogProductUpdate(magento_session(),$sku,$mod);

	return $return;
}

?>
