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
        $posts_data[] = wpb_build_post_card_context(get_the_ID());
    }
}

$highlight = get_field("{$post_type}_setting_archive_highlight", 'options');

if (empty($highlight)) {
    $highlight = wp_list_pluck(get_posts(
        [
            'posts_per_page' => 1,
            'post_type'      => [$post_type],
        ]
    ), 'ID')[0] ?? false;
}

if (! empty($highlight)) {
    $highlight = wpb_build_post_card_context($highlight);
}
$filter_terms = get_field("{$post_type}_setting_archive_filters", 'options');
$filters      = [];

$sort = [
    'label'    => __('Sorteer op', '_SBF'),
    'name'     => 'sort',
    'selected' => $_GET['sort'] ?? 'date_desc',
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
                'label' => __('Alles', '_SBF'),
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

$news_banner = get_field('newsletter', 'options') ?? [];

$news_banner['content_small'] = true;
$news_banner['privacy_text']  = sprintf(
    __('Ik ga akkoord met het %sPrivacy statement%s', '_SBF'),
    '<a href="' . get_privacy_policy_url() . '">',
    '</a>'
);

Twig::render(
    'content/archive.twig',
    Theme::filter(
        'index_context',
        [
            'banner' => [
                'title'       => get_field("{$post_type}_setting_archive_title", 'options'),
                'content'     => get_field("{$post_type}_setting_archive_content", 'options'),
                'first_block' => true,
                'socials'     => get_field('socials', 'options'),
                'highlight'   => $highlight,
            ],
            'filters' => [
                'filters'       => $filters,
                'sort'          => $sort,
                'archive_url'   => get_post_type_archive_link($post_type),
                'direct_submit' => true,
            ],
            'posts'      => $posts_data,
            'pagination' => get_the_posts_pagination([
                'prev_text' => '<span class="material-symbols-rounded">arrow_back</span>',
                'next_text' => '<span class="material-symbols-rounded">arrow_forward</span>',
            ]),
            'newsletter_banner' => $news_banner,
        ]
    )
);
