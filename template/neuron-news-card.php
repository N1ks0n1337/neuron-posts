<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if (!function_exists('neuron_create_news_card')) {
    function neuron_create_news_card($post) {
        $url = isset($post['url']) ? esc_url($post['url']) : '';
        $img = isset($post['img']) ? esc_url($post['img']) : '';
        $date = isset($post['date']) ? esc_html($post['date']) : '';
        $title = isset($post['title']) ? esc_html($post['title']) : '';
        $description = isset($post['description']) ? esc_html($post['description']) : '';
        ?>
        <a class="neuron-news-card" href="<?php echo esc_url($url); ?>">
            <div class="neuron-news-card__img-cover">
                <img src="<?php echo esc_url($img); ?>" alt="Post Image">
            </div>
            <div class="neuron-news-card__content">
                <span class="neuron-news-card__date"><?php echo esc_html($date); ?></span>
                <h3 class="neuron-news-card__title"><?php echo esc_html($title); ?></h3>
                <p class="neuron-news-card__text"><?php echo esc_html($description); ?></p>
            </div>
        </a>
        <?php
    }
}
?>
