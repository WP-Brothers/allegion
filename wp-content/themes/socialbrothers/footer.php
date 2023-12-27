<?php

declare(strict_types=1);

use SocialBrothers\Theme\Helper\Theme;
use SocialBrothers\Theme\Helper\Twig;

$phone       = get_field('phone', 'options');
$email       = get_field('email', 'options');
$content     = get_field('footer_content', 'options');
$menu1       = wpb_menu('footer_1', 1, 'menu-list');
$menu2       = wpb_menu('footer_2', 1, 'menu-list');
$menu_bottom = wpb_menu('footer_bottom', 1, 'menu-simple');
$socials     = get_field('socials', 'options');
/** @noinspection PhpUnhandledExceptionInspection */
Twig::render('footer.twig', Theme::filter('footer_context', compact('phone', 'email', 'content', 'menu1', 'menu2', 'menu_bottom', 'socials')));
