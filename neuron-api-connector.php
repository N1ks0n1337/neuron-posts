<?php
// API Connector
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$api_url = 'https://api.neuron.expert/';

function neuron_fetch_user_posts($api_key) {
    global $api_url;

    $headers = array(
        'api-key' => $api_key,
    );

    $response = wp_remote_get("$api_url/posts", array('headers' => $headers));

    if (is_wp_error($response)) {
        error_log("Failed to fetch user posts: " . $response->get_error_message());
        return false;
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (!$data) {
        error_log("Failed to decode JSON data: " . json_last_error_msg());
        return false;
    }

    return $data;
}
