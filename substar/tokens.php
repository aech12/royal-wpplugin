<?php
// Preserve Subscribersar API tokens in cookies
function save_tokens_to_cookies($tokens)
{
  $access_token = $tokens['access_token'];
  $refresh_token = $tokens['refresh_token'];
  $expires_in = $tokens['expires_in'];

  // Get the last second of the current month
  $last_second_of_month = strtotime('last day of this month 23:59:59');

  // Calculate the maximum expiration time based on the last second of the current month
  $max_expires_in = $last_second_of_month - time();

  // Set the cookies with the tokens
  setcookie('access_token', $access_token, time() + min($expires_in, $max_expires_in), '/', '', true, true);
  setcookie('refresh_token', $refresh_token, time() + 86400 * 30, '/', '', true, true);

}

function get_access_token_cookie()
{
  if (isset($_COOKIE['access_token'])) {
    return $_COOKIE['access_token'];
  } else {
    echo '<script>console.log("No access token found. Login again.")</script>';
    return null;
  }
}

?>