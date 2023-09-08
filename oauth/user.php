<?php
// Log in using WP native system
function loginToWp($username, $password)
{
  // $user = wp_authenticate($username, $password);
  $user = wp_signon(
    array(
      'user_login' => $username,
      'user_password' => $password,
      'remember' => true
    )
  );

  if (is_wp_error($user)) {
    // Handle login errors here
    $error_message = $user->get_error_message();
    echo "Login failed: " . $error_message;
    return null;
  } else {
    // Login successful, proceed with further actions
    wp_set_current_user($user->ID);

    $user = wp_get_current_user();
    return $user;
  }
}

// Preserve Subscribersar User and tokens
function saveUserToWp($substar_user, $tokens)
{
  $user_exists = get_user_by('email', $substar_user['email']);
  $username = str_replace("#", "", $substar_user['name']);

  $userdata = array(
    'user_email' => $substar_user['email'],
    'user_login' => $username,
    'role' => '0 Free',
    'user_pass' => $username // wp_generate_password()
  );

  // If user is found, update instead
  $user_id = false;
  if ($user_exists) {
    $userdata['ID'] = $user_exists->ID;
    $user_id = wp_update_user($userdata);
  } else {
    $user_id = wp_insert_user($userdata);
  }

  // If user was succesfully created, attach their tokens and log them in
  if (!is_wp_error($user_id)) {
    update_user_meta($user_id, 'access_token', $tokens['access_token']);
    update_user_meta($user_id, 'refresh_token', $tokens['refresh_token']);

    $user = loginToWp($username, $username);

    return $user;
  } else {
    echo "Error creating user! " . $user_id->get_error_message();
    // wp_die("Error creating user! " . $user_id->get_error_message());
    return false;
  }
}

// function getUser()
// {
//   if (isset($_COOKIE['access_token'])) {
//     return $_COOKIE['access_token'];
//   } else {
//     echo '<script>console.log("No access token found. Login again.")</script>';
//     return null;
//   }
// }

?>