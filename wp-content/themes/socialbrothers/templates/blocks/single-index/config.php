<?php

$prefix     = 'block_single_content_index';
$block_data = [
    'key'    => $prefix,
    'title'  => __('Content', '_SBB'),
    'fields' => [
        [
            'key'          => "{$prefix}_index_tab",
            'label'        => __('Content', '_SBB'),
            'name'         => 'content_tab',
            'type'         => 'accordion',
            'open'         => 1,
            'multi_expand' => 1,
        ],
        [
            'key'           => "{$prefix}_title",
            'name'          => 'title',
            'label'         => __('Titel', '_SBB'),
            'type'          => 'text',
            'default_value' => __('Inhoudsopgave', '_SBF'),
        ],
        [
            'key'           => "{$prefix}_icon",
            'name'          => 'icon',
            'label'         => __('Icoon', '_SBB'),
            'type'          => 'GOOGLE_MATERIAL_ICON',
            'default_value' => 'anchor',
        ],
        [
            'key'         => "{$prefix}_anchors",
            'label'       => __('Inhoudsopgave', '_SBB'),
            'name'        => 'anchors',
            'type'        => 'repeater',
            'layout'      => 'block',
            'collapsed'   => "{$prefix}_anchors_title",
            'description' => __('Ankers voor de blokken zijn per blok te vinden in de rechter zijbalk onder de tandwiel->geavanceerd->HTML ANKER', '_SBF'),
            'sub_fields'  => [
                [
                    'key'     => "{$prefix}_anchors_title",
                    'name'    => 'title',
                    'label'   => __('Titel', '_SBB'),
                    'type'    => 'text',
                    'wrapper' => [
                        'width' => '50%',
                    ],
                ],
                [
                    'key'     => "{$prefix}_anchors_anchor",
                    'name'    => 'anchor',
                    'label'   => __('Anker', '_SBB'),
                    'type'    => 'text',
                    'wrapper' => [
                        'width' => '50%',
                    ],
                ],
            ],
        ],
    ],
];

return $block_data;
