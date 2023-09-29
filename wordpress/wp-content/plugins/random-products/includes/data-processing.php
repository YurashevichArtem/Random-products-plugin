
<?php

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