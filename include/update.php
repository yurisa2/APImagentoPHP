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
	$mod = array(
		'name' => "sa2 consultoria",
		'description' => "Aqui é a descrição do produto",
		'short_description' => "Aqui é a descrição curta do produto",
		'weight' => "10",
		'status' => "1",
		'price' => "10"
	);

	$return = magento_obj()->catalogProductUpdate(magento_session(),$sku,$mod);

	return $return;
}

?>
