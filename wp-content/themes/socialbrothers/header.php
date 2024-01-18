<?php

declare(strict_types=1);

use SocialBrothers\Theme\Helper\Theme;
use SocialBrothers\Theme\Helper\Twig;

$menu_classes = 'menu-main';
$megamenu_classes = 'megamenu-element__menu';
$menu_top_classes = 'menu-header-top';

if (get_field('header_submenu_hover', 'options')) {
    $menu_classes = "{$menu_classes} menu-main--hover";
}

/**
 * Renders templates/twig/layout/header.twig.
 *
 * @filter `sb-starter-theme_header_context` to edit `$header_context` values.
 *
 * @noinspection PhpUnhandledExceptionInspection
 */


$sites = wpb_get_sites();

foreach ($sites as $site) {
    $languages[$site] = get_blog_details($site);
}

$activeLanguage = $languages[get_blog_details(get_current_blog_id())->blogname];
unset($languages[get_blog_details(get_current_blog_id())->blogname]);


$languageArray = [];
foreach($languages as $language) {
    $languageArray[$language->blog_id]['id'] = $language->blog_id;
    $languageArray[$language->blog_id]['name'] = $language->blogname;
    $languageArray[$language->blog_id]['url'] = $language->siteurl;
}

$highlightedProduct = get_field('header_megamenu_highlighted_product', 'options') ?? '';
$newTag = get_field('header_megamenu_new_tag', 'options') ?? '';
$productText = get_field('header_megamenu_text', 'options') ?? '';


$highlightedProductArray = [];
$highlightedProductArray['name'] = $highlightedProduct->post_title;
$highlightedProductArray['excerpt'] = $productText;
$highlightedProductArray['new_tag'] = $newTag;
$highlightedProductArray['url'] = $highlightedProduct->guid;
$highlightedProductArray['image'] = get_the_post_thumbnail($highlightedProduct->ID, 'large', ['class' => 'w-auto h-[128px]']);



Twig::render(
    'header.twig',
    Theme::filter('header_context', [
        'language_attributes' => get_language_attributes(),
        'html_class'          => esc_attr(get_field('brand_style', 'options') ?? ''),
        'body_class'          => esc_attr(implode(' ', get_body_class('after:hidden after:fixed after:top-0 after:left-0 after:h-screen after:w-screen after:bg-black/30 after:z-[90]'))),
        'header'              => [
            'menu'    => wpb_menu('primary', 2, $menu_classes),
            'megamenu'    => wpb_menu('primary', 2, $megamenu_classes),
            'menu_top'    => wpb_menu('header_top', 1, $menu_top_classes),
            'logo_id' => get_field('logo', 'options'),
            'button'  => wpb_build_button_context(get_field('header_button', 'options') ?? []),
            'languages'   => $languageArray,
            'highlighted_product' => $highlightedProductArray
        ],
    ])
);