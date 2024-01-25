<div class="tabs__content" id="user-posts">
    <div class="container">
        <h1 class="has-text-align-center wp-block-post-title">My posts</h1>
        <div class="tabs__content" id="user-posts-content">
            <?php
            if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
            // Display posts if $user_posts is defined and is an array
            if (isset($user_posts) && is_array($user_posts['posts'])) {
                // Include neuron-news-card.php to make neuron_create_news_card function available
                include(plugin_dir_path(__FILE__) . 'neuron-news-card.php');

                // Display posts
                foreach ($user_posts['posts'] as $post) {
                    neuron_create_news_card($post);
                }
            } else {
                echo 'No posts found.'; // or handle accordingly
            }
            ?>
        </div>
    </div>
</div>