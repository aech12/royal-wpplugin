<?php
// Returns parsed JSON hash or dies on response error
function sendPostRequest($url, $params, $headers) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
  }
  
function getSubscriberInfo($access_token) {
  if (!$access_token) {
    echo "Access token is required\n";
    return null;
  }

  // Example usage
  $query = "{
    subscriber {
      subscription {
        price
        active
        billing_failed
        billing_failed_at
        cancelled
        cancelled_at
        last_time_charged_at
      }
    }
  }";
  
  $queryParams = array(
      'query' => $query
  );
  
  $headers = array(
      "Authorization: Bearer {$accessToken}",
      "Content-Type: application/json"
  );

  $response = sendPostRequest('https://subscribestar.adult/api/graphql/v1', $queryParams, $headers);
  return $response;
}
  
  // example use
//   $response = getSubscriberInfo('ACCES TOKEN');
  
// Handle the response
// $data = json_decode($response, true);

// if (isset($data['data']['subscriber']['subscription'])) {
//   $subscription = $data['data']['subscriber']['subscription'];
//   // Do something with the subscription data
//   echo "Subscription price: " . $subscription['price'] . "\n";
//   echo "Subscription active: " . $subscription['active'] . "\n";
//   echo "Subscription billing failed: " . $subscription['billing_failed'] . "\n";
//   // ...
// } else {
//   // Handle the case where the subscription data is not available
//   echo "Subscription data not available\n";
// }

?>