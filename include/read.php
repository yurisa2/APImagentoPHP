<?php
function magento_catalogProductList()
{
  global $magento_soap_user;
  global $magento_soap_password;

  $obj_magento = magento_obj();
  $session = magento_session();
  $result = $obj_magento->catalogProductList($session);

return $result;
}

function magento_catalogProductInfo($sku)
{
  global $magento_soap_user;
  global $magento_soap_password;

  $obj_magento = magento_obj();
  $session = magento_session();
  $result = $obj_magento->catalogProductInfo($session,$sku);

return $result;
}

function magento_catalogProductInfo_name($sku)
{
  global $magento_soap_user;
  global $magento_soap_password;

  $obj_magento = magento_obj();
  $session = magento_session();

  $result = $obj_magento->catalogProductInfo($session,$sku)->name;

return $result;
}

function magento_catalogProductInfo_price($sku)
{
  global $magento_soap_user;
  global $magento_soap_password;

  $obj_magento = magento_obj();
  $session = magento_session();

  $result = $obj_magento->catalogProductInfo($session,$sku)->price;

return $result;
}

function magento_catalogProductInfo_description($sku)
{
  global $magento_soap_user;
  global $magento_soap_password;

  $obj_magento = magento_obj();
  $session = magento_session();

  $result = $obj_magento->catalogProductInfo($session,$sku)->description;

return $result;
}

function magento_catalogProductInfo_short_description($sku)
{
  global $magento_soap_user;
  global $magento_soap_password;

  $obj_magento = magento_obj();
  $session = magento_session();

  $result = $obj_magento->catalogProductInfo($session,$sku)->short_description;

return $result;
}

function magento_catalogInventoryStockItemList($sku)
{
  global $magento_soap_user;
  global $magento_soap_password;

  $obj_magento = magento_obj();
  $session = magento_session();

  $sku_list = array($sku);
  $result = $obj_magento->catalogInventoryStockItemList($session,$sku_list)['0']->qty;

  return $result;
}

function magento_SalesOrders() {
  global $magento_soap_user;
  global $magento_soap_password;

  $obj_magento = magento_obj();
  $session = magento_session();

  $return = $obj_magento->salesOrderList($session);

  return $return;
}

//Lifting the last sales order and removing special characters of the last sales order
function magento_lastSalesOrder()
{
  global $magento_soap_user;
  global $magento_soap_password;

  $obj_magento = magento_obj();
  $session = magento_session();

  //Lifting the last sales order
  $sales_order = $obj_magento->salesOrderList($session);
  $last_sales_order = end($sales_order);

  //Removing special characters of the last sales order
  $document = $last_sales_order->customer_taxvat;
  $document_number = preg_replace('/\D/', '', $document);

  //Counting the numbers of the document
  $document_length = strlen($document_number);

  //If document length was equality 14 is cnpj
  if ($document_length = 14) {
    $cnpj = $document_number;
  }

  //If document length was equality 11 is cpf
  if ($document_length = 11) {
    $cpf = $document_number;
  }

  //Variables for array of informations about the sales order - not conclused
  $name = $last_sales_order->shipping_name;
  $email = $last_sales_order->customer_email;
  $costumer_id = $last_sales_order->customer_id;
  $cep = preg_replace('/\D/', '', $last_sales_order->postcode);
  $date_sale_order = $last_sales_order->created_at;
  $free_shipping_sale = $last_sales_order->subtotal;
  $total_price = $last_sales_order->grand_total;

  if($cnpj) {
    $document_user = $cnpj;
  }
  if($cpf) {
    $document_user = $cpf;
  }

  $return = array('name'=>$name,
        'document_user'=>$document_user,
        'email'=>$email,
        'costumer_id' => $costumer_id,
        'date_sale_order'=>$date_sale_order,
        'free_shipping_sale'=>$free_shipping_sale,
        'total_price'=>$total_price,
        'cep'=>$cep
    );
  return $return;
}

function magento_lastSalesOrderIdClient() {
  return magento_lastSalesOrder()['costumer_id'];
}

function magento_customerCustomerList($id)
{
  global $magento_soap_user;
  global $magento_soap_password;

  $obj_magento = magento_obj();
  $session = magento_session();

  $obj_mag = $obj_magento->customerAddressList($session, $id);
  $obj_mag_email = $obj_magento->customerCustomerInfo($session, $id);
  $obj_mag = $obj_mag['0'];

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

  return $return;
}


function magento_product_summary($sku)
{
  global $magento_soap_user;
  global $magento_soap_password;

  $obj_magento = magento_obj();
  $session = magento_session();

$product_id = $obj_magento ->catalogProductInfo($session,$sku)->product_id;
$name = $obj_magento ->catalogProductInfo($session,$sku)->name;
$description = $obj_magento ->catalogProductInfo($session,$sku)->description;
$short_description = $obj_magento ->catalogProductInfo($session,$sku)->short_description;
$weight = $obj_magento ->catalogProductInfo($session,$sku)->weight;
$price = $obj_magento ->catalogProductInfo($session,$sku)->price;
$qty = $obj_magento ->catalogInventoryStockItemList($session,array($sku))['0']->qty;

$return = array(
      'product_id'=>$product_id,
      'name'=>$name,
      'description'=> $description,
      'short_description'=> $short_description,
      'weight'=> $weight,
      'price'=> $price,
      'qty_in_stock'=> $qty
    );


return $return;
}


?>
