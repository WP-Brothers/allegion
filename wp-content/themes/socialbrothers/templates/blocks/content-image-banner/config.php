<?php

$prefix     = 'block_content-image-banner';
$block_data = [
    'key'    => $prefix,
    'title'  => __('Content + afbeedling abnner', '_SBB'),
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
            'layout'       => 'block',
            'max'          => 2,
            'collapsed'    => "{$prefix}_buttons_link",
            'sub_fields'   => [
                [
                    'key'   => "{$prefix}_buttons_link",
                    'name'  => 'link',
                    'label' => __('link', '_SBB'),
                    'type'  => 'link',
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
            'key'          => "{$prefix}_image_tab",
            'label'        => __('Afbeedling', '_SBB'),
            'name'         => 'image_tab',
            'type'         => 'accordion',
            'open'         => 0,
            'multi_expand' => 1,
        ],
        [
            'key'           => "{$prefix}_image_id",
            'label'         => __('Afbeelding', '_SBB'),
            'name'          => 'image_id',
            'type'          => 'image',
            'return_format' => 'id',
        ],
        [
            'key'     => "{$prefix}_ratio",
            'name'    => 'ratio',
            'label'   => __('Afbeelding ratio', '_SBB'),
            'type'    => 'select',
            'choices' => [
                ''                           => __('Vrij', '_SBB'),
                'aspect-square object-cover' => __('1/1 (vierkant)', '_SBB'),
                'aspect-video object-cover'  => __('16/9(video)', '_SBB'),
                'aspect-4/3 object-cover'    => __('4/3', '_SBB'),
                'aspect-3/4 object-cover'    => __('3/4', '_SBB'),
            ],
        ],
        [
            'key'          => "{$prefix}_media_cutoff",
            'label'        => __('Media cutoff', '_SBB'),
            'name'         => 'media_cutoff',
            'type'         => 'true_false',
            'ui'           => 1,
        ]
    ],
];

return $block_data;
