<?php
// Handle the OAuth2 callback
function requestTokens($code)
{
  _log("Getting TOKENS");

  // if ($code && isset($_GET['state']) && $_GET['state'] === 'subscribestar') {
  $token_request_data = [
    'code' => $code,
    'client_id' => get_option('substar_manager_client_id'),
    'client_secret' => get_option('substar_manager_secret'),
    'redirect_uri' =>  get_option('substar_manager_redirect_uri'),
    'grant_type' => 'authorization_code',
  ];

  $token_request = wp_remote_post('https://www.subscribestar.com/oauth2/token', [
    'body' => $token_request_data,
  ]);

  if (!is_wp_error($token_request) && wp_remote_retrieve_response_code($token_request) === 200) {
    $token_response = json_decode(wp_remote_retrieve_body($token_request), true);

    return $token_response;
  } else {
    $response_code = wp_remote_retrieve_response_code($token_request);
    $response_message = wp_remote_retrieve_response_message($token_request);
    
    echo '<script>console.log(' . json_encode("Failed to request token: $response_message ($response_code)") . ')</script>';
    
    return null;
  }
}

?>