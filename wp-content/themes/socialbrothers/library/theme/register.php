<?php

declare(strict_types=1);
defined('ABSPATH') || exit;

/**
 * Here we will register our navigation menus that will be used throughout
 * the entire WordPress website.
 */
function wpb_register_menus_init(): void
{
    register_nav_menus([
        'primary'       => __('Hoofdmenu', '_SBB'),
        'header_top'       => __('Header Boven', '_SBB'),
        '404'           => __('404 Links', '_SBB'),
        'footer_1'      => __('Footer Menu 1', '_SBB'),
        'footer_2'      => __('Footer Menu 2', '_SBB'),
        'footer_3'      => __('Footer Menu 3', '_SBB'),
        'footer_bottom' => __('Footer Menu Beneden', '_SBB'),
    ]);
}

add_action('after_setup_theme', 'wpb_register_menus_init');

/**
 * Here we will register our custom image sizes that will be used throughout
 * the entire WordPress website.
 */
function wpb_register_image_sizes(): void
{
    add_image_size('extralarge', 1440, 810);
}
add_action('after_setup_theme', 'wpb_register_image_sizes');


function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}                               
add_action( 'after_setup_theme', 'woocommerce_support' );
