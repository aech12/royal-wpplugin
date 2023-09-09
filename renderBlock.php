<?php
// require_once 'general/log.php';
require_once 'substar/user.php';

// Render the block if the user has the correct tier
function check_auth($attributes, $content)
{
    // Check if the user is logged in
    if (!is_user_logged_in())
        return 1;

    // Check user's access token
    $access_token = get_user_meta(get_current_user_id(), 'access_token', true);
    if (!$access_token)
        return 2;

    // Compare user's tier with content's required tier
    $user_tier = requestUserTier($access_token);
    _log($user_tier);
    $tier_of_the_content = intval($attributes['tier']);
    if ($user_tier >= $tier_of_the_content) return 0;

    // If all failed, display no access message
    return 3;
}

function render_substar_block($attributes, $content)
{
    $render_content = check_auth($attributes, $content);

    switch ($render_content) {
        case 0:
            return sprintf('<div class="my-container-block">%s</div>', $content);
        case 1:
            return "<p>You\'re not logged in, or your session expired. Please login (on Royalty tab).</p>";
        case 2:
            return "<p>No access token, your session must be expired. Please login again (on Royalty tab).</p>";
        case 3:
            return "<p>No access to this content.</p>";
        default:
            return "Could not render properly. No case matched.";
    }
}



?>