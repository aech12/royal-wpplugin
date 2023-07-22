<?php
// Store your ENV variables in .env file - (couldn't make .env work in wordpress)
define('SUBSCRIBESTAR_CLIENT_ID', 'rQrGZN1CFd_26K8L-8lzDHf9_emPQ7h2bnBHq32ABLg');
define('SUBSCRIBESTAR_SECRET', 'RoPWLOf7EfItn9BXc2b0ZryL3-RoYqCji-sqjNrBotU');
define('SUBSCRIBESTAR_REDIRECT_URI', 'http://localhost/royal');
define('SUBSCRIBESTAR_REQUEST_SCOPE', "subscriber.read+subscriber.payments.read+user.read+user.email.read");
define('SUBSCRIBESTAR_API_ENDPOINT', "https://www.subscribestar.com/api/graphql/v1");

return [
  'SUBSCRIBESTAR_CLIENT_ID' => 'rQrGZN1CFd_26K8L-8lzDHf9_emPQ7h2bnBHq32ABLg',
  'SUBSCRIBESTAR_SECRET' => 'RoPWLOf7EfItn9BXc2b0ZryL3-RoYqCji-sqjNrBotU',
  'SUBSCRIBESTAR_REDIRECT_URI' => 'http://localhost/royal',
  'SUBSCRIBESTAR_REQUEST_SCOPE' => "subscriber.read+subscriber.payments.read+user.read+user.email.read",
  'SUBSCRIBESTAR_API_ENDPOINT' => "https://www.subscribestar.com/api/graphql/v1"
];
?>