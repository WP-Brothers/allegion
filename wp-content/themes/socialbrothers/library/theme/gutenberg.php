<?php

declare(strict_types=1);
defined('ABSPATH') || exit('Forbidden');

function wpb_parse_gutenberg_var(string $var): string
{
    $defaults = [
        '20px'  => 'var(--wp--preset--spacing--20)',
        '40px'  => 'var(--wp--preset--spacing--40)',
        '60px'  => 'var(--wp--preset--spacing--60)',
        '80px'  => 'var(--wp--preset--spacing--80)',
        '120px' => 'var(--wp--preset--spacing--120)',
        '160px' => 'var(--wp--preset--spacing--160)',
    ];

    if (! empty($defaults[$var])) {
        return $defaults[$var];
    }
    if (! str_contains($var, ':')) {
        return $var;
    }

    return str_replace(
        [
            ':',
            '|',
        ],
        [
            '(--wp--',
            '--',
        ],
        $var
    ) . ')';
}

/**
 * Adds the gutenberg default styles.
 */
function wpb_get_block_spacing(array $block, $filter_type = 'all'): string
{
    $spacing = [];
    if (! empty($block['style']['spacing'])) {
        foreach ($block['style']['spacing'] as $type => $places) {
            if ('all' === $filter_type || $type === $filter_type) {
                if (! empty($places)) {
                    foreach ($places as $place => $value) {
                        $spacing[] = "{$type}-{$place}:" . wpb_parse_gutenberg_var($value) . ';';
                    }
                }
            }
        }
    }

    return implode(' ', $spacing);
}

function wpb_get_block_color(array $block): string
{
    $color = '';

    if (! empty($block['style']['color']['text'])) {
        $color = "color: {$block['style']['color']['text']};";
    } elseif (! empty($block['textColor'])) {
        $color = "color: var(--wp--preset--color--{$block['textColor']});";
    }

    return $color;
}

function wpb_get_block_background(array $block): string
{
    $background = '';

    if (! empty($block['style']['color']['background'])) {
        $background = "background-color: {$block['style']['color']['background']};";
    } elseif (! empty($block['backgroundColor'])) {
        $background = "background-color: var(--wp--preset--color--{$block['backgroundColor']});";
    }

    return $background;
}

function wpb_get_block_styles(array $block): string
{
    $attributes = [
        wpb_get_block_spacing($block),
        wpb_get_block_color($block),
        wpb_get_block_background($block),
    ];

    return implode(' ', $attributes);
}

function wpb_get_block_container(string $size): string
{
    $container = 'container';

    if ('wide' === $size) {
        $container = 'container max-container';
    } elseif ('full' === $size) {
        $container = 'px-4 w-full';
    } elseif ('none' === $size) {
        $container = '';
    }

    return $container;
}

function wpb_parse_layout_options(array $layout_options): array
{
    $options = [
        'justifyContent' => [
            'left' => [
                'flex' => 'justify-start',
                'grid' => 'justify-self-start',
            ],
            'space-between' => [
                'flex' => 'justify-between',
                'grid' => 'justify-self-stretch',
            ],
            'center' => [
                'flex' => 'justify-center',
                'grid' => 'justify-self-center',
            ],
            'right' => [
                'flex' => 'justify-end',
                'grid' => 'justify-self-end',
            ],
        ],
        'verticalAlignment' => [
            'top' => [
                'flex' => 'items-start',
                'grid' => 'self-start',
            ],
            'center' => [
                'flex' => 'items-center',
                'grid' => 'self-center',
            ],
            'stretch' => [
                'flex' => 'items-stretch',
                'grid' => 'self-stretch',
            ],
            'bottom' => [
                'flex' => 'items-end',
                'grid' => 'self-end',
            ],
        ],
    ];

    return [
        'align'   => $options['verticalAlignment'][$layout_options['verticalAlignment'] ?? 'center'],
        'justify' => $options['justifyContent'][$layout_options['justifyContent'] ?? 'left'],
    ];
}

/**
 * Allow only our blocks which are located in our theme folder instead of all gutenberg basic blocks.
 *
 * @return array<int,mixed>
 *
 * @throws NotFoundExceptionInterface
 * @throws ContainerExceptionInterface
 */
function wpb_acf_allowed_block_types($_, $block_editor_context): array
{
    $whitelist = apply_filters('wpb_single_blocks_cpt', [
        'post',
        'news',
    ]);

    if (! empty($block_editor_context->post->post_type) && in_array($block_editor_context->post->post_type, $whitelist)) {
        $filter = 'single';
    }
    $allowed = collect(wpb_filter_blocks($filter ?? false))
        ->map(static fn (string $block) => sprintf('acf/%s', $block ?? ''))
        ->filter()
        ->values()
        ->toArray();
    $allowed[] = 'core/block';

    return array_values($allowed);
}

add_filter('allowed_block_types_all', 'wpb_acf_allowed_block_types', 10, 2);

/**
 * @param array<string,string> $attributes The attributes of the block
 *
 * @return array<string,string>
 */
function wpb_acf_pre_save_block(array $attributes): array
{
    if (empty($attributes['id'])) {
        $attributes['id'] = 'block_acf-block-' . uniqid('', true);
    }

    return $attributes;
}

add_filter('acf/pre_save_block', 'wpb_acf_pre_save_block', 10, 1);

/**
 * @param array<array<string, string>> $categories
 *
 * @return array<array<string, string>>
 */
function wpb_block_category(array $categories): array
{
    $categories[] = [
        'slug' => 'sections', 'text' => __('Secties', '_SBB'),
    ];
    $categories[] = [
        'slug' => 'single', 'text' => __('Single', '_SBB'),
    ];

    return $categories;
}

add_filter('block_categories_all', 'wpb_block_category', 10, 1);
