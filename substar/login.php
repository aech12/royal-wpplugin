<?php
// AUTHENTICATE WITH SUBSCRIBERSTAR API

// STEP 1
// Add a shortcode [subscribestar_oauth2_login] to display the SubscribeStar OAuth2 login link/button
require_once 'oauth/addLoginShortcode.php';

// STEP 2
// After user clicks Login and accepts permissions, he's redirected back to the url set in Subscriberstar settings and is given a shortlived code

require_once 'requestTokens.php';
require_once 'user.php';
// require_once 'oauth/user.php';
require_once 'oauth/user_session.php';

$current_url = $_SERVER['REQUEST_URI'];

if (strpos($current_url, '/royalty/') === 0 && isset($_GET['code'])) {
  // save access token and refresh token to cookies
  $authorization_code = $_GET['code'];
  _log("Code in url:");
  _log($authorization_code);

  try {
    $tokens = requestTokens($authorization_code);
    // _log($tokens);

    if ($tokens) {
      $substar_user = requestUser($tokens['access_token']);
      set_user_access_token($tokens['access_token']);
      _log("saved token");
      _log(get_user_access_token());
      

      // In the old version, saveUserToWp was used to save the user to WP users db
      // $user = saveUserToWp($substar_user['data']['user'], $tokens);
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
// The logic is in the createTierMenu.php file in the root folder.
?>