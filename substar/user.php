<?php
// Returns user email, or null if not found
function requestUser($access_token)
{
    $url = "https://subscribestar.adult/api/graphql/v1";

    $body = array(
        'query' => '{ user { email, name } }',
    );

    $user_info_request = wp_remote_post($url, [
        'headers' => [
            'Authorization' => 'Bearer ' . $access_token,
            'Content-Type' => 'application/json'
        ],
        'body' => wp_json_encode($body),
        'method' => 'POST',
        'data_format' => 'body'
    ]);

    if (!is_wp_error($user_info_request) && wp_remote_retrieve_response_code($user_info_request) === 200) {
        $user_info = json_decode((string) wp_remote_retrieve_body($user_info_request), true);

        echo '<script>console.log("Requested subscriber: ",' . json_encode($user_info) . ')</script>';

        return $user_info;
    } else {
        echo '<>console.log("Could not get SubscriberStar user")</script>';
        return null;
    }
}

// GET request to get user's subscriber information
function requestSubscriber($access_token)
{
    $url = "https://subscribestar.adult/api/graphql/v1";

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
        'body' => wp_json_encode($body),
        'method' => 'POST',
        'data_format' => 'body'
    ]);

    if (!is_wp_error($user_info_request) && wp_remote_retrieve_response_code($user_info_request) === 200) {
        $user_info = json_decode((string) wp_remote_retrieve_body($user_info_request), true);

        // echo '<script>console.log("Requested subscriber: ",' . json_encode($user_info) . ')</script>';

        return $user_info;
    } else {
        echo '<>console.log("Could not get SubscriberStar user")</script>';
        return null;
    }
}

// Returns an int with the user tier
function requestUserTier($access_token)
{
    $user_tier = 0;

    // If subscription is undefined, user is not subscribed (return lowest, free tier )
    $subscription = requestSubscriber($access_token);
    if (!isset($subscription['data']['subscriber']) || !isset($subscription['data']['subscriber']['subscription'])) {
        _log("User has no subscription (free user)");
        return $user_tier = 0;
    }
    $subscription = $subscription['data']['subscriber']['subscription'];

    // Check if the subscription is active
    if ($subscription['active']) {
        $price = $subscription['price'];

        // Assign user's tier based on the price using a switch statement
        switch ($price) {
            case ($price === intval(get_option('substar_manager_tier_1'))):
                $user_tier = 1;
                break;
            case ($price === intval(get_option('substar_manager_tier_2'))):
                $user_tier = 2;
                break;
            case ($price === intval(get_option('substar_manager_tier_3'))):
                $user_tier = 3;
                break;
            case ($price === intval(get_option('substar_manager_tier_4'))):
                $user_tier = 4;
                break;
            case ($price === intval(get_option('substar_manager_tier_5'))):
                $user_tier = 5;
                break;
            case ($price === intval(get_option('substar_manager_tier_6'))):
                $user_tier = 6;
                break;
            case ($price === intval(get_option('substar_manager_tier_7'))):
                $user_tier = 7;
                break;
            case ($price === intval(get_option('substar_manager_tier_8'))):
                $user_tier = 7;
                break;
            default:
                $user_tier = 0;
        }
    }

    return $user_tier;
}
?>