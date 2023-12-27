<?php

$prefix     = 'block_single_content_content';
$block_data = [
    'key'    => $prefix,
    'title'  => __('Content', '_SBB'),
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
            'key'     => "{$prefix}_left",
            'label'   => __('Links', '_SBB'),
            'name'    => 'left',
            'type'    => 'group',
            'wrapper' => [
                'width' => '50%',
            ],
            'sub_fields' => [
                [
                    'key'   => "{$prefix}_left_sub_title",
                    'label' => __('Subtitel', '_SBB'),
                    'name'  => 'sub_title',
                    'type'  => 'text',
                ],
                [
                    'key'   => "{$prefix}_left_title",
                    'label' => __('Titel', '_SBB'),
                    'name'  => 'title',
                    'type'  => 'text',
                ],
                [
                    'key'          => "{$prefix}_left_content",
                    'label'        => __('Content', '_SBB'),
                    'name'         => 'content',
                    'type'         => 'wysiwyg',
                    'toolbar'      => 'contentcenter',
                    'tabs'         => 'visual',
                    'media_upload' => false,
                ],
                [
                    'key'        => "{$prefix}_left_buttons",
                    'label'      => __('Knoppen', '_SBB'),
                    'name'       => 'buttons',
                    'type'       => 'repeater',
                    'max'        => 2,
                    'layout'     => 'block',
                    'collapsed'  => "{$prefix}_left_buttons_link",
                    'sub_fields' => [
                        [
                            'key'     => "{$prefix}_left_buttons_link",
                            'name'    => 'link',
                            'label'   => __('Link', '_SBB'),
                            'type'    => 'link',
                            'wrapper' => [
                                'width' => '50%',
                            ],
                        ],
                        [
                            'key'     => "{$prefix}_left_buttons_type",
                            'name'    => 'type',
                            'label'   => __('Stijl', '_SBB'),
                            'type'    => 'select',
                            'choices' => wpb_get_button_types(),
                            'wrapper' => [
                                'width' => '50%',
                            ],
                        ],
                        [
                            'key'     => "{$prefix}_left_buttons_use_icon",
                            'name'    => 'use_icon',
                            'label'   => __('Icoon gebruiken?', '_SBB'),
                            'type'    => 'true_false',
                            'ui'      => true,
                            'wrapper' => [
                                'width' => '30%',
                            ],
                        ],
                        [
                            'key'     => "{$prefix}_left_buttons_icon",
                            'name'    => 'icon',
                            'label'   => __('Icoon', '_SBB'),
                            'type'    => 'GOOGLE_MATERIAL_ICON',
                            'wrapper' => [
                                'width' => '40%',
                            ],
                            'conditional_logic' => [
                                [
                                    [
                                        'field'    => "{$prefix}_left_buttons_use_icon",
                                        'operator' => '==',
                                        'value'    => 1,
                                    ],
                                ],
                            ],
                        ],
                        [
                            'key'     => "{$prefix}_left_buttons_icon_pos",
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
                                        'field'    => "{$prefix}_left_buttons_use_icon",
                                        'operator' => '==',
                                        'value'    => 1,
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'key'     => "{$prefix}_right",
            'label'   => __('Rechts', '_SBB'),
            'name'    => 'right',
            'type'    => 'group',
            'wrapper' => [
                'width' => '50%',
            ],
            'sub_fields' => [
                [
                    'key'   => "{$prefix}_right_sub_title",
                    'label' => __('Subtitel', '_SBB'),
                    'name'  => 'sub_title',
                    'type'  => 'text',
                ],
                [
                    'key'   => "{$prefix}_right_title",
                    'label' => __('Titel', '_SBB'),
                    'name'  => 'title',
                    'type'  => 'text',
                ],
                [
                    'key'          => "{$prefix}_right_content",
                    'label'        => __('Content', '_SBB'),
                    'name'         => 'content',
                    'type'         => 'wysiwyg',
                    'toolbar'      => 'contentcenter',
                    'tabs'         => 'visual',
                    'media_upload' => false,
                ],
                [
                    'key'        => "{$prefix}_right_buttons",
                    'label'      => __('Knoppen', '_SBB'),
                    'name'       => 'buttons',
                    'type'       => 'repeater',
                    'max'        => 2,
                    'layout'     => 'block',
                    'collapsed'  => "{$prefix}_right_buttons_link",
                    'sub_fields' => [
                        [
                            'key'     => "{$prefix}_right_buttons_link",
                            'name'    => 'link',
                            'label'   => __('Link', '_SBB'),
                            'type'    => 'link',
                            'wrapper' => [
                                'width' => '50%',
                            ],
                        ],
                        [
                            'key'     => "{$prefix}_right_buttons_type",
                            'name'    => 'type',
                            'label'   => __('Stijl', '_SBB'),
                            'type'    => 'select',
                            'choices' => wpb_get_button_types(),
                            'wrapper' => [
                                'width' => '50%',
                            ],
                        ],
                        [
                            'key'     => "{$prefix}_right_buttons_use_icon",
                            'name'    => 'use_icon',
                            'label'   => __('Icoon gebruiken?', '_SBB'),
                            'type'    => 'true_false',
                            'ui'      => true,
                            'wrapper' => [
                                'width' => '30%',
                            ],
                        ],
                        [
                            'key'     => "{$prefix}_right_buttons_icon",
                            'name'    => 'icon',
                            'label'   => __('Icoon', '_SBB'),
                            'type'    => 'GOOGLE_MATERIAL_ICON',
                            'wrapper' => [
                                'width' => '40%',
                            ],
                            'conditional_logic' => [
                                [
                                    [
                                        'field'    => "{$prefix}_right_buttons_use_icon",
                                        'operator' => '==',
                                        'value'    => 1,
                                    ],
                                ],
                            ],
                        ],
                        [
                            'key'     => "{$prefix}_right_buttons_icon_pos",
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
                                        'field'    => "{$prefix}_right_buttons_use_icon",
                                        'operator' => '==',
                                        'value'    => 1,
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];

return $block_data;
