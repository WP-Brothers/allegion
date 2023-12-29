<?php

function getTitleFields($prefix) {
    $fields = [
        [
            'key'   => "{$prefix}_title",
            'label' => __('Titel', '_SBB'),
            'name'  => 'title',
            'type'  => 'text',
        ],
    ];
    return $fields;
}
function getSubTitleFields($prefix) {
    $fields = [
        [
            'key'   => "{$prefix}_sub_title",
            'label' => __('Subtitel', '_SBB'),
            'name'  => 'sub_title',
            'type'  => 'text',
        ],
    ];
    return $fields;
}
function getTabFields($prefix, $expand = 0, $name, $label) {
    
    $fields = [
        [
            'key'          => "{$prefix}_{$name}_tab",
            'label'        => __($label, '_SBB'),
            'name'         => "{$name}_tab",
            'type'         => 'accordion',
            'open'         => $expand,
            'multi_expand' => 1,
        ],
    ];
    return $fields;
}
function getContentFields($prefix,) {
    $fields = [
        [
            'key'          => "{$prefix}_content",
            'label'        => __('Tekst', '_SBB'),
            'name'         => 'content',
            'type'         => 'wysiwyg',
            'toolbar'      => 'contentcenter',
            'tabs'         => 'visual',
            'media_upload' => false,
        ],
    ];
    return $fields;
}
function getImageVideoSwitchFields($prefix) {
    $fields = [
        [
            'key'           => "{$prefix}_image_video_switch",
            'label'         => __('Afbeelding of video?', '_SBB'),
            'name'          => 'image_video_switch',
            'type'          => 'true_false',
            'ui'            => '1',
            'ui_off_text'   => __('Afbeelding', '_SBB'),
            'ui_on_text'    => __('Video', '_SBB'),
        ],
    ];
    return $fields;
}

function geOrderSwitch($prefix) {
    $fields = [
        [
            'key'           => "{$prefix}_order_switch",
            'label'         => __('Indeling omdraaien?', '_SBB'),
            'name'          => 'order_switch',
            'type'          => 'true_false',
            'ui'            => '1',
            'ui_off_text'   => __('Nee', '_SBB'),
            'ui_on_text'    => __('Ja', '_SBB'),
        ],
    ];
    return $fields;
}

function getImageFields($prefix) {
    $fields = [
        [
            'key'           => "{$prefix}_image_id",
            'label'         => __('Afbeelding', '_SBB'),
            'name'          => 'image_id',
            'type'          => 'image',
            'return_format' => 'id',
            'conditional_logic' => [
                [
                    [
                        'field'    => "{$prefix}_image_video_switch",
                        'operator' => '==',
                        'value'    => 0,
                    ],
                ],
            ],
        ],
    ];
    return $fields;
}

function getVideoFields($prefix) {
    $fields = [

        [
            'key'           => "{$prefix}_video_group",
            'name'          => 'video_group',
            'type'          => 'group',
            'label'         => __('Video'),
            'sub_fields'    => [
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
                                'field'    => "{$prefix}_video_type",
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
                                'field'    => "{$prefix}_video_type",
                                'operator' => '==',
                                'value'    => false,
                            ],
                        ],
                    ],
                ],
                [
                    'key'               => "{$prefix}_placeholder_image_id",
                    'name'              => 'placeholder_image_id',
                    'label'             => __('Placeholder', '_SBB'),
                    'instructions'      => __('Afbeelding word getoond als de video nog niet aan is gezet', '_SBB'),
                    'type'              => 'image',
                    'return_format'     => 'id',
                    'conditional_logic' => [
                        [
                            [
                                'field'    => "{$prefix}_video_type",
                                'operator' => '==',
                                'value'    => false,
                            ],
                        ],
                    ],
                ],
            ],
            'conditional_logic' => [
                [
                    [
                        'field'    => "{$prefix}_image_video_switch",
                        'operator' => '==',
                        'value'    => 1,
                    ],
                ],
            ],
        ],
    ];
    return $fields;
}
function getFaqFields($prefix) {
    $fields = [
        [
            'key'           => "{$prefix}_faq",
            'label'         => __('FAQ', '_SBB'),
            'name'          => 'faq',
            'type'          => 'relationship',
            'post_type'     => 'faq',
            'multiple'      => 1,
        ],
    ];
    return $fields;
}
