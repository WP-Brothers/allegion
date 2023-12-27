<?php

declare(strict_types=1);

use SocialBrothers\Theme\Helper\Theme;
use SocialBrothers\Theme\Helper\Twig;

$title   = get_field('404_title', 'options');
$content = get_field('404_content', 'options');
$menu    = wp_nav_menu([
    'theme_location' => '404',
    'echo'           => false,
    'menu_class'     => 'menu-list',
]);
/**
 * @noinspection PhpUnhandledExceptionInspection
 */
Twig::render(
    'content/404.twig',
    Theme::filter('404_context', compact('title', 'content', 'menu'))
);
