<?php
/**
 * Plugin Name:       RoyalGames SubscribeStar User Tiers Manager
 * Description:       Allow subscriberstar users login and manage their tier.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           1.0
 * Author:            Alex Howez
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       gutenpride
 *
 * @package           create-block
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_block_gutenpride_block_init() {
	register_block_type( __DIR__ . '/build' );
}
add_action( 'init', 'create_block_gutenpride_block_init' );

// This eliminates a lot of "call to undefined function" errors
if(!function_exists('wp_get_current_user')) {
  include(ABSPATH . "wp-includes/pluggable.php"); 
}

// Plugin config options, vars, etc
require_once 'config.php';
require_once 'general/setPluginVariables.php';
require_once 'general/roles.php';

// Include context menu that allows to protect Blocks with a tier
require_once( plugin_dir_path( __FILE__ ) . 'createTierMenu.php' );

// Include auth system with subscriberstar API
require_once( plugin_dir_path( __FILE__ ) . 'substarauth.php' );

?>