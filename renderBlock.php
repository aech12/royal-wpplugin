<?php
// require_once 'general/log.php';
// require_once 'substar/user.php';

function check_auth($attributes)
{
    // Check if user is admin
    // If Admin, give full access
    $current_user = wp_get_current_user();
    $user_roles = $current_user->roles;
    if (isset($user_roles) && !empty($user_roles) && $user_roles[0] === 'administrator')
        return 0;

    // Check if the user is logged in
    if (!is_user_logged_in())
        return 1;

    // Check user's access token
    $access_token = get_user_meta(get_current_user_id(), 'access_token', true);
    if (!$access_token)
        return 2;

    // Compare user's tier with content's required tier
    $user_tier = requestUserTier($access_token);
    $tier_of_the_content = intval($attributes['tier']);

    if ($user_tier >= $tier_of_the_content)
        return 0;

    // If all failed, display no access message
    return 3;
}

// Render the block if the user has the correct tier
function render_substar_block($attributes, $content)
{
    $render_content = check_auth($attributes);

    switch ($render_content) {
        case 0:
            return sprintf('<div class="substar-tiers-root">%s</div>', $content);
            // return '<div><p>BEG</p>' . $content . '<p>END</p></div>';
        case 1:
            return "<p>You're not logged in, or your session expired. Please login.</p>";
        case 2:
            return "<p>No access token, your session must be expired. Please login again.</p>";
        case 3:
            // return "<p>No access to this content.</p>";
            return "<p></p>";
        default:
            return "<p>Could not render properly. No case matched.<p>";
    }
}
substar-manager

?>