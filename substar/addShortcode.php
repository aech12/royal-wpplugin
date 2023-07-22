<?php
// Add a shortcode [subscribestar_oauth2_login] to display the SubscribeStar OAuth2 login link
function add_subscribestar_oauth2_login_link()
{
  $auth_url = 'https://www.subscribestar.adult/oauth2/authorize?client_id=' . urlencode(SUBSCRIBESTAR_CLIENT_ID) . '&redirect_uri=' . urlencode(SUBSCRIBESTAR_REDIRECT_URI) . '&response_type=code' . '&scope=' . SUBSCRIBESTAR_REQUEST_SCOPE;
  return '<a href="' . $auth_url . '">Login with SubscribeStar</a>';
}
add_shortcode('subscribestar_oauth2_login', 'add_subscribestar_oauth2_login_link');
?>