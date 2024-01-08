<?php

$prefix     = 'block_content_slider';

$slidePrefix     = $prefix . '_slide';
$slideFields = array_merge(getTitleFields($slidePrefix), getContentFields($slidePrefix), getButtonFields($slidePrefix), getImageFields($slidePrefix));


$block_data = [
    'key'    => $prefix,
    'title'  => __('Hero slider', '_SBB'),
    'fields' => [
        [
            'key'          => "{$prefix}_slides_tab",
            'label'        => __('Slides', '_SBB'),
            'name'         => 'slides_tab',
            'type'         => 'accordion',
            'open'         => 0,
            'multi_expand' => 1,
        ],
        [
            'key'          => "{$prefix}_slides_repeater",
            'label'        => __('Slides', '_SBB'),
            'name'         => 'slides_tab_repeater',
            'type'         => 'repeater',
            'sub_fields'   => $slideFields
        ],
        [
            'key'           => "{$prefix}_slider_options",
            'label'         => __('Opties', '_SBB'),
            'name'          => 'slider_options',
            'type'          => 'accordion',
            'open'          => 0,
            'multi_expand'  => 1,
        ],
        [
            'key'           => "{$prefix}_slider_options_full_page",
            'label'         => __('Volledige breedte?', '_SBB'),
            'name'          => 'slider_full_page',
            'type'          => 'true_false',
            'ui'            => 1,
            'default_value' => 0,
        ]
    ],
];

return $block_data;
