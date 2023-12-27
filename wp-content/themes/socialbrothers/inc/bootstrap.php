<?php

/** @noinspection PhpFullyQualifiedNameUsageInspection */

declare(strict_types=1);

namespace SocialBrothers;

use RuntimeException;
use SocialBrothers\Theme\Ignition\WPBIgnition;

use function class_exists;
use function define;
use function defined;
use function function_exists;
use function get_option;
use function is_file;
use function parse_url;
use function pathinfo;
use function preg_match;
use function wp_die;

use const ABSPATH;
use const E_DEPRECATED;
use const E_USER_DEPRECATED;
use const PATHINFO_EXTENSION;
use const PHP_URL_HOST;

(static function (): void {
    try {
        /**
         * Conditionally load composers autoload.php, based on its location.
         * Which could be either:
         * In the plugin root during local development.
         * In the WordPress root when installed as wp plugin through composer.
         *
         * @throws RuntimeException
         */
        (static function (): void {
            $path = ABSPATH;

            if (is_file($path .= 'vendor/autoload.php')) {
                include_once $path;

                return;
            }

            throw new RuntimeException('Couldn\'t find autoload.php, make sure you have run `composer install`.');
        })();
    } catch (RuntimeException $e) {
        if (! defined('ABSPATH') || ! function_exists('wp_die')) {
            throw $e;
        }

        /** @noinspection ForgottenDebugOutputInspection */
        wp_die($e->getMessage());
    }

    /**
     * Sets 'WP_ENV' constant based on the current url.
     * Checks the domain extension either of the following will be considered development:
     * - `.local` for LocalWP
     * - `.test` for `laravel/valet`.
     *
     * @see https://localwp.com/
     * @see https://laravel.com/docs/9.x/valet
     */
    if (defined('ABSPATH') && (! defined('WP_ENV') || ! defined('WP_ENVIRONMENT_TYPE'))) {
        $env = (static function (): string {
            $extension = pathinfo(
                parse_url(get_option('siteurl', ''), PHP_URL_HOST),
                PATHINFO_EXTENSION
            );

            return 1 === preg_match('/^(test|local)$/D', $extension)
                ? 'development'
                : 'production';
        })();

        if (! defined('WP_ENV')) {
            define('WP_ENV', $env);
        }

        if (! defined('WP_ENVIRONMENT_TYPE')) {
            define('WP_ENVIRONMENT_TYPE', $env);
        }
    }

    if (WP_ENV === 'development' && class_exists(\Spatie\Ignition\Ignition::class)) {
        WPBIgnition::make()->register()->setIgnoreSeverity(
            /**
             * Set severity levels to ignore.
             *
             * Expects an array of severity level constants.
             * See {@link https://www.php.net/manual/en/errorfunc.constants.php} for severity level constants.
             *
             * @hook wp_sb_starter_error_reporting_ignore
             */
            apply_filters('wp_sb_starter_error_reporting_ignore', [
                E_DEPRECATED,
                E_USER_DEPRECATED,
            ])
        );
    }
})();
