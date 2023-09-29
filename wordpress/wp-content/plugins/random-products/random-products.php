<?php

/*
Plugin name: Random products
Version: 1.0.0
Author: Innowise
Description: This plugin provides a shortcode that displays a random number of products according to the setting specified in the "Random products" tab in the admin panel.
 */

define('RANDOM_PRODUCTS_PLUGIN_DIR', WP_PLUGIN_DIR . '/random-products'); 

/**
 * Random products plugin activation hook.
 *
 * @return void
 */
function random_products_plugin_activate(): void
{
    if (is_plugin_active('woocommerce/woocommerce.php')) {
        return;
    }

    $woocommerce_plugin_path = 'woocommerce/woocommerce.php';
    activate_plugin($woocommerce_plugin_path);
}
register_activation_hook(__FILE__, 'random_products_plugin_activate');

/**
 * This function register setting page of random products plugin
 *
 * @return void
 */
function random_products_page(): void
{
    add_menu_page(
        'WooCommerce random products settings',
        'Random products',
        'manage_options',
        'random-products-settings',
        'random_products_settings_page',
        'dashicons-randomize',
        99
    );
}
add_action('admin_menu', 'random_products_page');

/**
 * This function displays the contents of the "Random products" settings tab.
 *
 * @return void
 */
function random_products_settings_page(): void
{
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('random-products-settings');
            do_settings_sections('random-products-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

/**
 * Registration and processing of all necessary settings and fields on the “Random products” settings tab
 *
 * @return void
 */
function random_products_settings_init(): void
{
    register_setting(
        'random-products-settings',
        'random_products_displayed_amount',
        'intval'
    );

    add_settings_section(
        'random-products-general-section',
        'General settings',
        'random_products_general_section',
        'random-products-settings'
    );

    add_settings_field(
        'random-products-amount-field',
        'Displayed products',
        'random_products_amount',
        'random-products-settings',
        'random-products-general-section'
    );
}

add_action('admin_init', 'random_products_settings_init');

/**
 * Callback that displays general section text
 *
 * @return void
 */
function random_products_general_section(): void
{
    echo '<p>' . __('Here you can set the number of products to be displayed', 'random-products') . '</p>';
}

/**
 * Callback that provides input field for the general settings section.
 * There is no need to check data type inside this function - 'intval' option in register_settings does this automatically
 * @return void
 */
function random_products_amount(): void
{
    $displayed_amount = get_option('random_products_displayed_amount') ?? get_option('posts_per_page');

    if ($displayed_amount <= 0) {
        $displayed_amount = get_option('posts_per_page');
    }

    echo '<input type="text" name="random_products_displayed_amount" value="' . esc_attr($displayed_amount) . '" />';
}

/**
 * This function updates "random_products_displayed_amount" option
 *
 * @return void
 */
function random_products_save_option(): void
{
    if (isset($_POST['random_products_displayed_amount'])) {
        update_option('random_products_displayed_amount', sanitize_text_field($_POST['random_products_displayed_amount']));
    }
}

add_action('admin_init', 'random_products_save_option');

/**
 * This function creates a "random_products" shortcode that allows you to display a random number of woocommerce products everywhere
 *
 * @return string|false
 */
function random_products_rendering(): string|false
{
    ob_start();

    require RANDOM_PRODUCTS_PLUGIN_DIR . '/templates/product-template.php';

    wp_reset_postdata();

    return ob_get_clean();
}

add_shortcode('random_products', 'random_products_rendering');