<?
add_filter( 'woocommerce_order_item_name', 'add_email_order_item_permalink_msr', 10, 2 ); // Product name
function add_email_order_item_permalink_msr( $output_html, $item, $bool = false ) {
    // Only email notifications
    if( is_wc_endpoint_url() )
        return $output_html;
    $product   = $item->get_product();
    return '<a href="'.esc_url( $product->get_permalink() ).'">' . $output_html . '</a>';
}