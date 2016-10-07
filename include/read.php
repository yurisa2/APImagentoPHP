<?php
function magento_catalogProductList()
{
  $result = magento_obj()->catalogProductList(magento_session());

return $result;

}

function magento_catalogProductInfo($sku)
{
  $result = magento_obj()->catalogProductInfo(magento_session(),$sku);

return $result;

}

function magento_catalogProductInfo_name($sku)
{
  $result = magento_obj()->catalogProductInfo(magento_session(),$sku)->name;

return $result;

}

function magento_catalogProductInfo_price($sku)
{
  $result = magento_obj()->catalogProductInfo(magento_session(),$sku)->price;

return $result;

}

function magento_catalogProductInfo_description($sku)
{
  $result = magento_obj()->catalogProductInfo(magento_session(),$sku)->description;

return $result;

}

function magento_catalogProductInfo_short_description($sku)
{
  $result = magento_obj()->catalogProductInfo(magento_session(),$sku)->short_description;

return $result;

}

function magento_catalogInventoryStockItemList($sku)
{
  $sku_list = array($sku);
  $result = magento_obj()->catalogInventoryStockItemList(magento_session(),$sku_list)['0']->qty;

  return $result;

}

function magento_SalesOrders() {
  $return = magento_obj()->salesOrderList(magento_session());

  return $return;
}

//Lifting the last sales order and removing special characters of the last sales order
function magento_lastSalesOrder()
{

  //Lifting the last sales order
  $sales_order = magento_obj()->salesOrderList(magento_session());
  $last_sales_order = end($sales_order);

  //Removing special characters of the last sales order
  $document = $last_sales_order->customer_taxvat;
  $document_number = preg_replace('/\D/', '', $document);

  //Counting the numbers of the document
  $document_length = strlen($document_number);

  //If document length was equality 14 is cnpj
  if ($document_length == 14) {
    $cnpj = $document_number;
  }

  //If document length was equality 11 is cpf
  if ($document_length == 11) {
    $cpf = $document_length;
  }

  //Variables for array of informations about the sales order - not conclused
  $name = $last_sales_order->shipping_name;
  $date_sale_order = $last_sales_order->created_at;
  $free_shipping_sale = $last_sales_order->subtotal;
  $total_price = $last_sales_order->grand_total;
  if($cnpj!='') {
    $document_user = $cnpj;
  }
  if($cpf!='') {
    $document_user = $cpf;
  }

  $return = array('name'=>$name,
        'document_user'=>$document_user,
        'date_sale_order'=>$date_sale_order,
        'free_shipping_sale'=>$free_shipping_sale,
        'total_price'=>$total_price
    );
  


  return $document_number;

}


function magento_product_summary($sku)
{
  global $magento_soap_user;
  global $magento_soap_password;

$obj_mag = magento_obj();
$ses_mag = $obj_mag->login($magento_soap_user,$magento_soap_password);

$name = $obj_mag->catalogProductInfo($ses_mag,$sku)->name;
$description = $obj_mag->catalogProductInfo($ses_mag,$sku)->description;
$short_description = $obj_mag->catalogProductInfo($ses_mag,$sku)->short_description;
$weight = $obj_mag->catalogProductInfo($ses_mag,$sku)->weight;
$price = $obj_mag->catalogProductInfo($ses_mag,$sku)->price;
$qty = $obj_mag->catalogInventoryStockItemList($ses_mag,array($sku))['0']->qty;

$obj_mag->endSession($ses_mag);

$return = array('name'=>$name,
      'description'=> $description,
      'short_description'=> $short_description,
      'weight'=> $weight,
      'price'=> $price,
      'qty_in_stock'=> $qty
    );


return $return;
}


?>
