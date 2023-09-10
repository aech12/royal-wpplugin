<?php
/**
 * Plugin Name:       Subscribestar Manager
 * Description:       Example block scaffolded with Create Block tool.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            Alex Howez
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       subscribestar-manager
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

 // Plugin config options, vars, etc
require_once 'config.php';
require_once 'config/pluginVariables.php';
require_once 'config/roles.php';
require_once 'config/log.php';
 
// PHP block that is rendered on the server
require_once 'substar/user.php';
require_once(plugin_dir_path(__FILE__) . 'renderBlock.php');

function create_block_subscribestar_manager_block_init()
{
  // register_block_type(__DIR__ . '/build');
  register_block_type(__DIR__ . '/build', array(
    'render_callback' => 'render_substar_block'
  ));
}
add_action('init', 'create_block_subscribestar_manager_block_init');

// This eliminates a lot of "call to undefined function" errors
if (!function_exists('wp_get_current_user')) {
  include(ABSPATH . "wp-includes/pluggable.php");
}

// Include auth system with subscriberstar API
require_once(plugin_dir_path(__FILE__) . 'substar/login.php');