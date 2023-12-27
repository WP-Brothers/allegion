<?php

declare(strict_types=1);

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use SocialBrothers\Theme\Exception\Container\Config\MissingConfigKeyException;
use SocialBrothers\Theme\Helper\Theme;
use SocialBrothers\Theme\Helper\Twig;

use function SocialBrothers\Theme\Helpers\service;

defined('ABSPATH') || exit('Forbidden');

/**
 * @throws MissingConfigKeyException
 */
function wpb_block_path(string $block, string $filename = ''): string
{
    try {
        $block_root = service('wp.block.root');
    } catch (Exception|NotFoundExceptionInterface|ContainerExceptionInterface $e) {
        throw new MissingConfigKeyException('wp.block.root', 'themes/socialbrothers/config/gutenberg-config.php', $e->getCode(), $e);
    }

    return sprintf('%s/%s/%s', $block_root, $block, $filename);
}

/**
 * Get all custom gutenberg blocks.
 *
 * @return array<string>
 */
function wpb_get_custom_blocks(): array
{
    return service('wp.block.custom-entries') ?? [];
}

/**
 * @throws ContainerExceptionInterface|NotFoundExceptionInterface
 */
function wbp_register_acf_blocks(): void
{
    $block_names = wpb_get_custom_blocks();
    $blocks      = get_template_directory() . '/templates/blocks/';
    foreach ($block_names as $folder_name) {
        $block_folder = $blocks . $folder_name;
        $config_path  = "{$block_folder}/config.php";
        register_block_type($block_folder, ['render_callback' => 'wpb_acf_block_render_callback']);
        if (file_exists($config_path)) {
            wbp_register_acf_blocks_fields(include $config_path ?? [], $folder_name);
        }
    }
}
add_action('acf/init', 'wbp_register_acf_blocks', 100);

function wbp_register_acf_blocks_fields(array $block_data, string $folder_name): void
{
    // $block_data = include $block_data;
    if (! is_array($block_data)) {
        return;
    }

    $block_data['location'] = [
        [
            [
                'param'    => 'block',
                'operator' => '==',
                'value'    => "acf/{$folder_name}",
            ],
        ],
    ];

    if (! function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group($block_data);
}

function wpb_acf_block_render_callback(array $block): void
{
    if (! function_exists('get_field')) {
        return;
    }

    $context         = get_fields() ?? [];
    $block_slug      = str_replace('acf/', '', $block['name']);
    $view            = wpb_block_path($block_slug, 'view.twig');
    $context_options = wpb_block_path($block_slug, 'context.php');
    if (! file_exists($view)) {
        return;
    }

    if (file_exists($context_options)) {
        include_once $context_options;
    }

    if (! empty($block['id'])) {
        $context['id'] = $block['id'];
    }

    $container = '';

    if (! empty($block['category']) && 'single' === $block['category']) {
        $container = 'none';
    } elseif (! empty($block['align'])) {
        $container = $block['align'];
    }
    $context['style']       = wpb_get_block_styles($block ?? false);
    $context['margin']      = wpb_get_block_spacing($block ?? false, 'margin');
    $context['padding']     = wpb_get_block_spacing($block ?? false, 'padding');
    $context['color']       = wpb_get_block_color($block ?? false);
    $context['background']  = wpb_get_block_background($block ?? false);
    $context['container']   = wpb_get_block_container($container);
    $context['layout']      = wpb_parse_layout_options($block['layout'] ?? []);
    $context['orientation'] = $block['layout']['orientation'] ?? 'horizontal';
    $context['anchor']      = $block['anchor'] ?? '';
    $context['id']          = $block['id'] ?? '';
    $context['first_block'] = $block['id'] === wpb_first_block_id();
    $context['is_admin']    = is_admin();

    try {
        Twig::render($block_slug . '/view.twig', apply_filters("wpb_twig_{$block_slug}_context", $context));
    } catch (NotFoundExceptionInterface|ContainerExceptionInterface|ReflectionException $e) {
        if (Theme::isDebug()) {
            throw $e;
        }

        error_log($e->getMessage());
    }
}

function wpb_filter_blocks(string|bool $filter = false): array
{
    $block_names     = wpb_get_custom_blocks();
    $blocks          = get_template_directory() . '/templates/blocks/';
    $filtered_blocks = [];
    foreach ($block_names as $folder_name) {
        $block_folder = $blocks . $folder_name;
        $config_path  = "{$block_folder}/block.json";
        $block        = json_decode(file_get_contents($config_path));
        if ((! $filter && 'single' !== $block->category) || $filter === $block->category) {
            $filtered_blocks[] = $folder_name;
        }
    }

    return $filtered_blocks;
}

// disables base gutenberg layout styles
add_theme_support('disable-layout-styles');
