<?php
session_start();

// Save the user access token for the session
function set_user_access_token($access_token)
{
  $_SESSION['access_token'] = $access_token;
}

// Preserve Subscribersar User and tokens
function get_user_access_token()
{
  if (isset($_SESSION['access_token'])) {
    return $_SESSION['access_token'];
  }

  return null;
}
?>