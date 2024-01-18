<?php

declare(strict_types=1);

use SocialBrothers\Theme\Helper\Theme;
use SocialBrothers\Theme\Helper\Twig;

$title   = get_field('404_title', 'options');
$content = get_field('404_content', 'options');
$image_id = get_field('404_image', 'options');
$menu    = wp_nav_menu([
    'theme_location' => '404',
    'echo'           => false,
    'menu_class'     => 'menu-list',
]);


if(function_exists('get_cutoff_class')) {   
    // $cutoff_class = get_cutoff_class('tl-br');
    // Gaat nog niet helemeaal goed (bg color meegeven, opletten met z-index van een video bij content-image-video)
 }

 $cutoff_class = '';

/**
 * @noinspection PhpUnhandledExceptionInspection
 */
Twig::render(
    'content/404.twig',
    Theme::filter('404_context', compact('title', 'content', 'menu', 'cutoff_class', 'image_id'))
);
