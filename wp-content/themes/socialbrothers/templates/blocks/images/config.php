<?php

$prefix     = 'block_images';
$block_data = [
    'key'    => $prefix,
    'fields' => [
        [
            'key'          => "{$prefix}_content_tab",
            'label'        => __('Afbeeldingen', '_SBB'),
            'name'         => 'content_tab',
            'type'         => 'accordion',
            'open'         => 1,
            'multi_expand' => 1,
        ],
        [
            'key'           => "{$prefix}_images",
            'label'         => __('Afbeedlingen', '_SBB'),
            'name'          => 'images',
            'type'          => 'gallery',
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
            'key'     => "{$prefix}_grid",
            'name'    => 'grid',
            'label'   => __('Afbeelding ratio', '_SBB'),
            'type'    => 'select',
            'choices' => [
                'grid-cols-2'                => __('2 naast elkaar', '_SBB'),
                'grid-cols-2 md:grid-cols-3' => __('3 naast elkaar', '_SBB'),
                'grid-cols-2 md:grid-cols-4' => __('4 naast elkaar', '_SBB'),
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
