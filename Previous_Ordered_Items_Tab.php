<?php
//recent orders display products
add_shortcode( 'my_purchased_products', 'products_bought_by_curr_user_msr' );
function products_bought_by_curr_user_msr() {
    // GET CURR USER
    $current_user = wp_get_current_user();
    if ( 0 == $current_user->ID ) return;
    // GET USER ORDERS (COMPLETED + PROCESSING)
    $customer_orders = get_posts( array(
        'numberposts' => -1,
        'meta_key'    => '_customer_user',
        'meta_value'  => $current_user->ID,
        'post_type'   => wc_get_order_types(),
        'post_status' => array_keys( wc_get_is_paid_statuses() ),));
    // LOOP THROUGH ORDERS AND GET PRODUCT IDS
    if ( ! $customer_orders ) return;
    $product_ids = array();
    foreach ( $customer_orders as $customer_order ){
        $order = wc_get_order( $customer_order->ID );
        $items = $order->get_items();
        foreach ( $items as $item ) {
            $product_id = $item->get_product_id();
            $product_ids[] = $product_id;}}
    $product_ids = array_unique( $product_ids );
    $product_ids_str = implode( ",", $product_ids );
    // PASS PRODUCT IDS TO PRODUCTS SHORTCODE
    return do_shortcode("[products ids='$product_ids_str']");}