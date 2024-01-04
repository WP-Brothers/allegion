<?php

declare(strict_types=1);

add_action('init', function (): void {
    $labels = [
        'name'          => _x('Producten', 'Post Type General Name', '_SBB'),
        'singular_name' => _x('Product', 'Post Type Singular Name', '_SBB'),
        'menu_name'     => __('Producten', '_SBB'),
        'archives'      => __('Producten', '_SBB'),
        'all_items'     => __('Producten', '_SBB'),
    ];

    $options = [
        'label'              => $labels['menu_name'],
        'labels'             => $labels,
        'public'             => true,
        'menu_position'      => 29,
        'menu_icon'          => 'dashicons-cart',
        'has_archive'        => true,
        'rewrite'            => ['slug' => 'nieuws'],
        'publicly_queryable' => true,
        'capability_type'    => 'post',
        'show_in_rest'       => true,
        'supports'           => ['title', 'thumbnail', 'editor', 'excerpt'],
    ];

    register_post_type('product', $options);

    $type = [
        'labels' => [
            'name'          => __('Product categorieën', '_SBB'),
            'singular_name' => __('Product categorie', '_SBB'),
        ],

        'public'       => false,
        'show_ui'      => true,
        'rewrite'      => false,
        'hierarchical' => true,
        'show_in_rest' => true,
    ];

    register_taxonomy('category_product', ['product'], $type);
});