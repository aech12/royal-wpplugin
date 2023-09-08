<?php
// THIS FILE WORKS W OLD SYSTEM AND IS ONLY ARCHIVED FOR REFERENCE

// AUTHENTICATE WITH SUBSCRIBERSTAR API

// request config for constant variables
// include('substar/config.php');

function _log($output)
{
  echo '<script>console.log("_ ", ' . json_encode($output) . ')</script>';
}

// STEP 1
// Add a shortcode [subscribestar_oauth2_login] to display the SubscribeStar OAuth2 login link
require_once 'substar/addShortcode.php';

// STEP 2
// After user clicks Login and accepts permissions, he's redirected back to the url set in Subscriberstar settings and is given a shortlived code
$current_url = $_SERVER['REQUEST_URI'];

require_once 'substar/requestTokens.php';
require_once 'substar/tokens.php';
require_once 'substar/user.php';

// if (strpos($current_url, '/login/subscriberstar/') === 0) {
if (strpos($current_url, '/royal/') === 0) {
  // save access token and refresh token to cookies
  if (isset($_GET['code'])) {
    $authorization_code = $_GET['code'];
    _log("Code in url:");
    _log($authorization_code);

    $tokens = requestTokens($authorization_code);

    if ($tokens) {
      save_tokens_to_cookies($tokens);
      echo '<p>Succesfully logged in!</p>';
    } else {
      echo '<p>Failed to request tokens. Try signing in again.</p>';
      _log("Failed to request tokens.");
    }
  } else {
    // echo '<p>Could not detect code in url.</p>';
    _log("Could not detect code in url. Tokens won't be requested.");
  }
}

// if (is_page('my-page')) {
//   // Your PHP code here
// }

// STEP 3
// When the user requests a page which uses the component generated in this plugin, the component will check if the user is logged in.
// If the user's access token is expired, log the user out.
// The logic is in the createTierMenu.php file in the root folder.
?>