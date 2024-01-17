<?php

declare(strict_types=1);

use SocialBrothers\Theme\Helper\Theme;
use SocialBrothers\Theme\Helper\Twig;

$contact_hours       = get_field('contact_hours', 'options') ?? '';
$phone       = get_field('phone', 'options') ?? '';
$email       = get_field('email', 'options') ?? '';

$business_name = get_field('business_name', 'options') ?? '';
$address = get_field('address', 'options') ?? '';
$address_link = get_field('address_link', 'options') ?? '';

$menu1       = wpb_menu('footer_1', 2, '') ?? '';
$menu2       = wpb_menu('footer_2', 2, '') ?? '';
$menu3       = wpb_menu('footer_3', 2, '') ?? '';
$menu_bottom = wpb_menu('footer_bottom', 1, 'menu-simple menu-bottom') ?? '';

$logo = get_field('footer_logo', 'options') ?? '';

$socials     = get_field('socials', 'options') ?? '';
$kvk     = get_field('kvk', 'options') ?? '';


/** @noinspection PhpUnhandledExceptionInspection */
Twig::render('footer.twig', Theme::filter('footer_context', compact('contact_hours', 'phone', 'email', 'business_name', 'address', 'menu1', 'menu2', 'menu3', 'menu_bottom', 'socials', 'kvk', 'logo')));
