<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
// require_once '..substar/user.php';

// return '<p>VER 2 You do </p>';
// require_once '../substar/user.php';

// function check_auth_for_render($attributes, $content)
// {
//     // Check if user is admin
//     // If Admin, return highest tier
//     $current_user = wp_get_current_user();
//     $user_roles = $current_user->roles;
//     if ($user_roles[0] === 'administrator')
//         return 0;

//     // Check if the user is logged in
//     if (!is_user_logged_in())
//         return 1;

//     // Check user's access token
//     $access_token = get_user_meta(get_current_user_id(), 'access_token', true);
//     if (!$access_token)
//         return 2;

//     // Compare user's tier with content's required tier
//     $user_tier = requestUserTier($access_token);
//     _log($user_tier);
//     $tier_of_the_content = intval($attributes['tier']);
//     if ($user_tier >= $tier_of_the_content)
//         return 0;

//     // If all failed, display no access message
//     return 3;
// }

$final_render = $attributes['tier'];
// $final_render2 = sprintf('<div>%s</div>', $content);
?>

<h2>
	<?= $final_render ?>
</h2>
<p <?php echo get_block_wrapper_attributes(); ?>>
	<?php esc_html_e('Subscribestar Manager 4 – hello from a dynamic block!', 'subscribestar-manager'); ?>
</p>