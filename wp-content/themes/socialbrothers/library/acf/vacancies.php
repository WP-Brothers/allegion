<?php

declare(strict_types=1);
add_action('acf/init', function () {
    acf_add_local_field_group([
        'key'    => 'vacancy_taxonomy_settings',
        'title'  => __('Vacature instellingen', '_SBB'),
        'fields' => [
            [
                'key'           => 'vacancy_taxonomy_settings_icon',
                'label'         => __('Icoon', '_SBB'),
                'name'          => 'vacancy_taxonomy_settings_icon',
                'type'          => 'GOOGLE_MATERIAL_ICON',
                'wrapper'       => [
                    'width' => '50',
                ],
            ],
            [
                'key'           => 'vacancy_taxonomy_settings_type',
                'label'         => __('Type', '_SBB'),
                'name'          => 'vacancy_taxonomy_settings_type',
                'type'          => 'select',
                'default_value' => 'clear',
                'choices'       => [
                    'clear'         => __('Clear', '_SBB'),
                    'secondary-outline-pointy'         => __('Boxed', '_SBB'),
                ],
                'wrapper'       => [
                    'width' => '50',
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'taxonomy',
                    'operator' => '==',
                    'value'    => 'function_vacancy',
                ],
            ],
            [
                [
                    'param'    => 'taxonomy',
                    'operator' => '==',
                    'value'    => 'location_vacancy',
                ],
            ],
            [
                [
                    'param'    => 'taxonomy',
                    'operator' => '==',
                    'value'    => 'employment_type_vacancy',
                ],
            ],
        ],
    ]);

    $posttype = 'vacancy';
    acf_add_local_field_group([
        'key'    => "{$posttype}_settings",
        'title'  => __('Vacancy instellingen', '_SBB'),
        'fields' => [
            [
                'key'           => "{$posttype}_general_tab",
                'label'         => __('Content', '_SBB'),
                'name'          => 'general_tab',
                'type'          => 'tab',
                'placement'      => 'left',
            ],
            [
                'key'           => "{$posttype}_intro",
                'label'         => __('Intro', '_SBB'),
                'name'          => 'intro',
                'type'          => 'textarea',
                'rows'          => 2,
            ],
            [
                'key'           => "{$posttype}_content",
                'label'         => __('Content', '_SBB'),
                'name'          => 'content',
                'type'          => 'wysiwyg',
            ]
        ],
        'location' => [
            [
                [
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => $posttype,
                ],
            ],
        ],
        'menu_order'            => 0,
        'position'              => 'normal',
        'style'                 => '',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
        'active'                => true,
    ]);

    acf_add_options_page([
        'page_title' => __('Nieuws instellingen', '_SBB'),
        'menu_title' => __('Instellingen', '_SBB'),
        'parent'     => 'edit.php?post_type=vacancy',
        'menu_slug'  => 'vacancy_settings',
    ]);

    $prefix = 'vacancy_setting';

    acf_add_local_field_group([
        'key'    => $prefix,
        'title'  => __('Vacatuur instellingen', '_SBB'),
        'fields' => [
            [
                'key'       => "{$prefix}_archive_tab",
                'label'     => __('Archief', '_SBB'),
                'type'      => 'tab',
                'placement' => 'left',
            ],
            [
                'key'          => "{$prefix}_archive_content",
                'name'         => 'vacancy_archive_content',
                'label'        => __('Intro content', '_SBB'),
                'type'         => 'wysiwyg',
                'toolbar'      => 'contentcenter',
                'tabs'         => 'visual',
                'media_upload' => false,
            ],
            [
                'key'          => "{$prefix}_archive_image",
                'label'        => __('Intro afbeelding', '_SBB'),
                'name'         => 'vacancy_archive_image',
                'type'         => 'image',
                'return_format' => 'id',
            ],
            [
                'key'          => "{$prefix}_contact",
                'label'        => __('Contact', '_SBB'),
                'type'         => 'tab',
            ],
            [
                'key'          => "{$prefix}_contact_name",
                'label'        => __('Contact naam', '_SBB'),
                'name'         => 'vacancy_contact_name',
                'type'         => 'text',
                'wrapper'      => [
                    'width' => '50',
                ],
            ],
            [
                'key'          => "{$prefix}_contact_avatar",
                'label'        => __('Contact Avatar', '_SBB'),
                'name'         => 'vacancy_contact_avatar',
                'type'         => 'image',
                'return_format' => 'id',
                'wrapper'      => [
                    'width' => '50',
                ],
            ],
            [
                'key'          => "{$prefix}_contact_description",
                'label'        => __('Contact beschrijving', '_SBB'),
                'name'         => 'vacancy_contact_description',
                'type'         => 'textarea',
                'rows'         => 2,
            ],
            [
                'key'          => "{$prefix}_contact_text",
                'label'        => __('Contact tekst', '_SBB'),
                'name'         => 'vacancy_contact_text',
                'type'         => 'wysiwyg',
            ],
            [
                'key'          => "{$prefix}_contact_info",
                'label'        => __('Contact informatie', '_SBB'),
                'name'         => 'vacancy_contact_info',
                'type'         => 'repeater',
                'layout'       => 'table',
                'button_label' => __('Voeg informatie toe', '_SBB'),
                'sub_fields'   => [
                    [
                        'key'          => "{$prefix}_contact_info_icon",
                        'label'        => __('Icoon', '_SBB'),
                        'name'         => 'vacancy_contact_info_icon',
                        'type'         => 'GOOGLE_MATERIAL_ICON',
                    ],
                    [
                        'key'          => "{$prefix}_contact_info_text",
                        'label'        => __('Tekst', '_SBB'),
                        'name'         => 'vacancy_contact_info_text',
                        'type'         => 'text',
                    ],
                ],
            ],
            [
                'key'          => "{$prefix}_contact_button",
                'label'        => __('Contact button', '_SBB'),
                'name'         => 'vacancy_contact_button',
                'type'         => 'link',
                'wrapper'      => [
                    'width' => '50',
                ],
            ],
            [
                'key'          => "{$prefix}_contact_card_background_color",
                'label'        => __('Contact kaart achtergrond kleur', '_SBB'),
                'name'         => 'vacancy_contact_card_background_color',
                'type'         => 'select',
                'default_value' => 'white',
                'choices'      => [
                    'primary'       => __('Primary', '_SBB'),
                    'secondary'     => __('Secondary', '_SBB'),
                    'cta'           => __('CTA', '_SBB'),
                    'ghost'          => __('Ghost', '_SBB'),
                ],
                'wrapper'      => [
                    'width' => '50',
                ],
            ]
        ],
        'location' => [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'vacancy_settings',
                ],
            ],
        ],
    ]);
});
