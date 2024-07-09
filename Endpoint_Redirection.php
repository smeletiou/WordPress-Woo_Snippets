<?
//endpoint redirection
add_filter( 'woocommerce_get_endpoint_url', 'hook_endpoint_msr', 10, 4 );
function hook_endpoint_msr( $url, $endpoint, $value, $permalink ){
	if( 'youre-endpoint-name-here' === $endpoint ) {#change it
		$url = 'https://'; // your url here
	}
	return $url;
}