<?
// perform a redirect
add_action( 'template_redirect', 'redirect_to_orders_from_dashboard_msr' );
function redirect_to_orders_from_dashboard_msr(){
	if( is_account_page() && empty( WC()->query->get_current_endpoint() ) ){
		wp_safe_redirect( wc_get_account_endpoint_url( 'edit-account' ) );//change the endpoint here
		exit;
	}
}