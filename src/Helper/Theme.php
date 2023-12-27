<?php

declare(strict_types=1);

namespace SocialBrothers\Theme\Helper;

use function defined;
use function function_exists;

use const THEME_PACKAGE_NAME;
use const WP_DEBUG;

final class Theme
{
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
    public static function filter(string $hook_name, mixed $value): mixed
    {
        if (! function_exists('apply_filters')) {
            return $value;
        }

        return apply_filters(THEME_PACKAGE_NAME . "_{$hook_name}", $value);
    }

    public static function addFilter(string $hook_name, callable $callback, int $priority = 10, int $accepted_args = 0): void
    {
        if (! function_exists('add_filter')) {
            return;
        }

        add_filter($hook_name, $callback, $priority, $accepted_args);
    }

    public static function isDebug(): bool
    {
        return defined('WP_DEBUG') && WP_DEBUG;
    }
}
