<?php
// Register variables inputs
function substar_manager_register_settings_options()
{
    // ENV vars
    add_option('substar_manager_client_id', '');
    add_option('substar_manager_secret', '');
    add_option('substar_manager_redirect_uri', '');
    // add_option('substar_manager_request_scope', '');
    register_setting('substar_manager_settings', 'substar_manager_client_id');
    register_setting('substar_manager_settings', 'substar_manager_secret');
    register_setting('substar_manager_settings', 'substar_manager_redirect_uri');
    // register_setting('substar_manager_settings', 'substar_manager_request_scope');
}
add_action('admin_init', 'substar_manager_register_settings_options');

// EXAMPLE - get_option('substar_manager_client_id')

// Form for admin to set variables
function substar_manager_settings_page()
{
    ?>
    <div class="wrap">
        <h1>Substar Manager Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields('substar_manager_settings'); ?>
            <?php do_settings_sections('substar_manager_settings'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">SubscribeStar Client ID</th>
                    <td><input type="text" name="substar_manager_client_id"
                            value="<?php echo esc_attr(get_option('substar_manager_client_id')); ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">SubscribeStar Secret</th>
                    <td><input type="text" name="substar_manager_secret"
                            value="<?php echo esc_attr(get_option('substar_manager_secret')); ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">SubscribeStar Redirect URI</th>
                    <td><input type="text" name="substar_manager_redirect_uri"
                            value="<?php echo esc_attr(get_option('substar_manager_redirect_uri')); ?>" />
                    </td>
                </tr>

            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Add the plugin settings page to the WordPress dashboard menu
function substar_manager_add_settings_page()
{
    add_options_page('Substar Manager Settings', 'Substar Manager', 'manage_options', 'substar-manager-settings', 'substar_manager_settings_page');
}
add_action('admin_menu', 'substar_manager_add_settings_page');

?>