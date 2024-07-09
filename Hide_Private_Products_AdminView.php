<?
//HIDE PRIVATE PRODUCTS
add_filter( 'posts_where', 'no_private_products_posts_frontend_administrator_msr' );
function no_private_products_posts_frontend_administrator_msr( $where ) {
    if ( is_admin() ) return $where;
    global $wpdb;
    return " $where AND {$wpdb->posts}.post_status != 'private' ";
}
