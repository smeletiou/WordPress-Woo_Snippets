<?php
//show sku in shop
add_action( 'woocommerce_after_shop_loop_item_title', 'db_show_sku_msr', 10 );
function db_show_sku_msr(){
	global $product;
	echo '<span style="color:#000000; font-size: 18px;" class="custom_sku">SKU: ' . $product->get_sku() . '</span>';
}