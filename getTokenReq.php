<?php
define('SUBSCRIBESTAR_CLIENT_ID', 'rQrGZN1CFd_26K8L-8lzDHf9_emPQ7h2bnBHq32ABLg');
define('SUBSCRIBESTAR_CLIENT_SECRET', 'RoPWLOf7EfItn9BXc2b0ZryL3-RoYqCji-sqjNrBotU');
define('SUBSCRIBESTAR_REDIRECT_URI', 'http://localhost/royal');

// Handle the OAuth2 callback
function requestToken($code)
{
    // if ($code && isset($_GET['state']) && $_GET['state'] === 'subscribestar') {
    $token_request_data = [
        'code' => $code,
        'client_id' => SUBSCRIBESTAR_CLIENT_ID,
        'client_secret' => SUBSCRIBESTAR_CLIENT_SECRET,
        'redirect_uri' => SUBSCRIBESTAR_REDIRECT_URI,
        'grant_type' => 'authorization_code',
    ];

    $token_request = wp_remote_post('https://www.subscribestar.com/oauth2/token', [
        'body' => $token_request_data,
    ]);

    if (!is_wp_error($token_request) && wp_remote_retrieve_response_code($token_request) === 200) {
        $token_response = json_decode(wp_remote_retrieve_body($token_request), true);
        return $token_response;
    }

    // Redirect the user to the desired page after successful login
    // wp_redirect(home_url());
    // exit;
    else {
        echo '<script>console.log(' . json_encode("Failed to request token") . ')</script>';
        return null;
    }
}

?>