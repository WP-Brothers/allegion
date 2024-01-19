<?php

function getTitleFields($prefix)
{
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
function getSubTitleFields($prefix)
{
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
function getTabFields($prefix, int $expand = 0, $name, $label)
{

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
function getContentFields($prefix,)
{
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
function getButtonFields($prefix,)
{
    $fields = [
        [
            'key'          => "{$prefix}_buttons",
            'label'        => __('Knoppen', '_SBB'),
            'name'         => 'buttons',
            'button_label' => __('Nieuwe Button', '_SBB'),
            'type'         => 'repeater',
            'max'          => 2,
            'layout'       => 'block',
            'collapsed'    => "{$prefix}_buttons_link",
            'sub_fields'   => [
                [
                    'key'     => "{$prefix}_buttons_link",
                    'name'    => 'link',
                    'label'   => __('Link', '_SBB'),
                    'type'    => 'link',
                    'wrapper' => [
                        'width' => '50%',
                    ],
                ],
                [
                    'key'     => "{$prefix}_buttons_type",
                    'name'    => 'type',
                    'label'   => __('Stijl', '_SBB'),
                    'type'    => 'select',
                    'choices' => wpb_get_button_types(),
                    'wrapper' => [
                        'width' => '50%',
                    ],
                ],
                [
                    'key'     => "{$prefix}_buttons_use_icon",
                    'name'    => 'use_icon',
                    'label'   => __('Icoon gebruiken?', '_SBB'),
                    'type'    => 'true_false',
                    'ui'      => true,
                    'wrapper' => [
                        'width' => '30%',
                    ],
                ],
                [
                    'key'     => "{$prefix}_buttons_icon",
                    'name'    => 'icon',
                    'label'   => __('Icoon', '_SBB'),
                    'type'    => 'GOOGLE_MATERIAL_ICON',
                    'wrapper' => [
                        'width' => '40%',
                    ],
                    'conditional_logic' => [
                        [
                            [
                                'field'    => "{$prefix}_buttons_use_icon",
                                'operator' => '==',
                                'value'    => 1,
                            ],
                        ],
                    ],
                ],
                [
                    'key'     => "{$prefix}_buttons_icon_pos",
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
                                'field'    => "{$prefix}_buttons_use_icon",
                                'operator' => '==',
                                'value'    => 1,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];
    return $fields;
}
function getImageVideoSwitchFields($prefix)
{
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

function getOrderSwitch($prefix)
{
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

function getImageFields($prefix, $label = '')
{
    if (empty($label)) {
        $label = __('Afbeelding', '_SBB');
    }

    $fields = [
        [
            'key'           => "{$prefix}_image_id",
            'label'         => $label,
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

function getVideoFields($prefix)
{
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
function getFaqFields($prefix)
{
    $fields = [
        [
            'key'           => "{$prefix}_faqs",
            'label'         => __('FAQ', '_SBB'),
            'name'          => 'faqs',
            'type'          => 'relationship',
            'post_type'     => 'faq',
            'multiple'      => 1,

        ]
    ];
    return $fields;
}

function getRelationshipFields($prefix, $posttype, $name, $label)
{
    $fields = [
        [
            'key'           => "{$prefix}_{$posttype}s",
            'label'         => $label,
            'name'          => $name,
            'type'          => 'relationship',
            'post_type'     => "{$posttype}",
            'multiple'      => 1,
        ]
    ];
    return $fields;
}

function getFormFields($prefix)
{
    $fields = [
        [
            'key'     => "{$prefix}_form_id",
            'name'    => 'form_id',
            'label'   => __('Formulier', '_SBB'),
            'type'    => 'select',
            'choices' => wpb_get_gforms(),
        ],
    ];
    return $fields;
}

function getCategorySelect($prefix, $conditional_logic = '')
{
    $field['choices'] = [];
    $terms = get_terms();
    $choices[''] = __('Selecteer een categorie');

    if ($terms) {
        foreach ($terms as $term) {

            if ($term->taxonomy == 'category_product') {
                $choices[$term->term_id] = $term->name;
            }
        }
    }

    $fields = [
        [
            'key'           =>  "{$prefix}_category_products",
            'label'         =>  __('Categorieën', '_SBB'),
            'name'          =>  'category_products',
            'type'          =>  'repeater',
            'max'           =>  4,
            'sub_fields'    => [
                [
                    'key'           =>  "{$prefix}_category",
                    'label'         =>  __('Categorie', '_SBB'),
                    'name'          =>  'category',
                    'type'          =>  'select',
                    'choices'       =>  $choices,
                ],
            ]
        ],
    ];

    if(!empty($conditional_logic)) {
        $fields['conditional_logic'] = [
            [
                [
                    'field'    => "{$prefix}_{$conditional_logic['field']}",
                    'operator' => $conditional_logic['operator'],
                    'value'    => $conditional_logic['value'],
                ],
            ],
        ];
    }


    dd($fields);
    return $fields;
}
