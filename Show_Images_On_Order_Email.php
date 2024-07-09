<?
add_filter( 'woocommerce_email_order_items_args', 'order_with_product_images_msr', 10 );
function order_with_product_images_msr( $args ) {
   $args['show_image'] = true;
   $args['image_size'] = array( 100, 100 );
   return $args;
}
