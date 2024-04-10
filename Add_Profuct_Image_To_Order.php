<?php
//add image order details
add_filter( 'woocommerce_order_item_name', 'display_product_image_in_order_item_msr', 20, 3 );
function display_product_image_in_order_item_msr( $item_name, $item, $is_visible ) {
    // Targeting view order pages only
    if( is_wc_endpoint_url( 'view-order' ) ) {
        $product   = $item->get_product(); // Get the WC_Product object (from order item)
        $thumbnail = $product->get_image(array( 100, 100)); // Get the product thumbnail (from product object)
        if( $product->get_image_id() > 0 )
         $item_name = '<div class="item-thumbnail" style="float:left;display:block;width:150px; margin-right:10px;" >' . $thumbnail . '</div>' . $item_name;
    }
    return $item_name;
}