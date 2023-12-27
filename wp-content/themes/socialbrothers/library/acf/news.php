<?php

declare(strict_types=1);

add_action('acf/init', function () {
    $taxonomy = 'category_news';
    acf_add_local_field_group([
        'key'    => "{$taxonomy}_settings",
        'title'  => __('Categorie instellingen', '_SBB'),
        'fields' => [
            [
                'key'           => "{$taxonomy}_type",
                'label'         => __('type label', '_SBB'),
                'name'          => 'type',
                'type'          => 'select',
                'default_value' => 'secondary',
                'choices'       => [
                    'primary'           => __('Primair', '_SBB'),
                    'primary-outline'   => __('Primair licht', '_SBB'),
                    'secondary'         => __('Secondair', '_SBB'),
                    'secondary-outline' => __('Secondair licht', '_SBB'),
                    'cta'               => __('Cta', '_SBB'),
                    'cta-outline'       => __('Cta licht', '_SBB'),
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'taxonomy',
                    'operator' => '==',
                    'value'    => $taxonomy,
                ],
            ],
        ],
        'menu_order'            => 0,
        'position'              => 'normal',
        'style'                 => '',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
        'active'                => true,
    ]);

    acf_add_options_page([
        'page_title' => __('Nieuws instellingen', '_SBB'),
        'menu_title' => __('Instellingen', '_SBB'),
        'parent'     => 'edit.php?post_type=news',
        'menu_slug'  => 'news_settings',
    ]);

    $prefix = 'news_setting';

    acf_add_local_field_group([
        'key'    => $prefix,
        'title'  => __('Nieuws instellingen', '_SBB'),
        'fields' => [
            [
                'name'      => "{$prefix}_archive_tab",
                'key'       => "{$prefix}_archive_tab",
                'type'      => 'tab',
                'label'     => __('Archief', '_SBB'),
                'placement' => 'left',
            ],
            [
                'key'   => "{$prefix}_archive_title",
                'name'  => "{$prefix}_archive_title",
                'type'  => 'text',
                'label' => __('Titel', '_SBB'),
            ],
            [
                'key'          => "{$prefix}_archive_content",
                'name'         => "{$prefix}_archive_content",
                'type'         => 'wysiwyg',
                'toolbar'      => 'contentcenter',
                'tabs'         => 'visual',
                'media_upload' => false,
                'label'        => __('Tekst', '_SBB'),
            ],
            [
                'key'           => "{$prefix}_archive_highlight",
                'name'          => "{$prefix}_archive_highlight",
                'label'         => __('Uitgelicht bericht', '_SBB'),
                'type'          => 'post_object',
                'post_type'     => ['news'],
                'return_format' => 'id',
            ],
            [
                'key'           => "{$prefix}_archive_filters",
                'name'          => "{$prefix}_archive_filters",
                'label'         => __('Filters', '_SBB'),
                'type'          => 'taxonomy',
                'taxonomy'      => $taxonomy,
                'field_type'    => 'checkbox',
                'return_format' => 'object',
            ],
            [
                'name'      => "{$prefix}_single_tab",
                'key'       => "{$prefix}_single_tab",
                'type'      => 'tab',
                'label'     => __('Bericht pagina', '_SBB'),
                'placement' => 'left',
            ],
            [
                'label'      => __('Bericht andere berichten content', '_SBB'),
                'name'       => "{$prefix}_single_other_posts",
                'key'        => "{$prefix}_single_other_posts",
                'type'       => 'group',
                'sub_fields' => [
                    [
                        'key'   => "{$prefix}_single_other_posts_sub_title",
                        'name'  => 'sub_title',
                        'type'  => 'text',
                        'label' => __('Subtitel', '_SBB'),
                    ],
                    [
                        'key'   => "{$prefix}_single_other_posts_title",
                        'name'  => 'title',
                        'type'  => 'text',
                        'label' => __('Titel', '_SBB'),
                    ],
                    [
                        'key'          => "{$prefix}_single_other_posts_content",
                        'name'         => 'content',
                        'type'         => 'wysiwyg',
                        'toolbar'      => 'contentcenter',
                        'tabs'         => 'visual',
                        'media_upload' => false,
                        'label'        => __('Teskt', '_SBB'),
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'news_settings',
                ],
            ],
        ],
    ]);
});
