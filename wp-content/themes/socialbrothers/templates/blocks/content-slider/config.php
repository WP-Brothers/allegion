<?php

$prefix     = 'block_content-slider';
$block_data = [
    'key'    => $prefix,
    'title'  => __('Content + nieuws slider', '_SBB'),
    'fields' => [
        [
            'key'          => "{$prefix}_content_tab",
            'label'        => __('Content', '_SBB'),
            'name'         => 'content_tab',
            'type'         => 'accordion',
            'open'         => 1,
            'multi_expand' => 1,
        ],
        [
            'key'   => "{$prefix}_sub_title",
            'label' => __('Subtitel', '_SBB'),
            'name'  => 'sub_title',
            'type'  => 'text',
        ],
        [
            'key'   => "{$prefix}_title",
            'label' => __('Titel', '_SBB'),
            'name'  => 'title',
            'type'  => 'text',
        ],
        [
            'key'          => "{$prefix}_content",
            'label'        => __('Tekst', '_SBB'),
            'name'         => 'content',
            'type'         => 'wysiwyg',
            'toolbar'      => 'contentcenter',
            'tabs'         => 'visual',
            'media_upload' => false,
        ],
        [
            'key'          => "{$prefix}_buttons",
            'label'        => __('Knoppen', '_SBB'),
            'name'         => 'buttons',
            'button_label' => __('Nieuwe Button', '_SBB'),
            'type'         => 'repeater',
            'max'          => 2,
            'layout'       => 'block',
            'collapsed'    => "{$prefix}_buttons_link",
            'sub_fields'   => [
                [
                    'key'     => "{$prefix}_buttons_link",
                    'name'    => 'link',
                    'label'   => __('Link', '_SBB'),
                    'type'    => 'link',
                    'wrapper' => [
                        'width' => '50%',
                    ],
                ],
                [
                    'key'     => "{$prefix}_buttons_type",
                    'name'    => 'type',
                    'label'   => __('Stijl', '_SBB'),
                    'type'    => 'select',
                    'choices' => wpb_get_button_types(),
                    'wrapper' => [
                        'width' => '50%',
                    ],
                ],
                [
                    'key'     => "{$prefix}_buttons_use_icon",
                    'name'    => 'use_icon',
                    'label'   => __('Icoon gebruiken?', '_SBB'),
                    'type'    => 'true_false',
                    'ui'      => true,
                    'wrapper' => [
                        'width' => '30%',
                    ],
                ],
                [
                    'key'     => "{$prefix}_buttons_icon",
                    'name'    => 'icon',
                    'label'   => __('Icoon', '_SBB'),
                    'type'    => 'GOOGLE_MATERIAL_ICON',
                    'wrapper' => [
                        'width' => '40%',
                    ],
                    'conditional_logic' => [
                        [
                            [
                                'field'    => "{$prefix}_buttons_use_icon",
                                'operator' => '==',
                                'value'    => 1,
                            ],
                        ],
                    ],
                ],
                [
                    'key'     => "{$prefix}_buttons_icon_pos",
                    'name'    => 'icon_pos',
                    'label'   => __('Icoon Rechts?', '_SBB'),
                    'type'    => 'true_false',
                    'ui'      => true,
                    'wrapper' => [
                        'width' => '30%',
                    ],
                    'conditional_logic' => [
                        [
                            [
                                'field'    => "{$prefix}_buttons_use_icon",
                                'operator' => '==',
                                'value'    => 1,
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'key'          => "{$prefix}_slider_tab",
            'label'        => __('Slider content', '_SBB'),
            'name'         => 'slider_tab',
            'type'         => 'accordion',
            'open'         => 0,
            'multi_expand' => 1,
        ],
        [
            'key'     => "{$prefix}_slider_content_option",
            'label'   => __('Slder content opties', '_SBB'),
            'name'    => 'content_option',
            'type'    => 'select',
            'choices' => [
                'post_type' => __('Post type kiezen', '_SBF'),
                'custom'    => __('zelf kiezen kiezen', '_SBF'),
            ],
        ],
        [
            'key'     => "{$prefix}_post_type",
            'name'    => 'post_type',
            'label'   => __('Post type', '_SBB'),
            'type'    => 'select',
            'choices' => [
                'news' => __('Nieuws', '_SBF'),
            ],
            'conditional_logic' => [
                [
                    [
                        'field'    => "{$prefix}_slider_content_option",
                        'operator' => '==',
                        'value'    => 'post_type',
                    ],
                ],
            ],
        ],

        [
            'key'           => "{$prefix}_posts",
            'name'          => 'posts',
            'label'         => __('Berichten', '_SBB'),
            'type'          => 'relationship',
            'retrun_format' => 'id',
            'post_type'     => [
                'news',
            ],
            'conditional_logic' => [
                [
                    [
                        'field'    => "{$prefix}_slider_content_option",
                        'operator' => '==',
                        'value'    => 'custom',
                    ],
                ],
            ],
        ],
    ],
];

return $block_data;
