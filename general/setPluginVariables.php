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

    // Tiers (pricing)
    add_option('substar_manager_tier_1', 200);
    register_setting('substar_manager_settings', 'substar_manager_tier_1');
    add_option('substar_manager_tier_2', 500);
    register_setting('substar_manager_settings', 'substar_manager_tier_2');
    add_option('substar_manager_tier_3', 1000);
    register_setting('substar_manager_settings', 'substar_manager_tier_3');
    add_option('substar_manager_tier_4', 2000);
    register_setting('substar_manager_settings', 'substar_manager_tier_4');
    add_option('substar_manager_tier_5', 2500);
    register_setting('substar_manager_settings', 'substar_manager_tier_5');
    add_option('substar_manager_tier_6', 4000);
    register_setting('substar_manager_settings', 'substar_manager_tier_6');
    add_option('substar_manager_tier_7', 5000);
    register_setting('substar_manager_settings', 'substar_manager_tier_7');
    add_option('substar_manager_tier_8', 10000);
    register_setting('substar_manager_settings', 'substar_manager_tier_8');
    
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
                <!-- <tr valign="top">
                    <th scope="row">SubscribeStar Request Scope</th>
                    <td><input type="text" name="substar_manager_request_scope"
                            value="<?php echo esc_attr(get_option('substar_manager_request_scope')); ?>" />
                    </td>
                </tr> -->
                <tr valign="top">
                    <th scope="row">Tier 1 Baron</th>
                    <td><input type="text" name="substar_manager_tier_1"
                            value="<?php echo esc_attr(get_option('substar_manager_tier_1')); ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Tier 2</th>
                    <td><input type="text" name="substar_manager_tier_2"
                            value="<?php echo esc_attr(get_option('substar_manager_tier_2')); ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Tier 3</th>
                    <td><input type="text" name="substar_manager_tier_3"
                            value="<?php echo esc_attr(get_option('substar_manager_tier_3')); ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Tier 4</th>
                    <td><input type="text" name="substar_manager_tier_4"
                            value="<?php echo esc_attr(get_option('substar_manager_tier_4')); ?>" />
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">Tier 5 Royalty</th>
                    <td><input type="text" name="substar_manager_tier_5"
                            value="<?php echo esc_attr(get_option('substar_manager_tier_5')); ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Tier 6</th>
                    <td><input type="text" name="substar_manager_tier_6"
                            value="<?php echo esc_attr(get_option('substar_manager_tier_6')); ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Tier 7</th>
                    <td><input type="text" name="substar_manager_tier_7"
                            value="<?php echo esc_attr(get_option('substar_manager_tier_7')); ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Tier 8</th>
                    <td><input type="text" name="substar_manager_tier_8"
                            value="<?php echo esc_attr(get_option('substar_manager_tier_8')); ?>" />
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