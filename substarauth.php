<?php
// AUTHENTICATE WITH SUBSCRIBERSTAR API

// METHODS
// Store your ENV variables in .env file and use dotenv to run this script or pass them directly as shown above.
// define('CLIENT_IDX', getenv('SUBSCRIBESTAR_CLIENT_ID'));
// define('SECRET', getenv('SUBSCRIBESTAR_SECRET'));
// define('REDIRECT_URI', getenv('SUBSCRIBESTAR_REDIRECT_URI'));
define('CLIENT_ID', 'rQrGZN1CFd_26K8L-8lzDHf9_emPQ7h2bnBHq32ABLg');
define('SECRET', 'RoPWLOf7EfItn9BXc2b0ZryL3-RoYqCji-sqjNrBotU');
define('REDIRECT_URI', 'http://localhost/royal');
define('REQUEST_SCOPE', "subscriber.read+subscriber.payments.read+user.read+user.email.read");
// define('REQUEST_SCOPE', getenv('SUBSCRIBESTAR_REQUEST_SCOPE') ? getenv('REQUEST_SCOPE') : "subscriber.read+subscriber.payments.read+user.read+user.email.read");
define('API_ENDPOINT', getenv('SUBSCRIBESTAR_API_ENDPOINT') ? getenv('API_ENDPOINT') : "https://www.subscribestar.com/api/graphql/v1");

// Import helper functions
require_once 'getTokenReq.php';
require_once 'sendPostRequest.php';
require_once 'modifyTokens.php';
require_once 'getUserReq.php';

// Add a shortcode to display the SubscribeStar OAuth2 login link
function add_subscribestar_oauth2_login_link()
{
  $auth_url = 'https://www.subscribestar.adult/oauth2/authorize?client_id=' . urlencode(CLIENT_ID) . '&redirect_uri=' . urlencode(REDIRECT_URI) . '&scope=' . urlencode(REQUEST_SCOPE) . '&response_type=code';
  return '<a href="' . $auth_url . '">Login with SubscribeStar</a>';
}

// EXECUTION
// Add a shortcode to display the SubscribeStar OAuth2 login link
function subscribestar_oauth2_login_shortcode()
{
  return add_subscribestar_oauth2_login_link();
}
add_shortcode('subscribestar_oauth2_login', 'subscribestar_oauth2_login_shortcode');

// /auth route ONLY
// Get access and refresh tokens and save them for future requests
if (isset($_GET['code'])) {
  $authorization_code = $_GET['code'];
  echo '<script>console.log("Requesting tokens with: ", ' . json_encode($authorization_code) . ')</script>';
  $tokens = requestToken($authorization_code);
  echo '<script>console.log("Tokens requested: ", ' . json_encode($tokens) . ')</script>';

  if ($tokens) {
    save_tokens_to_cookies($tokens);
  }
}
// /auth route ONLY - END

// Use token to get subscriber information
$accessToken = get_access_token_cookie();
echo '<script>console.log("accessToken is: ", ' . json_encode($accessToken) . ')</script>';

if ($accessToken) {
  $data = requestUser($accessToken);
  echo '<script>console.log("User data: ", ' . json_encode($data) . ')</script>';
} else {
  echo 'No access token. Please login again.';
}

$view_variable = $_ENV['SUBSCRIBESTAR_CLIENT_ID'];
echo '<script>console.log("SUBSCRIBESTAR_CLIENT_ID ", ' . json_encode($view_variable) . ')</script>';
?>