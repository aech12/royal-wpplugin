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
define('REQUEST_SCOPE', getenv('SUBSCRIBESTAR_REQUEST_SCOPE') ? getenv('REQUEST_SCOPE') : "subscriber.read+subscriber.payments.read+user.read+user.email.read");
define('API_ENDPOINT', getenv('SUBSCRIBESTAR_API_ENDPOINT') ? getenv('API_ENDPOINT') : "https://www.subscribestar.com/api/graphql/v1");

// Import helper functions
require_once 'sendPostRequest.php';
require_once 'modifyTokens.php';

// Add a shortcode to display the SubscribeStar OAuth2 login link
function add_subscribestar_oauth2_login_link() {
  $auth_url = 'https://www.subscribestar.adult/oauth2/authorize?client_id=' . CLIENT_ID . '&redirect_uri=' . urlencode(REDIRECT_URI) . '&scope=subscriber.read+subscriber.payments.read+user.read+user.email.read&response_type=code';
  return '<a href="' . $auth_url . '">Login with SubscribeStar</a>';
}

// Get code parameter after user accepts permissions in redirect
function get_authorization_code_from_url() {
  if (isset($_GET['code'])) {
    $code = $_GET['code'];
    return $code;
  } else {
    return -1;
  }
}

// Requests token used for actual API calls. You exchange Code string with the Token.
function requestToken($code)
{
    // echo ("Obtaining request token using the code: {$code}\n\n");
    echo '<script>console.log(' . json_encode("Obtaining request token using the code: {$code}\n\n") . ')</script>';

    $client_id = CLIENT_ID;
    $client_secret = SECRET;
    $redirect_uri = REDIRECT_URI;

    $data = array(
      'grant_type' => 'authorization_code',
      'code' => $code,
      'redirect_uri' => $redirect_uri,
      'client_id' => $client_id,
      'client_secret' => $client_secret,
    );

    $options = array(
        'http' => array(
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
            'follow_location' => 1,
        ),
    );

    $context = stream_context_create($options);
    $result = file_get_contents('https://www.subscribestar.adult/oauth2/token', false, $context);

    $status_line = $http_response_header[0];
    echo '<script>console.log(' . json_encode("Status Line: {$status_line}") . ')</script>';

    // Parse the response to obtain the access token
    $response = json_decode($result, true);
    if (isset($response)) {
        echo '<script>console.log(' . "Response: " . ')</script>';
        echo '<script>console.log(' . json_encode($response) . ')</script>';
    } else {
        echo '<script>console.log("Response is null, get tokens failed")</script>';
    }
    return $response; // return $response['access_token'];
}

// EXECUTION
// Add a shortcode to display the SubscribeStar OAuth2 login link
function subscribestar_oauth2_login_shortcode() {
  return add_subscribestar_oauth2_login_link();
}
add_shortcode('subscribestar_oauth2_login', 'subscribestar_oauth2_login_shortcode');

// Get code after user accepts permissions in redirect
$authorization_code = get_authorization_code_from_url();
// Get token
if ($authorization_code != -1) {
  $tokens = requestToken($authorization_code);
  save_tokens_to_cookies($tokens);
}

// Use token to get subscriber information
$accessToken = get_access_token_cookie();
if ($accessToken) {
  $response = getSubscriberInfo($accessToken);
  $data = json_decode($response, true);
  echo '<script>console.log(' . json_encode($data) . ')</script>';
}

$view_variable = getenv('SUBSCRIBESTAR_CLIENT_ID');
echo '<script>console.log(' . json_encode($view_variable) . ')</script>';
?>