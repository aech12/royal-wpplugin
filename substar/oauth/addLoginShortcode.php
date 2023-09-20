<?php
// Add a shortcode [subscribestar_oauth2_login] to display the SubscribeStar OAuth2 login link
function add_subscribestar_oauth2_login_link()
{
  // Display nothing if user is logged in
  if (is_user_logged_in()) {
    return '';
  }

  $auth_url = 'https://www.subscribestar.adult/oauth2/authorize?client_id=' . urlencode(get_option('substar_manager_client_id')) . '&redirect_uri=' . urlencode(get_option('substar_manager_redirect_uri')) . '&response_type=code' . '&scope=' . SUBSCRIBESTAR_REQUEST_SCOPE;
  return '<a href="' . $auth_url . '" class="royalty-login-button">Login with SubscribeStar</a>';
}
add_shortcode('subscribestar_oauth2_login', 'add_subscribestar_oauth2_login_link');
?>
