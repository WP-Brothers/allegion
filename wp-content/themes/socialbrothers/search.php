<?php

declare(strict_types=1);

use SocialBrothers\Theme\Helper\Theme;
use SocialBrothers\Theme\Helper\Twig;

global $wp_query, $post;

$found = $wp_query->post_count;

$search = $_GET['s'];
$title  = get_field('search_page_title', 'options');
/**
 * @noinspection PhpUnhandledExceptionInspection
 */
Twig::render(
    'content/search.twig',
    Theme::filter(
        'index_context',
        compact('wp_query', 'post', 'title', 'found', 'search')
    )
);
