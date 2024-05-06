<?php
// require_once 'general/log.php';
require_once 'substar/user.php';
require_once 'substar/oauth/user_session.php';

function check_auth($attributes)
{
    // Check if user is admin
    // If Admin, give full access
    $current_user = wp_get_current_user();
    $user_roles = $current_user->roles;
    if (isset($user_roles) && !empty($user_roles) && $user_roles[0] === 'administrator')
        return 0;

    // Check if the user is logged in
    // if (!is_user_logged_in())
    //     return 1;

    // Check user's access token
    $access_token = get_user_access_token(); // get_user_meta(get_current_user_id(), 'access_token', true);
    if (!$access_token)
        return 1;

    // Compare user's tier with content's required tier
    $user_tier = requestUserTier($access_token);
    $tier_of_the_content = intval($attributes['tier']);
    if ($user_tier >= $tier_of_the_content) {
        return 0;
    } elseif ($user_tier < $tier_of_the_content) {
        return 2;
    }

    // If all failed, display no access message
    return 3;
}

// Render the block if the user has the correct tier
function render_substar_block($attributes, $content)
{
    $render_content = check_auth($attributes);

    // case 0 is the only one that displays content
    switch ($render_content) {
        case 0:
            // case: grant access
            return sprintf('<div class="substar-tiers-root">%s</div>', $content);
        case 1:
            // case: user not logged in
            return "<div></div>";
        case 2:
            // case: user tier is not enough
            return "<p>Requires higher Subscriberstar tier.</p>";
        case 3:
            // case: "default" case (no access)
            return "<p>No access to this content.</p>";
        default:
            return "Could not render properly. No case matched.";
    }
}

?>