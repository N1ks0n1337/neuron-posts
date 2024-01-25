<?php
/*
 * Plugin Name:       Neuron Posts
 * Plugin URI:        https://wordpress.org/plugins/neuron-posts/
 * Description:       A Neuron WordPress plugin to display user posts.
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Neuron Expert
 * Author URI:        https://neuron.expert/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
defined('ABSPATH') or die('No script kiddies please!');

// Include API connector
require_once(plugin_dir_path(__FILE__) . 'neuron-api-connector.php');

// Shortcode to display posts
function neuron_display_user_posts($atts) {
    $atts = shortcode_atts(
        array(
            'api_key' => '',
        ),
        $atts,
        'neuron_display_user_posts'
    );

    $api_key = sanitize_text_field($atts['api_key']);

    if (empty($api_key)) {
        return 'Error: API key is missing.';
    }

    // Get user posts
    $user_posts = neuron_fetch_user_posts($api_key);

    // Check if posts are fetched successfully
    if ($user_posts && isset($user_posts['posts']) && is_array($user_posts['posts'])) {
        ob_start();

        // Include news-card.php
        include(plugin_dir_path(__FILE__) . 'template/neuron-news-card.php');

        // Display posts
        foreach ($user_posts['posts'] as $post) {
            neuron_create_news_card($post); 
        }

        return ob_get_clean();
    } else {
        return 'Error: Failed to fetch user posts.';
    }
}
add_shortcode('neuron_display_user_posts', 'neuron_display_user_posts');

// Enqueue your stylesheet
function neuron_enqueue_custom_styles() {
    wp_enqueue_style('neuron-posts-styles', plugin_dir_url(__FILE__) . 'neuron-posts-styles.css');
}
add_action('wp_enqueue_scripts', 'neuron_enqueue_custom_styles');
