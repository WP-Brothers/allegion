<?php

$prefix     = 'block_image';
$block_data = [
    'key'    => $prefix,
    'title'  => __('Afbeelding', '_SBB'),
    'fields' => [
        [
            'key'          => "{$prefix}_content_tab",
            'label'        => __('Afbeelding', '_SBB'),
            'name'         => 'content_tab',
            'type'         => 'accordion',
            'open'         => 1,
            'multi_expand' => 1,
        ],
        [
            'key'           => "{$prefix}_image",
            'label'         => __('Afbeedling', '_SBB'),
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
            'key'           => "{$prefix}_media_cutoff",
            'label'         => __('Media cutoff', '_SBB'),
            'name'          => 'media_cutoff',
            'type'          => 'true_false',
            'ui'            => '1',
        ],
    ],
];

return $block_data;
