<?php
// request config for constant variables
$config = include(__DIR__ . '/../config.php');

// Handle the OAuth2 callback
function requestTokens($code)
{
  // _log("Getting TOKENS");
  global $config;

  // if ($code && isset($_GET['state']) && $_GET['state'] === 'subscribestar') {
  $token_request_data = [
    'code' => $code,
    // 'client_id' => SUBSCRIBESTAR_CLIENT_ID,
    // 'client_secret' => SUBSCRIBESTAR_CLIENT_SECRET,
    // 'redirect_uri' => SUBSCRIBESTAR_REDIRECT_URI,
    'client_id' => $config['SUBSCRIBESTAR_CLIENT_ID'],
    'client_secret' => $config['SUBSCRIBESTAR_SECRET'],
    'redirect_uri' =>  $config['SUBSCRIBESTAR_REDIRECT_URI'],
    'grant_type' => 'authorization_code',
  ];

  $token_request = wp_remote_post('https://www.subscribestar.com/oauth2/token', [
    'body' => $token_request_data,
  ]);

  if (!is_wp_error($token_request) && wp_remote_retrieve_response_code($token_request) === 200) {
    $token_response = json_decode(wp_remote_retrieve_body($token_request), true);

    // Redirect the user to the desired page after successful login
    // wp_redirect(home_url());
    // exit;

    return $token_response;
  } else {
    echo '<script>console.log(' . json_encode("Failed to request token") . ')</script>';
    return null;
  }
}

?>