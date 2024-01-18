<?php

defined('ABSPATH') || exit('Forbidden');

function acf_theme_settings()
{
    $prefix = 'theme_settings';
    acf_add_options_page([
        'page_title' => __('Thema instellingen', '_SBB'),
        'menu_title' => __('Thema instellingen', '_SBB'),
        'menu_slug'  => 'theme_settings',
        'position'   => 3,
    ]);

    acf_add_local_field_group([
        'key'    => $prefix,
        'title'  => __('Thema instellingen', '_SBB'),
        'fields' => [
            [
                'key'       => "{$prefix}_general_tab",
                'label'     => __('Algemeen', '_SBB'),
                'type'      => 'tab',
                'placement' => 'left',
            ],
            [
                'key'           => "{$prefix}_logo",
                'name'          => 'logo',
                'label'         => __('Logo', '_SBB'),
                'type'          => 'image',
                'mime_types'    => 'svg, png, jpg',
                'return_format' => 'id',
                'instructions'  => __('Voeg hier het logo toe', '_SBB'),
            ],
            [
                'key'           => "{$prefix}_brand_style",
                'name'          => 'brand_style',
                'label'         => __('Brand', '_SBB'),
                'instructions'  => __("Select the branding style that corresponds to the site you're currently on.", '_SBB'),
                'type'          => 'select',
                'choices'       => [
                    ''                          => __('AXA — Home Security', '_SBB'),
                    'axa-bike-security-theme'   => __('AXA — Bike Security', '_SBB'),
                    'axa-corporate-theme'       => __('AXA — Corporate', '_SBB'),
                    'trelock-theme'             => __('Trelock', '_SBB'),
                ],
            ],
            [
                'key'       => "{$prefix}_contact_tab",
                'label'     => __('Contact', '_SBB'),
                'type'      => 'tab',
                'placement' => 'left',
            ],
            [
                'key'          => "{$prefix}_contact_hours",
                'name'         => 'contact_hours',
                'label'        => __('Bereikbaar op', '_SBB'),
                'placeholder'        => __('Bijv: Ma t/m vrij 08:00 - 17:00 uur', '_SBB'),
                'type'         => 'text',
            ],
            [
                'key'          => "{$prefix}_phone",
                'name'         => 'phone',
                'label'        => __('Telefoonnummer', '_SBB'),
                'type'         => 'text',
                'wrapper'      => ['width' => 50],
                'instructions' => __('Voeg hier het telefoonnummer toe', '_SBB'),
            ],
            [
                'key'          => "{$prefix}_email",
                'name'         => 'email',
                'label'        => __('Email', '_SBB'),
                'type'         => 'text',
                'wrapper'      => ['width' => 50],
                'instructions' => __('Voeg hier het e-mailadres toe', '_SBB'),
            ],
            [
                'key'       => "{$prefix}_business_name",
                'name'      => 'business_name',
                'label'     => __('Bedrijfsnaam', '_SBB'),
                'type'      => 'text',
            ],
            [
                'key'       => "{$prefix}_address",
                'name'      => 'address',
                'label'     => __('Adres', '_SBB'),
                'type'      => 'textarea',
                'new_lines' => 'br',
                'wrapper'   => ['width' => 50],
            ],
            [
                'key'     => "{$prefix}_address_link",
                'name'    => 'address_link',
                'label'   => __('Adres link', '_SBB'),
                'type'    => 'link',
                'wrapper' => ['width' => 50],
            ],
            [
                'key'       => "{$prefix}_socials_tab",
                'label'     => __('Social Media', '_SBB'),
                'type'      => 'tab',
                'placement' => 'left',
            ],
            [
                'key'        => "{$prefix}_socials",
                'name'       => 'socials',
                'label'      => __('Socials', '_SBB'),
                'type'       => 'group',
                'sub_fields' => [
                    [
                        'key'   => "{$prefix}_socials_facebook",
                        'name'  => 'facebook',
                        'label' => __('Facebook', '_SBB'),
                        'type'  => 'link',
                    ],
                    [
                        'key'   => "{$prefix}_socials_instagram",
                        'name'  => 'instagram',
                        'label' => __('Instagram', '_SBB'),
                        'type'  => 'link',
                    ],
                    [
                        'key'   => "{$prefix}_socials_linkedin",
                        'name'  => 'linkedin',
                        'label' => __('LinkedIn', '_SBB'),
                        'type'  => 'link',
                    ],
                    [
                        'key'   => "{$prefix}_socials_x",
                        'name'  => 'x',
                        'label' => __('X (voorheen Twitter)', '_SBB'),
                        'type'  => 'link',
                    ],
                ],
            ],

            [
                'key'       => "{$prefix}_newsletter_tab",
                'label'     => __('Nieuwsbrief', '_SBB'),
                'type'      => 'tab',
                'placement' => 'left',
            ],
            [
                'key'        => "{$prefix}_newsletter_content",
                'name'       => 'newsletter',
                'label'      => __('Nieuwsbrief', '_SBB'),
                'type'       => 'group',
                'sub_fields' => [
                    [
                        'key'   => "{$prefix}_newsletter_content_sub_title",
                        'name'  => 'sub_title',
                        'label' => __('Subtitel', '_SBB'),
                        'type'  => 'text',
                    ],
                    [
                        'key'   => "{$prefix}_newsletter_content_title",
                        'name'  => 'title',
                        'label' => __('Titel', '_SBB'),
                        'type'  => 'text',
                    ],
                    [
                        'key'          => "{$prefix}_newsletter_content_content",
                        'name'         => 'content',
                        'label'        => __('Content', '_SBB'),
                        'type'         => 'wysiwyg',
                        'toolbar'      => 'contentcenter',
                        'tabs'         => 'visual',
                        'media_upload' => false,
                    ],
                ],
            ],
            [
                'key'       => "{$prefix}_product_archive_tab",
                'label'     => __('Producten Archief', '_SBB'),
                'type'      => 'tab',
                'placement' => 'left',
            ],
            [
                'key'          => "{$prefix}_product_archive_content",
                'name'         => 'product_archive_content',
                'label'        => __('Intro content', '_SBB'),
                'type'         => 'wysiwyg',
                'toolbar'      => 'contentcenter',
                'tabs'         => 'visual',
                'media_upload' => false,
            ],
            [
                'key'          => "{$prefix}_product_archive_footer_title",
                'label'        => __('Footer Titel', '_SBB'),
                'name'         => 'product_archive_footer_title',
                'type'         => 'text',
            ],
            [
                'key'          => "{$prefix}_product_archive_footer_content",
                'label'        => __('Footer content', '_SBB'),
                'name'         => 'product_archive_footer_content',
                'type'         => 'wysiwyg',
                'toolbar'      => 'contentcenter',
                'tabs'         => 'visual',
                'media_upload' => false,
            ],
            [
                'key'       => "{$prefix}_safety_index_tab",
                'label'     => __('Veiligheids indexen', '_SBB'),
                'type'      => 'tab',
                'placement' => 'left',
            ],
            [
                'key'       => "{$prefix}_safety_index_repeater",
                'label'     => __('Veiligheids indexen', '_SBB'),
                'name'         => 'safety_index_repeater',
                'type'      => 'repeater',
                'sub_fields' => [
                    [
                        'key'       => "{$prefix}_safety_index_image",
                        'label'     => __('Veiligheids index', '_SBB'),
                        'name'         => 'safety_index_image',
                        'type'      => 'image',
                        'wrapper'   => ['width' => 50]
                    ],
                    [
                        'key'       => "{$prefix}_safety_index_title",
                        'label'     => __('Veiligheids index titel', '_SBB'),
                        'name'         => 'safety_index_title',
                        'type'      => 'text',
                        'wrapper'   => ['width' => 50]
                    ],
                ]
            ],
            [
                'key'       => "{$prefix}_header_tab",
                'label'     => __('Header', '_SBB'),
                'type'      => 'tab',
                'placement' => 'left',
            ],
            [
                'key'   => "{$prefix}_header_submenu_hover",
                'label' => __('Menu dropdown hover ipv klik', '_SBB'),
                'name'  => 'header_submenu_hover',
                'type'  => 'true_false',
                'ui'    => true,
            ],
            [
                'key'        => "{$prefix}_header_button",
                'label'      => __('Knop', '_SBB'),
                'name'       => 'header_button',
                'type'       => 'group',
                'layout'     => 'block',
                'sub_fields' => [
                    [
                        'key'     => "{$prefix}_header_button_link",
                        'name'    => 'link',
                        'label'   => __('Link', '_SBB'),
                        'type'    => 'link',
                        'wrapper' => [
                            'width' => '50%',
                        ],
                    ],
                    [
                        'key'     => "{$prefix}_header_button_type",
                        'name'    => 'type',
                        'label'   => __('Stijl', '_SBB'),
                        'type'    => 'select',
                        'choices' => wpb_get_button_types(),
                        'wrapper' => [
                            'width' => '50%',
                        ],
                    ],
                    [
                        'key'     => "{$prefix}_header_button_use_icon",
                        'name'    => 'use_icon',
                        'label'   => __('Icoon gebruiken?', '_SBB'),
                        'type'    => 'true_false',
                        'ui'      => true,
                        'wrapper' => [
                            'width' => '30%',
                        ],
                    ],
                    [
                        'key'     => "{$prefix}_header_button_icon",
                        'name'    => 'icon',
                        'label'   => __('Icoon', '_SBB'),
                        'type'    => 'GOOGLE_MATERIAL_ICON',
                        'wrapper' => [
                            'width' => '40%',
                        ],
                        'conditional_logic' => [
                            [
                                [
                                    'field'    => "{$prefix}_header_button_use_icon",
                                    'operator' => '==',
                                    'value'    => 1,
                                ],
                            ],
                        ],
                    ],
                    [
                        'key'     => "{$prefix}_header_button_icon_pos",
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
                                    'field'    => "{$prefix}_header_button_use_icon",
                                    'operator' => '==',
                                    'value'    => 1,
                                ],
                            ],
                        ],
                    ],
                ],
            ],

            [
                'key'       => "{$prefix}_footer_tab",
                'label'     => __('Footer', '_SBB'),
                'type'      => 'tab',
                'placement' => 'left',
            ],
            [
                'key'          => "{$prefix}_footer_logo",
                'name'         => 'footer_logo',
                'label'        => __('Logo', '_SBB'),
                'type'         => 'image',
            ],

            [
                'key'       => "{$prefix}_search_tab",
                'label'     => __('Zoekpagina', '_SBB'),
                'type'      => 'tab',
                'placement' => 'left',
            ],

            [
                'key'           => "{$prefix}_search_page_title",
                'name'          => 'search_page_title',
                'label'         => __('Titel', '_SBB'),
                'type'          => 'text',
                'default_value' => __('Zoek op onderwerp', '_SBF'),
            ],

            [
                'key'       => "{$prefix}_404_tab",
                'label'     => __('404', '_SBB'),
                'type'      => 'tab',
                'placement' => 'left',
            ],
            [
                'key'           => "{$prefix}_404_title",
                'name'          => '404_title',
                'label'         => __('Titel', '_SBB'),
                'type'          => 'text',
                'default_value' => __('Oeps! We hebben overal gezocht…', '_SBF'),
            ],
            [
                'key'           => "{$prefix}_404_content",
                'name'          => '404_content',
                'label'         => __('Content', '_SBB'),
                'type'          => 'wysiwyg',
                'toolbar'       => 'contentcenter',
                'tabs'          => 'visual',
                'media_upload'  => false,
                'default_value' => __('maar we konden de pagina nergens vinden. We helpen je graag de weg terug te vinden. ', '_SBF'),
            ],
            [
                'key'           => "{$prefix}_404_image",
                'name'          => '404_image',
                'label'         => __('Afbeelding', '_SBB'),
                'type'          => 'image',
                'return_format' => 'id'
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'theme_settings',
                ],
            ],
        ],
    ]);
}

add_action('acf/init', 'acf_theme_settings');
