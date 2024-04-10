<?php
///change add to cart text to add to quote
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text_msr' );
function woocommerce_custom_single_add_to_cart_text_msr() {
    return __( 'add to Quote', 'woocommerce' ); }

add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_custom_product_add_to_cart_text_msr' ); 
function woocommerce_custom_product_add_to_cart_text_msr() {
    return __( 'add to Quote', 'woocommerce' );}
