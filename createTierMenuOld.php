<?php
// THIS FILE WORKS WITH THE OLD SYSTEM
// NEW SYSTEM USES NATIVE WORDPRESS USERS FEATURE

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

// Get the user's tier
// function get_user_tier() {
//     // Get the user's tier from the user meta
//     $user_id = get_current_user_id();
//     $user_tier = (int) get_user_meta($user_id, 'tier', true); // Convert the user's tier to an integer
//     return $user_tier;
// }
require_once 'substar/tokens.php';
require_once 'substar/user.php';

// Render the block if the user has the correct tier
function render_my_container_block($attributes, $content)
{
    $user_access_token = get_access_token_cookie();
    if (!$user_access_token) {
        return '<p>You\'re not logged in, or your session expired. Please login.</p>';
    }

    $user_tier = requestUserTier($user_access_token); 
    $user_tier = 3;
    if (!$user_tier) {
        return '<p>You\'re not subscribed on SubscriberStar.</p>';
    }

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