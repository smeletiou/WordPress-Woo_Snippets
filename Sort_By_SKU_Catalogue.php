<?php
//add deault sorting by sku in catalogue page
function add_sku_sorting_msr( $args ) {

	$orderby_value = isset( $_GET['orderby'] ) ? wc_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );

	if ( 'sku' == $orderby_value ) {
		$args['orderby'] = 'meta_value';
		$args['order'] = 'asc'; // lists SKUs alphabetically 0-9, a-z; change to desc for reverse alphabetical
		$args['meta_key'] = '_sku';
	}

	return $args;
}
add_filter( 'woocommerce_get_catalog_ordering_args', 'add_sku_sorting_msr' );

//adds it as an option to dropdown
function sku_sorting_orderby_msr( $sortby ) {

	// Change text above as desired; this shows in the sorting dropdown
	$sortby['sku'] = __( 'Sort by SKU', 'textdomain' );

	return $sortby;
}
add_filter( 'woocommerce_catalog_orderby', 'sku_sorting_orderby_msr' );
add_filter( 'woocommerce_default_catalog_orderby_options', 'sku_sorting_orderby_msr' );

