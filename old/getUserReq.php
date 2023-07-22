<?php
function requestUser($access_token)
{
    $url = "https://subscribestar.adult/api/graphql/v1";

    // $body = array(
    //     'query' => '{ user {email} }',
    // );

    $body = array(
        'query' => '{ 
            subscriber { 
                email,
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
        }'
    );
    

    $user_info_request = wp_remote_post($url, [
        'headers' => [
            'Authorization' => 'Bearer ' . $access_token,
            'Content-Type' => 'application/json'
        ],
        'body' => wp_json_encode( $body ),
        'method' => 'POST',
        'data_format' => 'body'
    ]);

    if (!is_wp_error($user_info_request) && wp_remote_retrieve_response_code($user_info_request) === 200) {
        $user_info = json_decode((string) wp_remote_retrieve_body($user_info_request), true);

        echo '<script>console.log("Info????: ",' . json_encode($user_info) . ')</script>';

        return $user_info;
    }
}

function get_and_update_user_tier($access_token) {
    // Get the user's tier from the user meta
    $user_id = get_current_user_id();

    // Get the subscription data (replace this with your actual logic)
    $subscription = requestUser($access_token)['subscriber']['subscription'];

    // Check if the subscription is active
    if ($subscription['active']) {
        $price = $subscription['price'];

        // Assign user's tier based on the price using a switch statement
        switch (true) {
            case ($price = 500):
                $user_tier = 1;
                break;
            case ($price = 1000):
                $user_tier = 2;
                break;
            case ($price = 2000):
                $user_tier = 3;
                break;
            case ($price = 2500):
                $user_tier = 4;
                break;
            case ($price = 4000):
                $user_tier = 5;
                break;
            case ($price = 5000):
                $user_tier = 6;
                break;
            case ($price = 10000):
                $user_tier = 7;
                break;
            default:
                $user_tier = 0; // If the price doesn't match any of the mock values, set the tier to 0
        }

        // Update the user's tier in the user meta
        update_user_meta($user_id, 'tier', $user_tier);
    } else {
        $user_tier = 0; // If the subscription is not active, set the tier to 0
    }

    return $user_tier;
}

?>