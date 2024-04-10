<?php
//make processing orders editable
add_filter( 'wc_order_is_editable', 'wc_make_processing_orders_editable_msr', 10, 2 );
 function wc_make_processing_orders_editable_msr( $is_editable, $order ) {
    if ( $order->get_status() == 'processing' ) {
        $is_editable = true;
    }
    return $is_editable;
}

////////
///edit orders by customer
// 1. Allow Order Again for Processing Status
add_filter( 'woocommerce_valid_order_statuses_for_order_again', 'order_again_statuses_msr' );

function order_again_statuses_msr( $statuses ) {
    $statuses[] = 'processing';
    return $statuses;
}

// ----------------
// 2. Add Order Actions @ My Account
add_filter( 'woocommerce_my_account_my_orders_actions', 'add_edit_order_my_account_orders_actions_msr', 50, 2 );

function add_edit_order_my_account_orders_actions_msr( $actions, $order ) {
    if ( $order->has_status( 'processing' ) ) {
        $actions['edit-order'] = array(
            'url'  => wp_nonce_url( add_query_arg( array( 'order_again' => $order->get_id(), 'edit_order' => $order->get_id() ) ), 'woocommerce-order_again' ),
            'name' => __( 'Edit Order', 'woocommerce' )
        );
    }
    return $actions;
}

// ----------------
// 3. Detect Edit Order Action and Store in Session
add_action( 'woocommerce_cart_loaded_from_session', 'detect_edit_order_msr' );

function detect_edit_order_msr( $cart ) {
    if ( isset( $_GET['edit_order'], $_GET['_wpnonce'] ) && is_user_logged_in() && wp_verify_nonce( wp_unslash( $_GET['_wpnonce'] ), 'woocommerce-order_again' ) ) WC()->session->set( 'edit_order', absint( $_GET['edit_order'] ) );
}

// 6. Save Order Action if New Order is Placed
add_action( 'woocommerce_checkout_update_order_meta', 'save_edit_order_msr' );

function save_edit_order_msr( $order_id ) {
    $edited = WC()->session->get( 'edit_order' );
    if ( ! empty( $edited ) ) {
        // update this new order
        update_post_meta( $order_id, '_edit_order', $edited );
        $neworder = new WC_Order( $order_id );
        $oldorder_edit = get_edit_post_link( $edited );
        $neworder->add_order_note( 'Order placed after editing. Old order number: <a href="' . $oldorder_edit . '">' . $edited . '</a>' );
        // cancel previous order
        $oldorder = new WC_Order( $edited );
        $neworder_edit = get_edit_post_link( $order_id );
        $oldorder->update_status( 'cancelled', 'Order cancelled after editing. New order number: <a href="' . $neworder_edit . '">' . $order_id . '</a> -' );
        WC()->session->set( 'edit_order', null );
    }
}