<?php

$prefix     = 'block_single_notice';
$block_data = [
    'key'    => $prefix,
    'title'  => __('Meldingen', '_SBB'),
    'fields' => [
        [
            'key'          => "{$prefix}_notices_tab",
            'label'        => __('Meldingen', '_SBB'),
            'name'         => 'notices_tab',
            'type'         => 'accordion',
            'open'         => 1,
            'multi_expand' => 1,
        ],
        [
            'key'        => "{$prefix}_notices",
            'label'      => __('Meldingen', '_SBB'),
            'name'       => 'notices',
            'type'       => 'repeater',
            'layout'     => 'block',
            'collapsed'  => "{$prefix}_notices_title",
            'sub_fields' => [
                [
                    'key'   => "{$prefix}_notices_title",
                    'name'  => 'title',
                    'label' => __('Titel', '_SBB'),
                    'type'  => 'text',
                ],
                [
                    'key'       => "{$prefix}_notices_content",
                    'label'     => __('Content', '_SBB'),
                    'name'      => 'content',
                    'type'      => 'textarea',
                    'new_lines' => 'br',
                ],
                [
                    'key'     => "{$prefix}_notices_type",
                    'name'    => 'type',
                    'label'   => __('Stijl', '_SBB'),
                    'type'    => 'select',
                    'choices' => [
                        'notice'  => __('Melding(Blauw)', '_SBF'),
                        'succes'  => __('Succes(Groen)', '_SBF'),
                        'warning' => __('Waarschuwing(geel)', '_SBF'),
                        'error'   => __('Error(Rood)', '_SBF'),
                    ],
                ],
                [
                    'key'   => "{$prefix}_notices_use_alt_icon",
                    'name'  => 'use_alt_icon',
                    'label' => __('Alt icoon gebruiken?', '_SBB'),
                    'type'  => 'true_false',
                    'ui'    => true,
                ],
                [
                    'key'               => "{$prefix}_notice_alt_icon",
                    'name'              => 'alt_icon',
                    'label'             => __('Alt icoon', '_SBB'),
                    'type'              => 'GOOGLE_MATERIAL_ICON',
                    'conditional_logic' => [
                        [
                            [
                                'field'    => "{$prefix}_notices_use_alt_icon",
                                'operator' => '==',
                                'value'    => 1,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];

return $block_data;
