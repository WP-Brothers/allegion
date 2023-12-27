<?php

$prefix     = 'block_content-slider';
$block_data = [
    'key'    => $prefix,
    'title'  => __('Content + slider', '_SBB'),
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
            'key'     => "{$prefix}_content_position",
            'name'    => 'content_position',
            'label'   => __('Content positie', '_SBB'),
            'type'    => 'select',
            'choices' => [
                'left'   => __('Links', '_SBB'),
                'right'  => __('Rechts', '_SBB'),
                'hidden' => __('Geen Content', '_SBB'),
            ],
        ],
        [
            'key'   => "{$prefix}_sub_title",
            'label' => __('Subtitel', '_SBB'),
            'name'  => 'sub_title',
            'type'  => 'text',
            'conditional_logic' => [
                [
                    [
                        'field' => "{$prefix}_content_position",
                        'operator' => '!=',
                        'value' => 'hidden',
                    ],
                ],
            ],
        ],
        [
            'key'   => "{$prefix}_title",
            'label' => __('Titel', '_SBB'),
            'name'  => 'title',
            'type'  => 'text',
            'conditional_logic' => [
                [
                    [
                        'field' => "{$prefix}_content_position",
                        'operator' => '!=',
                        'value' => 'hidden',
                    ],
                ],
            ],
        ],
        [
            'key'          => "{$prefix}_content",
            'label'        => __('Tekst', '_SBB'),
            'name'         => 'content',
            'type'         => 'wysiwyg',
            'toolbar'      => 'contentcenter',
            'tabs'         => 'visual',
            'media_upload' => false,
            'conditional_logic' => [
                [
                    [
                        'field' => "{$prefix}_content_position",
                        'operator' => '!=',
                        'value' => 'hidden',
                    ],
                ],
            ],
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
            'conditional_logic' => [
                [
                    [
                        'field' => "{$prefix}_content_position",
                        'operator' => '!=',
                        'value' => 'hidden',
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
            'label'   => __('Slider content opties', '_SBB'),
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

        [
            'key'           => "{$prefix}_slider_options",
            'label'         => __('Slider opties', '_SBB'),
            'name'          => 'slider_options',
            'type'          => 'accordion',
            'open'          => 0,
            'multi_expand'  => 1,
        ],
        [
            'key'     => "{$prefix}_slider_background_image",
            'name'    => 'background_image',
            'label'   => __('Achtergrond afbeelding', '_SBB'),
            'type'    => 'image',
        ],
        [
            'key'     => "{$prefix}_slider_overflow",
            'name'    => 'overflow',
            'label'   => __('Overlappen', '_SBB'),
            'instructions' => __('Laat de slider uit de pagina komen', '_SBB'),
            'type'    => 'true_false',
            'ui'      => true,
        ]
    ],
];

return $block_data;
