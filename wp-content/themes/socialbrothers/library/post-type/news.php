<?php

declare(strict_types=1);

add_action('init', function (): void {
    $labels = [
        'name'          => _x('Nieuws', 'Post Type General Name', '_SBB'),
        'singular_name' => _x('Nieuws', 'Post Type Singular Name', '_SBB'),
        'menu_name'     => __('Nieuws', '_SBB'),
        'archives'      => __('Nieuws', '_SBB'),
        'all_items'     => __('Nieuws', '_SBB'),
    ];

    $options = [
        'label'              => $labels['menu_name'],
        'labels'             => $labels,
        'public'             => true,
        'menu_position'      => 29,
        'menu_icon'          => 'dashicons-media-document',
        'has_archive'        => true,
        'rewrite'            => ['slug' => 'nieuws'],
        'publicly_queryable' => true,
        'capability_type'    => 'post',
        'show_in_rest'       => true,
        'supports'           => ['title', 'thumbnail', 'editor', 'excerpt'],
    ];

    register_post_type('news', $options);

    $type = [
        'labels' => [
            'name'          => __('Nieuws type', '_SBB'),
            'singular_name' => __('Nieuws type', '_SBB'),
        ],

        'public'       => false,
        'show_ui'      => true,
        'rewrite'      => false,
        'hierarchical' => true,
        'show_in_rest' => true,
    ];

    register_taxonomy('category_news', ['news'], $type);
});
