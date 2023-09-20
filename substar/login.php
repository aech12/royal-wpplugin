<?php
// AUTHENTICATE WITH SUBSCRIBERSTAR API

// STEP 1
// Add a shortcode [subscribestar_oauth2_login] to display the SubscribeStar OAuth2 login link/button
require_once 'oauth/addLoginShortcode.php';

// STEP 2
// After user clicks Login and accepts permissions, he's redirected back to the url set in Subscriberstar settings and is given a shortlived code

require_once 'requestTokens.php';
require_once 'user.php';
require_once 'oauth/user.php';

// _log('user logged?126');
// _log(wp_get_current_user());

// Get tokens with url code after user clicks login
if (strpos($_SERVER['REQUEST_URI'], '/royalty/') === 0 && isset($_GET['code'])) {
  // wp_redirect( $current_url . '/royalty/' );
  // exit;
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
      // echo '<p>Succesfull! Go back to royaly to access content.</p>';
    } else {
      _log("Failed to request tokens.");
    }
  } catch (Exception $e) {
    echo '<p>Failed to request tokens. Try signing in again.</p>';
    echo '<p>Error: ' . $e->getMessage() . '</p>';
  }
}

// STEP 3
// When the user requests a page which uses the component generated in this plugin, the component will check if the user is logged in.
// The logic for that is was written in the renderBlock.php file (caution: might be renamed).
?>