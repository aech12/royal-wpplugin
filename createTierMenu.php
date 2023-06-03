<?php

// Add a custom user meta field for the user's tier
function tiered_content_user_meta($user) {
?>
    <h3>Tiered Content</h3>
    <table class="form-table">
        <tr>
            <th><label for="tier">User Tier</label></th>
            <td>
                <input type="number" name="tier" id="tier" min="1" max="4" value="<?php echo esc_attr(get_the_author_meta('tier', $user->ID)); ?>" class="regular-text" />
                <span class="description">Please enter the user's tier (1-4).</span>
            </td>
        </tr>
    </table>
<?php
}
add_action('show_user_profile', 'tiered_content_user_meta');
add_action('edit_user_profile', 'tiered_content_user_meta');

// Save the user's tier when the profile is updated
function tiered_content_save_user_meta($user_id) {
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }
    update_user_meta($user_id, 'tier', $_POST['tier']);
}
add_action('personal_options_update', 'tiered_content_save_user_meta');
add_action('edit_user_profile_update', 'tiered_content_save_user_meta');

// Shortcode to display content based on the user's tier	
function tiered_content_shortcode($atts, $content = null) {
	$atts = shortcode_atts(array('tier' => '1'), $atts, 'tiered_content');
	$user_tier = (int) get_user_meta(get_current_user_id(), 'tier', true); // Convert the user's tier to an integer

	if ($user_tier >= $atts['tier']) {
			return do_shortcode($content);
	} else {
			return '<p>You do not have access to this content.</p>';
	}
}

add_shortcode('tiered_content', 'tiered_content_shortcode');

?>