<?php

$prefix     = 'block_cards';
$block_data = [
    'key'    => $prefix,
    'title'  => __('Content kaarten', '_SBB'),
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
            'key'   => "{$prefix}_title",
            'label' => __('Titel', '_SBB'),
            'name'  => 'title',
            'type'  => 'text',
        ],
        [
            'key'        => "{$prefix}_cards",
            'label'      => __('Kaarten', '_SBB'),
            'name'       => 'cards',
            'type'       => 'repeater',
            'layout'     => 'block',
            'collapsed'  => "{$prefix}_cards_title",
            'sub_fields' => [
                [
                    'key'     => "{$prefix}_cards_type",
                    'label'   => __('type', '_SBB'),
                    'name'    => 'type',
                    'type'    => 'select',
                    'choices' => [
                        'nostyle'   => __('Geen kleur', '_SBB'),
                        'white'     => __('Wit', '_SBB'),
                        'primary'   => __('Primair', '_SBB'),
                        'secondary' => __('Secondair', '_SBB'),
                        'cta'       => __('Cta', '_SBB'),
                    ],
                ],
                [
                    'key'   => "{$prefix}_cards_icon",
                    'name'  => 'icon',
                    'label' => __('Icoon', '_SBB'),
                    'type'  => 'GOOGLE_MATERIAL_ICON',
                ],
                [
                    'key'   => "{$prefix}_cards_title",
                    'name'  => 'title',
                    'label' => __('Titel', '_SBB'),
                    'type'  => 'text',
                ],
                [
                    'key'   => "{$prefix}_cards_text",
                    'name'  => 'text',
                    'label' => __('Tekst', '_SBB'),
                    'type'  => 'textarea',
                ],
                [
                    'key'        => "{$prefix}_cards_button",
                    'label'      => __('Knop', '_SBB'),
                    'name'       => 'button',
                    'type'       => 'group',
                    'layout'     => 'block',
                    'collapsed'  => "{$prefix}_cards_button_link",
                    'sub_fields' => [
                        [
                            'key'     => "{$prefix}_cards_button_link",
                            'name'    => 'link',
                            'label'   => __('Link', '_SBB'),
                            'type'    => 'link',
                            'wrapper' => [
                                'width' => '50%',
                            ],
                        ],
                        [
                            'key'     => "{$prefix}_cards_button_type",
                            'name'    => 'type',
                            'label'   => __('Stijl', '_SBB'),
                            'type'    => 'select',
                            'choices' => wpb_get_button_types(),
                            'wrapper' => [
                                'width' => '50%',
                            ],
                        ],
                        [
                            'key'     => "{$prefix}_cards_button_use_icon",
                            'name'    => 'use_icon',
                            'label'   => __('Icoon gebruiken?', '_SBB'),
                            'type'    => 'true_false',
                            'ui'      => true,
                            'wrapper' => [
                                'width' => '30%',
                            ],
                        ],
                        [
                            'key'     => "{$prefix}_cards_button_icon",
                            'name'    => 'icon',
                            'label'   => __('Icoon', '_SBB'),
                            'type'    => 'GOOGLE_MATERIAL_ICON',
                            'wrapper' => [
                                'width' => '40%',
                            ],
                            'conditional_logic' => [
                                [
                                    [
                                        'field'    => "{$prefix}_cards_button_use_icon",
                                        'operator' => '==',
                                        'value'    => 1,
                                    ],
                                ],
                            ],
                        ],
                        [
                            'key'     => "{$prefix}_cards_button_icon_pos",
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
                                        'field'    => "{$prefix}_cards_button_use_icon",
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
