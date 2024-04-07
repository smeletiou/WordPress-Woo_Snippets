<?php

//Remove cart totals block
add_action( 'woocommerce_checkout_order_review', 'remove_checkout_totals_msr', 1 );
function remove_checkout_totals_msr(){
    remove_action( 'woocommerce_checkout_order_review', 'woocommerce_order_review', 10 );}

add_action( 'woocommerce_cart_collaterals', 'remove_cart_totals_msr', 9 );
function remove_cart_totals_msr(){
    // Remove cart totals block
    remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );
    // Add back "Proceed to checkout" button (and hooks)
    echo '<div class="cart_totals">';
    do_action( 'woocommerce_before_cart_totals' );
    echo '<div class="wc-proceed-to-checkout">';
    do_action( 'woocommerce_proceed_to_checkout' );
    echo '</div>';
    do_action( 'woocommerce_after_cart_totals' );
    echo '</div><br clear="all">';
}
