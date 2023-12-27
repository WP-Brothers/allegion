<?php

declare(strict_types=1);

namespace SocialBrothers;

use function add_action;
use function add_filter;
use function add_theme_support;
use function defined;
use function SocialBrothers\Theme\Helpers\service;

defined('ABSPATH') || exit;

/**
 * Disables (Native) auto-update for plugins.
 */
add_filter('auto_update_plugin', '__return_false', 1);

/**
 * This function will add theme support for the given features.
 */
add_action('after_setup_theme', static function (): void {
    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    foreach (service('theme.supports') as $support_args) {
        add_theme_support(...$support_args);
    }
}, 10, 0);

/**
 * This function will allow you to upload SVG images using the WordPress
 * media library.
 */
add_filter('upload_mimes', static function (array $mimes): array {
    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    return array_merge($mimes, service('theme.mimes'));
}, 10, 1);
