<?
//hide products with no image
add_action( 'woocommerce_product_query', 'custom_pre_get_posts_query_msr' );
function custom_pre_get_posts_query_msr( $query ) {

    $query->set( 'meta_query', array( array(
       'key' => '_thumbnail_id',
       'value' => '0',
       'compare' => '>'
    )));

}