<?php
function return_sku_msr( $product ){
    $sku = $product->get_sku();
    if ( ! empty( $sku ) ) {
       return '<p>SKU: ' . $sku . '</p>';
    } else {return '';}
}
//This adds SKU under order item table name EMAIL
add_action( 'woocommerce_order_item_meta_start', 'thankyou_order_email_pages_msr', 9999, 4 );
function thankyou_order_email_pages_msr( $item_id, $item, $order, $plain_text ) {
   $product = $item->get_product();
   echo return_sku_msr( $product );
}