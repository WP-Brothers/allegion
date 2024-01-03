<?php

declare(strict_types=1);

add_action('init', function (): void {
    $labels = [
        'name'          => _x('FAQ', 'Post Type General Name', '_SBB'),
        'singular_name' => _x('FAQ', 'Post Type Singular Name', '_SBB'),
        'menu_name'     => __('FAQ', '_SBB'),
        'archives'      => __('FAQ', '_SBB'),
        'all_items'     => __('FAQ\'s', '_SBB'),
    ];

    $options = [
        'label'              => $labels['menu_name'],
        'labels'             => $labels,
        'public'             => true,
        'menu_position'      => 29,
        'menu_icon'          => 'dashicons-media-document',
        'has_archive'        => false,
        'rewrite'            => ['slug' => 'faq'],
        'publicly_queryable' => true,
        'capability_type'    => 'post',
        'show_in_rest'       => true,
        'supports'           => ['title', 'editor',],
    ];

    register_post_type('faq', $options);
});
