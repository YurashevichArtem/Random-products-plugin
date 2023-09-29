<?php

/**
 * Random products template
 * Selects and renders a list of products according to the option set in the admin panel.
 * Rendered products can be used by "random_products" shortcode
 */

defined('ABSPATH') || exit;

/**
 * This function executes a query that get all products according to the option 'random_products_displayed_amount' setted by admin in admin panel, or gets the default value.
 *
 * @return object
 */
function get_random_products(): object
{
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => get_option('random_products_displayed_amount') ?? get_option('posts_per_page'),
        'orderby' => 'rand',
    );

    $products = new WP_Query($args);

    return $products;
}

/**
 * This function displays all selected products according to the basic woocommerce products template.
 *
 * @return void
 */
function display_random_products(): void
{
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
}