<?php
add_filter('woocommerce_my_account_my_orders_columns', 'remove_my_account_order_total_msr', 10);

function remove_my_account_order_total_msr($order){
  unset($order['order-total']);
  return $order;
}