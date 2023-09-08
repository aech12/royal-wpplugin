<?php
// AUTHENTICATE WITH SUBSCRIBERSTAR API
require_once 'general/log.php';

// STEP 1
// Add a shortcode [subscribestar_oauth2_login] to display the SubscribeStar OAuth2 login link
require_once 'oauth/addShortcode.php';

// STEP 2
// After user clicks Login and accepts permissions, he's redirected back to the url set in Subscriberstar settings and is given a shortlived code
$current_url = $_SERVER['REQUEST_URI'];

require_once 'substar/requestTokens.php';
require_once 'substar/user.php';
require_once 'oauth/user.php';

// add_action('init', 'tryagia');
// function tryagia()
// {
//   $cr = wp_create_user("user1", "pass1234", "aech-13@hotmail.com");
//   _log($cr);
// }
// tryagia();

if (strpos($current_url, '/royal/') === 0 && isset($_GET['code'])) {
  // save access token and refresh token to cookies
  $authorization_code = $_GET['code'];
  _log("Code in url:");
  _log($authorization_code);

  try {
    $tokens = requestTokens($authorization_code);
    // _log($tokens);

    if ($tokens) {
      $substar_user = requestUser($tokens['access_token']);
      $user = saveUserToWp($substar_user['data']['user'], $tokens);
      // _log($user);
    } else {
      _log("Failed to request tokens.");
    }
  } catch (Exception $e) {
    echo '<p>Failed to request tokens. Try signing in again.</p>';
    echo '<p>Error: ' . $e->getMessage() . '</p>';
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