<?php

declare(strict_types=1);

add_action('init', function (): void {
    $labels = [
        'name'          => _x('Vacatures', 'Post Type General Name', '_SBB'),
        'singular_name' => _x('Vacatuur', 'Post Type Singular Name', '_SBB'),
        'menu_name'     => __('Vacatures', '_SBB'),
        'archives'      => __('Vacatures', '_SBB'),
        'all_items'     => __('Vacatures', '_SBB'),
    ];

    $options = [
        'label'              => $labels['menu_name'],
        'labels'             => $labels,
        'public'             => true,
        'menu_position'      => 29,
        'menu_icon'          => 'dashicons-id',
        'has_archive'        => true,
        'rewrite'            => ['slug' => 'vacancies'],
        'publicly_queryable' => true,
        'capability_type'    => 'post',
        'show_in_rest'       => true,
        'supports'           => ['title', 'thumbnail'],
    ];

    register_post_type('vacancy', $options);

    $type = [
        'labels' => [
            'name'          => __('Vacatuur categorieën', '_SBB'),
            'singular_name' => __('Vacatuur categorie', '_SBB'),
        ],

        'public'       => false,
        'show_ui'      => true,
        'rewrite'      => false,
        'hierarchical' => true,
        'show_in_rest' => true,
    ];

    register_taxonomy('category_vacancy', ['vacancy'], $type);
});
