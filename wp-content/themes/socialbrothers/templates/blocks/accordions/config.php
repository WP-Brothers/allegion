<?php

$prefix     = 'block_accordions';
$block_data = [
    'key'    => $prefix,
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
            'key'   => "{$prefix}_heading_type",
            'label' => __('Titel Type', '_SBB'),
            'name'  => 'heading_type',
            'type'  => 'select',
            'choices' => [
                'h1' => 'H1',
                'h2' => 'H2 (default)',
                'h3' => 'H3',
                'h4' => 'H4',
                'h5' => 'H5',
                'h6' => 'H6',
            ],
        ],
        [
            'key'        => "{$prefix}_accordions",
            'label'      => __('Accordions', '_SBB'),
            'name'       => 'accordions',
            'type'       => 'repeater',
            'layout'     => 'block',
            'collapsed'  => "{$prefix}_accordions_title",
            'sub_fields' => [
                [
                    'key'   => "{$prefix}_accordions_title",
                    'name'  => 'title',
                    'label' => __('Titel', '_SBB'),
                    'type'  => 'text',
                ],
                [
                    'key'          => "{$prefix}_accordions_content",
                    'name'         => 'content',
                    'label'        => __('Inhoud', '_SBB'),
                    'type'         => 'wysiwyg',
                    'toolbar'      => 'contentcenter',
                    'tabs'         => 'visual',
                    'media_upload' => false,
                ],
            ],
        ],
    ],
];

return $block_data;
