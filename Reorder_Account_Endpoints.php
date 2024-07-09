<?
//reorder my account page menu
add_filter( 'woocommerce_account_menu_items', 'menu_links_reorder_msr' );
function menu_links_reorder_msr( $menu_links ){
	return array(
		'edit-account' => __( 'Account details', 'woocommerce' ),
		'orders' => __( 'Orders', 'woocommerce' ),
		'prev-prod'=> __( 'My previous products', 'woocommerce' ),
		'edit-address' => __( 'Addresses', 'woocommerce' ),
		'customer-logout' => __( 'Logout', 'woocommerce' )
        #add  other endpoints here
	);
}