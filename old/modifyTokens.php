<?php
// Preserve Subscribersar API tokens in cookies
function save_tokens_to_cookies($tokens) {
  $access_token = $tokens['access_token'];
  $refresh_token = $tokens['refresh_token'];
  $expires_in = $tokens['expires_in'];

  // Set the cookies with the tokens
  setcookie('access_token', $access_token, time() + $expires_in, '/', '', true, true);
  setcookie('refresh_token', $refresh_token, time() + 86400 * 30, '/', '', true, true);
}

function get_access_token_cookie() {
  if (isset($_COOKIE['access_token'])) {
    return $_COOKIE['access_token'];
  } else {
    echo '<script>console.log("No access token found")</script>';
    return null;
  }
}

?>