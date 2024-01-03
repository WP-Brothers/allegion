<?php

declare(strict_types=1);

use SocialBrothers\Theme\Helper\Theme;

defined('ABSPATH') || exit('Forbidden');

/**
 * Does the same as apply_filters, but prefixes $hook_name with THEME_PACKAGE_NAME,
 * which defaults to "sb-starter-theme".
 *
 * @param string $hook_name "example_hook" (by default) translates to "sb-starter-theme_example_hook"
 *
 * @return mixed|void
 *
 * @see apply_filters()
 */
function apply_theme_filters(string $hook_name, mixed $value): mixed
{
    return Theme::filter($hook_name, $value);
}

/**
 * Does the same as add_filter, but prefixes $hook_name with THEME_PACKAGE_NAME,
 * which defaults to "sb-starter-theme".
 *
 * @param string $hook_name "example_hook" (by default) translates to "sb-starter-theme_example_hook"
 */
function add_theme_filter(string $hook_name, callable $callback, int $priority = 10, int $accepted_args = 0): void
{
    Theme::addFilter($hook_name, $callback, $priority, $accepted_args);
}

/**
 * Generate slug-compatible string from any string.
 */
function slugify(string $value): ?string
{
    return preg_replace(
        '/[^A-Za-z\d_-]/',
        '',
        str_replace(' ', '_', strtolower($value))
    );
}

/**
 * Get ID of the first ACF block on the page.
 */
function wpb_first_block_id(): null|int|string
{
    $post = get_post();

    if (empty($post->post_content) || ! has_blocks($post->post_content)) {
        return null;
    }

    foreach (parse_blocks($post->post_content) as $block) {
        if (null === $block['blockName'] || 'acf/breadcrumbs' === $block['blockName']) {
            continue;
        }

        $first_block_id = $block['attrs']['id'];

        if (! empty($first_block_id)) {
            return $first_block_id;
        }
    }

    return null;
}

/**
 * This function will return our custom Tailwind WordPress menu instead of the standard
 * and default WordPress menu.
 *
 * @return false|string|void|null
 *
 * @noinspection PhpMixedReturnTypeCanBeReducedInspection
 */
function wpb_menu(string $location = 'primary', int $depth = 2, string $classes = '')
{
    $args = [
        'theme_location' => $location,
        'depth'          => $depth,
        'walker'         => new Walker_Bem($classes),
        'echo'           => false,
    ];

    if (has_nav_menu($location)) {
        return wp_nav_menu($args);
    }

    printf('You need to first define a menu in %s.', $location);
}

function wpb_get_gforms(): array
{
    $forms = [];

    if (class_exists('GFAPI')) {
        $forms[''] = __('Selecteer een formulier', '_SBB');

        foreach (GFAPI::get_forms() as $form) {
            $forms[$form['id']] = $form['title'];
        }
    }

    return $forms;
}

function get_cutoff_class($layout = 'bl-tr') {
    $before = '';
    $after = '';
    
    if($layout == 'bl-tr') {
        $before = "before:w-[256px] before:h-[256px] before:rotate-[45deg] before:hidden before:md:block before:bottom-[-40%] before:left-[-25%] before:md:left-[-25%] before:lg:left-[-20%] before:xl:left-[-16%] before:bg-white before:content-[''] before:absolute before:z-[4]";
        $after = "after:w-[256px] after:h-[256px] after:rotate-[45deg] after:hidden after:md:block after:top-[-40%] after:right-[-25%] after:md:right-[-25%] after:lg:right-[-20%] after:xl:right-[-16%] after:bg-white after:content-[''] after:absolute after:z-[4]";
    } elseif ($layout == 'tl-br') {
        $before = "before:w-[256px] before:h-[256px] before:rotate-[45deg] before:hidden before:md:block before:top-[-40%] before:left-[-25%] before:md:left-[-25%] before:lg:left-[-20%] before:xl:left-[-16%] before:bg-white before:content-[''] before:absolute before:z-[4]";
        $after = "after:w-[256px] after:h-[256px] after:rotate-[45deg] after:hidden after:md:block after:bottom-[-40%] after:right-[-25%] after:md:right-[-25%] after:lg:right-[-20%] after:xl:right-[-16%] after:bg-white after:content-[''] after:absolute after:z-[4]";
    }

    $class = 'relative overflow-hidden' . ' ' . $before . ' ' . $after;

    return $class;
}