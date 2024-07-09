<?
function custom_delete_account_button_msr() {
    if (is_user_logged_in()) {
        $current_user = wp_get_current_user();
        $button_text = 'Request account deletion';

        if (isset($_POST['delete_account'])) {
            // Send an email to the admin
            $admin_email = get_option('admin_email');
            $admin_subject = 'User Account Deletion Request';
            
            // Get the first and last name of the user
            $user_first_name = $current_user->first_name;
            $user_last_name = $current_user->last_name;

            $admin_message = 'A user has requested to delete their account. User ID: ' . $current_user->ID . ', User Email: ' . $current_user->user_email . ', First Name: ' . $user_first_name . ', Last Name: ' . $user_last_name;
            wp_mail($admin_email, $admin_subject, $admin_message);

            // Send an email to the user
            $user_subject = 'Account Deletion Request Received';
            $user_message = 'Your account deletion request has been received. We will process it shortly.';
            wp_mail($current_user->user_email, $user_subject, $user_message);

            $button_text = 'Request Sent';
        }

        // Output the HTML button and inline JavaScript
        echo '<form method="post">';
        echo '<button type="submit"  name="delete_account" onclick="this.innerText = \'Request successful\';">' . $button_text . '</button>';
        echo '</form>';
    }
}

add_action('woocommerce_after_edit_account_form', 'custom_delete_account_button_msr');