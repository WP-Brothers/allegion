<?php

$prefix     = 'block_video';
$block_data = [
    'key'    => $prefix,
    'title'  => __('Video', '_SBB'),
    'fields' => [
        [
            'key'          => "{$prefix}_content_tab",
            'label'        => __('Video', '_SBB'),
            'name'         => 'content_tab',
            'type'         => 'accordion',
            'open'         => 1,
            'multi_expand' => 1,
        ],
        [
            'key'           => "{$prefix}_video_type",
            'name'          => 'video_type',
            'type'          => 'true_false',
            'label'         => __('Video type'),
            'ui'            => 'true',
            'ui_on_text'    => __('Embed', '_SBB'),
            'ui_off_text'   => __('Upload', '_SBB'),
            'default_value' => 1,
        ],

        [
            'key'               => "{$prefix}_embed_video",
            'name'              => 'embed_video',
            'label'             => __('Embed video', '_SBB'),
            'type'              => 'oembed',
            'conditional_logic' => [
                [
                    [
                        'field'    => 'field_video_video_type',
                        'operator' => '!=',
                        'value'    => false,
                    ],
                ],
            ],
        ],
        [
            'key'               => "{$prefix}_video",
            'name'              => 'video',
            'label'             => __('Video', '_SBB'),
            'type'              => 'file',
            'mime_types'        => 'mp4',
            'return_format'     => 'id',
            'conditional_logic' => [
                [
                    [
                        'field'    => 'field_video_video_type',
                        'operator' => '==',
                        'value'    => false,
                    ],
                ],
            ],
        ],
        [
            'key'               => "{$prefix}_image_id",
            'name'              => 'image_id',
            'label'             => __('Placeholder', '_SBB'),
            'instructions'      => __('Afbeelding word getoond als de video nog niet aan is gezet', '_SBB'),
            'type'              => 'image',
            'return_format'     => 'id',
            'conditional_logic' => [
                [
                    [
                        'field'    => 'field_video_video_type',
                        'operator' => '==',
                        'value'    => false,
                    ],
                ],
            ],
        ],
    ],
];

return $block_data;
