<?php
//show prices to specific roles
function hide_prices_user_role_msr( $price ) {
	$current_user = wp_get_current_user();
	$allowed_roles = array( 'shop_manager', 'administrator' );//Add here your roles that you want the prices to be shown
	if ( ! array_intersect( $current_user->roles, $allowed_roles ) ) {
	    return '';}
	return $price;
}
add_filter( 'woocommerce_get_price_html', 'hide_prices_user_role_msr' ); 
// Hide product price
// Cart
add_filter( 'woocommerce_cart_item_price', 'hide_prices_user_role_msr' ); 
// Hide cart item price
add_filter( 'woocommerce_cart_item_subtotal', 'hide_prices_user_role_msr' ); 
// Hide cart total price