<?
function new_order_type_msr( $checkout ) {
    echo '<div class="order-div">';
    echo '<label>' . __("Request Prices or Place Order;") . '<span style="color:red;">*</span></label><br>';
    echo '<input type="radio" name="order_type" value="1" required ' . checked( $checkout->get_value('order_type'), '1') . '> Request Prices<br>';
    echo '<input type="radio" name="order_type" value="2" required ' . checked( $checkout->get_value('order_type'), '2') . '> Order<br>';
    echo '</div>';
}
add_action( 'woocommerce_before_checkout_billing_form', 'new_order_type_msr' );

function custom_field_validate_msr() {
   if (!$_POST['order_type']) { 
	wc_add_notice(__('Please choose Request Prices or Place Order') , 'error'); 
   }
}
add_action('woocommerce_after_checkout_validation', 'custom_field_validate_msr');

function save_order_type_msr( $order_id ) {
    if ( !empty( $_POST['order_type'] ) ) {
        update_post_meta( $order_id, 'Order type', $_POST['order_type']);
    }
}
add_action( 'woocommerce_checkout_update_order_meta', 'save_order_type_msr' );

function display_order_type_msr($order){
   echo'<p>'.__('Order type').': ';
   $type = get_post_meta( $order->ID, 'Order type', true );
   if ($type==1) { echo "Request Prices";} else {echo "Order";}
   echo '</p>';
}
add_action( 'woocommerce_admin_order_data_after_billing_address', 'display_order_type_msr', 10, 1 );

function add_order_type_to_email_msr( $fields, $sent_to_admin, $order ) {
  $order_type = get_post_meta( $order->get_id(), 'Order type', true );
  if ($order_type == 1) {
    $fields['order_type'] = array(
      'label' => __( 'Order type' ),
      'value' => __( 'Request Prices' )
    );
  } else {
    $fields['order_type'] = array(
      'label' => __( 'Order type' ),
      'value' => __( 'Order' )
    );
  }
  return $fields;
}
add_filter( 'woocommerce_email_order_meta_fields', 'add_order_type_to_email_msr', 10, 3 );

