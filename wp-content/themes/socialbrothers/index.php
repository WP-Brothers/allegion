<?php

declare(strict_types=1);

use SocialBrothers\Theme\Helper\Theme;
use SocialBrothers\Theme\Helper\Twig;

global $wp_query, $post;

/**
 * @noinspection PhpUnhandledExceptionInspection
 */
Twig::render(
    'index.twig',
    Theme::filter(
        'index_context',
        compact('wp_query', 'post')
    )
);
