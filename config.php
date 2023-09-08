<?php
$subscribestar_api_endpoint = "https://www.subscribestar.com/api/graphql/v1";
$substar_manager_request_scope = "subscriber.read+user.read+user.email.read";

define('SUBSCRIBESTAR_API_ENDPOINT', $subscribestar_api_endpoint);
define('SUBSCRIBESTAR_REQUEST_SCOPE', $substar_manager_request_scope);

// Set variables from above form
$subscribestar_client_id = get_option('substar_manager_client_id');
$subscribestar_secret = get_option('substar_manager_secret');
$subscribestar_redirect_uri = get_option('substar_manager_redirect_uri');
// $subscribestar_request_scope = get_option('substar_manager_request_scope');

return [
  'SUBSCRIBESTAR_API_ENDPOINT' => $subscribestar_api_endpoint,
  'SUBSCRIBESTAR_REQUEST_SCOPE' => $substar_manager_request_scope
];
?>