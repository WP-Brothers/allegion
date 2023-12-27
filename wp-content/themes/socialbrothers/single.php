<?php

declare(strict_types=1);

use SocialBrothers\Theme\Helper\Theme;
use SocialBrothers\Theme\Helper\Twig;

global $wp_query, $post;

$post_type = get_post_type();

$head      = wpb_build_single_head_context(get_the_ID());
$permalink = get_the_permalink();
$title     = get_the_title();
$share     = [
    'title'  => __('Deel', '_SBF'),
    'places' => [
        [
            'iconFile' => 'facebook',
            'url'      => "https://www.facebook.com/sharer/sharer.php?u={$permalink}",
        ],

        [
            'iconFile' => 'x',
            'url'      => "https://twitter.com/intent/tweet?url={$permalink}&text={$title}",
        ],
        [
            'break' => true,
        ],
        [
            'iconFile' => 'whatsapp',
            'url'      => "whatsapp://send?text={$permalink}",
        ],
        [
            'icon' => 'mail',
            'url'  => "mailto:?body={$permalink}",
        ],
    ],
];

$author = wpb_build_author_context(get_current_user_id());

$more_slider            = get_field("{$post_type}_setting_single_other_posts", 'options');
$more_slider['slides']  = [];
$more_slider['buttons'] = [
    [
        'url'   => get_post_type_archive_link($post_type),
        'title' => __('Toon alle', '_SBF'),
        'type'  => 'btn--solid',
    ],
];

$more_slider['class_name'] = 'py-10 md:py-20';
$recent_posts              = new WP_Query([
    'post_type'      => $post_type,
    'post__not_in'   => [get_the_ID()],
    'posts_per_page' => 10,
]);

if ($recent_posts->have_posts()) {
    while ($recent_posts->have_posts()) {
        $recent_posts->the_post();
        $more_slider['slides'][] = wpb_build_post_card_context(get_the_ID());
    }
}
wp_reset_query();
wp_reset_postdata();

/**
 * @noinspection PhpUnhandledExceptionInspection
 */
Twig::render(
    'index.twig',
    Theme::filter(
        'index_context',
        compact('wp_query', 'post', 'head', 'share', 'more_slider', 'author')
    )
);
