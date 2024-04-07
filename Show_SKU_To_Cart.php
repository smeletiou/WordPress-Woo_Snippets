<?php
//show sku 
function return_sku_msr( $product ){
    $sku = $product->get_sku();
    if ( ! empty( $sku ) ) {
       return '<p>SKU: ' . $sku . '</p>';
    } else {return '';}}
 // This adds the SKU under cart/checkout item name
 add_filter( 'woocommerce_cart_item_name', 'bbloomer_sku_cart_checkout_pages_msr', 9999, 3 );
 function bbloomer_sku_cart_checkout_pages_msr( $item_name, $cart_item, $cart_item_key  ) {
    $product = $cart_item['data'];
    $item_name .= return_sku_msr( $product );
    return $item_name;}