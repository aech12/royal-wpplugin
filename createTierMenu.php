<?php
require_once 'general/log.php';

// Add a custom user meta field for the user's tier
function tiered_content_user_meta($user)
{
    ?>
    <h3>Tiered Content</h3>
    <table class="form-table">
        <tr>
            <th><label for="tier">User Tier</label></th>
            <td>
                <input type="number" name="tier" id="tier" min="1" max="7"
                    value="<?php echo esc_attr(get_the_author_meta('tier', $user->ID)); ?>"
                    class="regular-text" />
                <span class="description">Please enter the user's tier (1-7).</span>
            </td>
        </tr>
    </table>
    <?php
}
add_action('show_user_profile', 'tiered_content_user_meta');
add_action('edit_user_profile', 'tiered_content_user_meta');

require_once 'substar/tokens.php';
require_once 'substar/user.php';

// Render the block if the user has the correct tier
function render_my_container_block($attributes, $content)
{
    if (!is_user_logged_in()) {
        return '<p>You\'re not logged in, or your session expired. Please login (on Royalty tab).</p>';
    }

    // Get user's tier
    $user_id = get_current_user_id();
    $access_token = get_user_meta($user_id, 'access_token', true); // Retrieve the value of the 'access_token' meta field

    if (!$access_token) {
        return '<p>No access token, your session must be expired. Please login again (on Royalty tab).</p>';
    }

    $user_tier = requestUserTier($access_token);
    _log($user_tier);

    // Convert the tier attribute to an integer
    $tier_of_the_content = intval($attributes['tier']);

    // Check if the user has access to the block based on their tier
    if ($user_tier >= $tier_of_the_content) {
        return sprintf('<div class="my-container-block">%s</div>', $content);
    } else {
        return '<p>You do not have access to this content.</p>';
    }
}

add_action('init', function () {
    register_block_type('my-namespace/my-container-block', [
        'render_callback' => 'render_my_container_block',
    ]);
});

?>