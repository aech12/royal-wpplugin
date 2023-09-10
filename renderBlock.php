<?php
// require_once 'general/log.php';
require_once 'substar/user.php';

function check_auth($attributes, $content)
{
    // Check if user is admin
    // If Admin, return highest tier
    $current_user = wp_get_current_user();
    $user_roles = $current_user->roles;
    if ($user_roles[0] === 'administrator')
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
    _log($user_tier);
    $tier_of_the_content = intval($attributes['tier']);
    if ($user_tier >= $tier_of_the_content)
        return 0;

    // If all failed, display no access message
    return 3;
}

// Render the block if the user has the correct tier
function render_substar_block($attributes, $content)
{
    $render_content = 0;
    // $render_content = check_auth($attributes, $content);
    
    return sprintf('<div class="my-container-block">%s</div>', $content);
    return '<div><p>BEG</p>' . $content . '<p>END</p></div>';
    return '<div><p>hardcoded</p>' . $attributes['tier'] . '<p>END</p></div>';

    switch ($render_content) {
        case 0:
            // return '<div></div>';
            return sprintf('<div class="my-container-block">%s</div>', $content);
        // return sprintf('<div>%s</div>', do_blocks($content));
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