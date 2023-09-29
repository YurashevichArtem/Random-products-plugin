<?php

/**
 * Random products template
 * Renders a list of products according to the option set in the admin panel.
 * Rendered products can be used by "random_products" shortcode
 */

defined('ABSPATH') || exit;

require RANDOM_PRODUCTS_PLUGIN_DIR . '/includes/data-processing.php';

$products = get_random_products();

if (!$products->have_posts()) {
    echo '<p>' . __('No products found', 'random-products') . '</p>';

    return;
}

?>

<div class="woocommerce">
    <ul class="products">
        <?php while ($products->have_posts()) : ?>
            <?php $products->the_post(); ?>
            <?php wc_get_template_part('content', 'product'); ?>
        <?php endwhile; ?>
    </ul>
</div>

<?php
