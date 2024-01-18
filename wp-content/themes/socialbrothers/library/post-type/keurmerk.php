<?php

declare(strict_types=1);

add_action('init', function (): void {
    $labels = [
        'name'          => _x('Keurmerken', 'Post Type General Name', '_SBB'),
        'singular_name' => _x('Keurmerk', 'Post Type Singular Name', '_SBB'),
        'menu_name'     => __('Keurmerken', '_SBB'),
        'archives'      => __('Keurmerken', '_SBB'),
        'all_items'     => __('Keurmerken', '_SBB'),
    ];

    $options = [
        'label'              => $labels['menu_name'],
        'labels'             => $labels,
        'public'             => true,
        'menu_position'      => 29,
        'menu_icon'          => 'dashicons-awards',
        'has_archive'        => false,
        'rewrite'            => ['slug' => 'keurmerken'],
        'publicly_queryable' => true,
        'capability_type'    => 'post',
        'show_in_rest'       => true,
        'supports'           => ['title', 'thumbnail'],
    ];

    register_post_type('keurmerk', $options);
});