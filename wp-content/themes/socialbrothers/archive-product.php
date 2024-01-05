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
        $posts_data[] = wpb_build_product_card_context(get_the_ID());
    }
}

$highlight = get_field("{$post_type}_setting_archive_highlight", 'options');


$filter_terms = get_field("{$post_type}_setting_archive_filters", 'options');
$filters      = [];

$sort = [
    'label'    => __('Sorteer op', '_SBF'),
    'name'     => 'sort',
    'selected' => $_GET['sort'] ?? '',
    'options'  => [
        [
            'value' => '',
            'label' => __('Sorteren op', '_SBF'),
        ],
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

$results = count($posts_data);

$introContent =  get_field('product_archive_content', 'options') ?? '';

$title = __('Producten', '_SBF');

Twig::render(
    'content/archive-product.twig',
    Theme::filter(
        'index_context',
        [
            'intro' => [
                'title'       => $title,
                'content'     => $introContent,
                'first_block' => true,
            ],
            'filters' => [
                'filters'       => $filters,
                'sort'          => $sort,
                'archive_url'   => get_post_type_archive_link($post_type),
                'direct_submit' => true,
            ],
            'posts'      => $posts_data,
            'results'      => $results,
            'pagination' => get_the_posts_pagination([
                'prev_text' => '<span class="material-symbols-rounded">chevron_left</span>',
                'next_text' => '<span class="material-symbols-rounded">chevron_right</span>',
            ]),
            'newsletter_banner' => $news_banner,
        ]
    )
);
