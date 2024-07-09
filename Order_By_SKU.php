<?
//order by sku
add_filter( 'woocommerce_order_get_items', 'filter_order_get_items_by_sku_msr', 10, 3 );

function filter_order_get_items_by_sku_msr( $items, $order, $types ) {
    if ( count( $items ) > 1 ) {
        // Create a custom sorting function
        usort( $items, 'custom_sort_items_by_sku_msr' );
    }

    return $items;
}

function custom_sort_items_by_sku_msr( $a, $b ) {
    if ( $a->get_type() === 'line_item' && $b->get_type() === 'line_item' ) {
        $sku_a = $a->get_product()->get_sku();
        $sku_b = $b->get_product()->get_sku();

        // Compare SKUs while ignoring case
        return strcasecmp( $sku_a, $sku_b );
    }

    return 0;
}