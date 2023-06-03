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

?>