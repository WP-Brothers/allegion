<?php

$prefix     = 'block_carousel';
$block_data = [
    'key'    => $prefix,
    'title'  => __('Carousel', '_SBB'),
    'fields' => [
        [
            'key'          => "{$prefix}_carousel_tab",
            'label'        => __('Carousel', '_SBB'),
            'name'         => 'carousel_tab',
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
            'key'           => "{$prefix}_carousel_options",
            'label'         => __('carousel opties', '_SBB'),
            'name'          => 'carousel_options',
            'type'          => 'accordion',
            'open'          => 0,
            'multi_expand'  => 1,
        ],
        [
            'key'           => "{$prefix}_carousel_options_full_page",
            'label'         => __('carousel full page', '_SBB'),
            'name'          => 'carousel_full_page',
            'type'          => 'true_false',
            'ui'            => 1,
            'default_value' => 0,
        ]
    ],
];

return $block_data;
