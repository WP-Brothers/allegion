<?php

declare(strict_types=1);

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use SocialBrothers\Theme\Bootstrap\Loader\ThemeFileLoader;
use SocialBrothers\Theme\Helper\Theme;
use SocialBrothers\Theme\Helper\Twig;
use SocialBrothers\Vite\ViteService;

use function SocialBrothers\Theme\Helpers\service;

defined('ABSPATH') || exit;

/**
 * Load the Composer autoloader based on vendor location.
 *
 * Throws exception when autoload.php doesn't exist.
 * Vendor location differs between being in local development or,
 * installed in the SB starter theme environment.
 *
 * @throws RuntimeException
 *
 * @see https://social-brothers.gitbook.io/socialbrothers/
 * @see https://getcomposer.org/doc/01-basic-usage.md#autoloading
 * @see https://www.php-fig.org/psr/psr-4/
 */
require_once __DIR__ . '/inc/bootstrap.php';

if (!defined('THEME_PACKAGE_NAME')) {
    define('THEME_PACKAGE_NAME', 'sb-starter-theme');
}

if (!defined('DISALLOW_FILE_EDIT')) {
    define('DISALLOW_FILE_EDIT', true);
}

/**
 * Load required php function scripts.
 *
 * Use filter: `wp_sb_starter_include_function_directories` to add php function directories.
 * Use filter: `wp_sb_starter_include_function_recursive` to change the $recursive parameter, which defaults to false.
 *
 * In extreme cases you can create your own custom FileLoader class by implementing
 * `SocialBrothers\Starter\Bootstrap\Loader\FileLoaderInterface`.
 *
 * Filter callable arguments: `array $directories`
 * Expects return value of type `array`.
 * Passes: 'library/', by default.
 *
 * @see FileLoaderInterface
 */
if (!function_exists('sb_starter_load_theme_includes')) {
    function sb_starter_load_theme_includes(): void
    {
        ThemeFileLoader::createFileLoader(
            get_template_directory(),
            apply_filters('wp_sb_starter_include_function_directories', ['library']),
            apply_filters('wp_sb_starter_include_function_recursive', true)
        );
    }
}

// Load theme includes, see function docs for further explanation on how to extend default values.
add_action('wp_sb_starter_load_theme_library', 'sb_starter_load_theme_includes', 10);

/*
 * Hook: wp_sb_starter_load_theme_library
 * Fired when bootstrap.php and theme constants are loaded.
 *
 * @hooked sb_starter_load_theme_includes - 10
 */
do_action('wp_sb_starter_load_theme_library');

/**
 * Print bundle scripts, defined in 'vite.entries' in config/vite-config.php.
 *
 * @throws Exception
 *
 * @see ViteInterface
 */
function wpb_vite_init(): void
{
    try {
        $vite = service(ViteService::class);
    } catch (NotFoundExceptionInterface | ReflectionException | ContainerExceptionInterface $e) {
        if (!Theme::isDebug()) {
            error_log($e->getMessage());

            return;
        }

        throw $e;
    }

    $vite->init();
}

add_action('wp_head', 'wpb_vite_init');

/**
 * Same as sb_vite_init, but only loads scripts when on edit.php pages.
 *
 * @see ViteInterface
 */
function sb_vite_admin_init(): void
{
    if ('post' !== get_current_screen()->base) {
        return;
    }

    try {
        wpb_vite_init();
    } catch (Exception $e) {
        /**
         * `error_log`, will automatically log to WPEngine's error log (when used in a WPEngine environment).
         *
         * @see          error_log()
         * @see https://wpengine.com/support/troubleshoot-wordpress-wp-engine-error-log/
         *
         * @noinspection ForgottenDebugOutputInspection
         */
        error_log($e->getMessage());
    }
}

add_action('admin_head', 'sb_vite_admin_init');

if (!function_exists('render_twig')) {
    /**
     * @param array<string, mixed> $context
     *
     * @return string|void
     *
     * @throws ReflectionException
     * @throws ContainerExceptionInterface|NotFoundExceptionInterface
     */
    function render_twig(string $template, array $context = [], bool $return_string = false)
    {
        if ($return_string) {
            return Twig::renderString($template, $context);
        }

        Twig::render($template, $context);
    }
}

/**
 * Adds one or more classes to the body tag in the dashboard.
 *
 * @see https://developer.wordpress.org/reference/hooks/admin_body_class/
 */
function wpb_admin_body_class(string $classes): string
{
    return "{$classes} sb_body";
}

add_filter('admin_body_class', 'wpb_admin_body_class');
function wpb_frontend_admin_bar_sticky()
{
    if (is_admin_bar_showing() && !empty(get_option('options_header-class'))) {
        echo '<style>.'
            . esc_attr(get_option('options_header-class')) . '{
  margin-top: 32px;

  @media (width <= 782px) {
    margin-top: 46px;
  }
}
</style>';
    }
}

add_filter('init', 'wpb_frontend_admin_bar_sticky');

add_filter('wpseo_breadcrumb_links', 'wpb_breadcrumbs');

function wpb_breadcrumbs($links)
{
    $links[0]['text'] = '<span class="font-icon">house</span>';
    return $links;
};

// ? Add custom field to Gravity Forms checkbox
if (class_exists('GF_Field')) {
    class TrueFalse extends GF_Field {
        public $type = 'true_false';

        public function get_form_editor_field_title() {
            return esc_attr__( 'True/False', 'gravityforms' );
        }

        public function get_form_editor_field_settings() {
            return array(
                'label_setting',
                'description_setting',
                'rules_setting',
                'css_class_setting',
            );
        }

        public function is_conditional_logic_supported() {
            return true;
        }

        public function get_field_input( $form, $value = '', $entry = null ) {
            $form_id  = $form['id'];
            $id       = intval( $this->id );
            $field_id = 'input_' . $form_id . "_$id";

            $html = '<div class="ginput_container ginput_container_true-false">';
            $html .= sprintf( '<input name="input_%s" id="%s" type="checkbox" class="true_false" %s />', $id, $field_id, checked( $value, true, false ) );
            $html .= sprintf( '<label for="%s" id="%s_label">%s</label>', $field_id, $field_id, $this->label );
            $html .= '</div>';

            return $html;
        }
    }

    GF_Fields::register(new TrueFalse());
}

