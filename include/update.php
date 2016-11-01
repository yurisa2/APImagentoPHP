<?php
function magento_catalogInventoryStockItemUpdate($sku,$qty)
{
	$mod = array(
		'qty' => $qty
	);

	$return = magento_obj()->catalogInventoryStockItemUpdate(magento_session(),$sku,$mod);

	return $return;
}

?>
