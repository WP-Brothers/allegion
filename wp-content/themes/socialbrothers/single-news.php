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

$news = [];
$current_id = get_the_ID();


$recent_posts              = new WP_Query([
    'post_type'      => $post_type,
    'posts_per_page' => 4,
]);


$block['style']['color']['background'] = "background-color: var(--wp--preset--color--secondary-light)";

if ($recent_posts->have_posts()) {
    while ($recent_posts->have_posts()) {
        $recent_posts->the_post();
        if(get_the_ID() !== $current_id && count($news) < 3) {
            $news[] = wpb_build_news_card_context(get_the_ID());
        }
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
        compact('wp_query', 'post', 'news', 'author', 'block', 'title')
    )
);
