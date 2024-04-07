<?php
//remove end points from my accpunt page
add_filter( 'woocommerce_account_menu_items', 'remove_my_account_dashboard_msr' );
function remove_my_account_dashboard_msr( $menu_links ){
	unset( $menu_links[ 'dashboard' ] );
	unset( $menu_links[ 'downloads' ] );
    //add here endpoints you want to remove
	return $menu_links;
}