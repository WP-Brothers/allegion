<?php

declare(strict_types=1);

use SocialBrothers\Theme\Helper\Theme;
use SocialBrothers\Theme\Helper\Twig;

global $wp_query;

$post_type = get_post_type();

$posts_data = [];
if (have_posts()) {
    while (have_posts()) {
        the_post();
        $posts_data[] = wpb_build_news_card_context(get_the_ID());
    }
}


$filter_terms = get_field("{$post_type}_setting_archive_filters", 'options');
$filters      = [];

$sort = [
    'label'    => __('Sorteer op', '_SBF'),
    'name'     => 'sort',
    'selected' => $_GET['sort'] ?? 'date_asc',
    'options'  => [
        [
            'value' => 'date_asc',
            'label' => __('Datum - oplopend', '_SBF'),
        ],
        [
            'value' => 'date_desc',
            'label' => __('Datum - aflopend', '_SBF'),
        ],
        [
            'value' => 'title_asc',
            'label' => __('Titel - oplopend', '_SBF'),
        ],
        [
            'value' => 'title_desc',
            'label' => __('Titel - aflopend', '_SBF'),
        ],
    ],
];

if (! empty($filter_terms)) {
    $filters = [
        'label'    => __('Filter op', '_SBF'),
        'name'     => 'category',
        'selected' => $_GET['category'] ?? '',
        'terms'    => [
            [
                'value' => '',
                'label' => __('Toon alles', '_SBF'),
                'id'    => 'all',
            ],
        ],
    ];

    foreach ($filter_terms as $filter_term) {
        $filters['terms'][] = [
            'value' => $filter_term->slug,
            'label' => $filter_term->name,
            'id'    => $filter_term->slug,
        ];
    }
}

$title = get_field('news_settings_archive_title', '_SBF') ?? __('Blog overview', '_SBF');
$heroContent =  get_field('news_settings_archive_content', 'options') ?? '';
$heroBackground =  get_field('news_settings_archive_background', 'options') ?? '';


Twig::render(
    'content/archive-news.twig',
    Theme::filter(
        'index_context',
        [
            'intro' => [
                'title'       => $title,
                'content'     => $heroContent,
                'first_block' => true,
                'image_id'    => $heroBackground,
            ],
            'filters' => [
                'sort'          => $sort,
                'archive_url'   => get_post_type_archive_link($post_type),
                'direct_submit' => true,
                'show_resuls'   => false,
                'show_filters'  => true,
                'filters'       => $filters,
                'sort_text'     => __('Sorteer op', '_SBF'),
            ],
            'posts'      => $posts_data,
            'pagination' => get_the_posts_pagination([
                'prev_text' => '<span class="material-symbols-rounded">chevron_left</span>',
                'next_text' => '<span class="material-symbols-rounded">chevron_right</span>',
            ]),
        ]
    )
);
