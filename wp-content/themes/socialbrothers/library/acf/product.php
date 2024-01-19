<?php

declare(strict_types=1);

add_action('acf/init', function () {
    $taxonomy = 'category_product';
    acf_add_local_field_group([
        'key'    => "{$taxonomy}_settings",
        'title'  => __('Categorie instellingen', '_SBB'),
        'fields' => [
            [
                'key'           => "{$taxonomy}_image",
                'label'         => __('Uitgelichte afbeelding', '_SBB'),
                'name'          => 'highlight_image',
                'type'          => 'image',
                'return_format' => 'id'
            ],
            [
                'key'           => "{$taxonomy}_display_name",
                'label'         => __('Weergavenaam', '_SBB'),
                'name'          => 'display_name',
                'type'          => 'wysiwyg',
                'toolbar'       => 'bold',
                'media_upload'  => 0,
                'tabs'          => 'visual'
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'taxonomy',
                    'operator' => '==',
                    'value'    => $taxonomy,
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

    $posttype = 'product';
    acf_add_local_field_group([
        'key'    => "{$posttype}_settings",
        'title'  => __('Product instellingen', '_SBB'),
        'fields' => [
            [
                'key'           => "{$posttype}_general_tab",
                'label'         => __('Algemeen', '_SBB'),
                'name'          => 'general_tab',
                'type'          => 'tab',
                'placement'      => 'left',
            ],
            [
                'key'           => "{$posttype}_bullet_points",
                'label'         => __('Bullet points', '_SBB'),
                'name'          => 'bullet_points',
                'type'          => 'wysiwyg',
                'media_upload'  => false,
                'tabs'          => 'visual',
                'toolbar'       => 'contentcenter'
            ],
            [
                'key'           => "{$posttype}_price",
                'label'         => __('Prijs', '_SBB'),
                'name'          => 'price',
                'type'          => 'text',
                'prepend'        => wpb_get_currency() ?? __('€', '_SBB'),
            ],
            [
                'key'           => "{$posttype}_external_link",
                'label'         => __('Externe bestel link', '_SBB'),
                'name'          => 'external_link',
                'type'          => 'url',
            ],
            [
                'key'           => "{$posttype}_keurmerken",
                'label'         => __('Keurmerken', '_SBB'),
                'name'          => 'keurmerken',
                'type'          => 'post_object',
                'post_type'     => 'keurmerk',
                'multiple'      => 1,
            ],
            [
                'key'           => "{$posttype}_safety_index",
                'label'         => __('Veiligheids index', '_SBB'),
                'name'          => 'safety_index',
                'type'          => 'image_select',
                'choices' => wpb_build_safety_index_options()
            ],
            [
                'key'           => "{$posttype}_article_number",
                'label'         => __('Artikel nummer', '_SBB'),
                'name'          => 'article_number',
                'type'          => 'text',
            ],
            [
                'key'           => "{$posttype}_images_tab",
                'label'         => __('Afbeeldingen', '_SBB'),
                'name'          => 'images_tab',
                'type'          => 'tab',
                'placement'      => 'left',
            ],
            [
                'key'           => "{$posttype}_images",
                'label'         => __('Afbeeldingen', '_SBB'),
                'name'          => 'images',
                'type'          => 'repeater',
                'sub_fields'    => [
                    [
                        'key'           => "{$posttype}_images_image",
                        'label'         => __('Afbeelding', '_SBB'),
                        'name'          => 'images_image',
                        'type'          => 'image',
                    ],
                ],
            ],
            [
                'key'           => "{$posttype}_specifications_tab",
                'label'         => __('Specificaties', '_SBB'),
                'name'          => 'specifications_tab',
                'type'          => 'tab',
                'placement'      => 'left',
            ],
            [
                'key'           => "{$posttype}_specifications_text",
                'label'         => __('Specificaties kop tekst', '_SBB'),
                'name'          => 'specifications_text',
                'type'          => 'wysiwyg',
                'media_upload'  => false,
                'tabs'          => 'visual',
                'toolbar'       => 'contentcenter'
            ],
            [
                'key'           => "{$posttype}_specifications_safety",
                'label'         => __('Veiligheidsinformatie', '_SBB'),
                'name'          => 'specifications_safety',
                'type'          => 'repeater',
                'sub_fields'    => [
                    [
                        'key'           => "{$posttype}_specifications_safety_attribute",
                        'label'         => __('Attribuut', '_SBB'),
                        'name'          => 'specifications_safety_attribute',
                        'type'          => 'text',
                    ],
                    [
                        'key'           => "{$posttype}_specifications_safety_value",
                        'label'         => __('Waarde', '_SBB'),
                        'name'          => 'specifications_safety_value',
                        'type'          => 'text',
                    ],
                ],
            ],
            [
                'key'           => "{$posttype}_specifications_technical",
                'label'         => __('Technische informatie', '_SBB'),
                'name'          => 'specifications_technical',
                'type'          => 'repeater',
                'sub_fields'    => [
                    [
                        'key'           => "{$posttype}_specifications_technical_attribute",
                        'label'         => __('Attribuut', '_SBB'),
                        'name'          => 'specifications_technical_attribute',
                        'type'          => 'text',
                    ],
                    [
                        'key'           => "{$posttype}_specifications_technical_value",
                        'label'         => __('Waarde', '_SBB'),
                        'name'          => 'specifications_technical_value',
                        'type'          => 'text',
                    ],
                ],
            ],
            [
                'key'           => "{$posttype}_downloads_tab",
                'label'         => __('Downloads', '_SBB'),
                'name'          => 'downloads_tab',
                'type'          => 'tab',
                'placement'      => 'left',
            ],
            [
                'key'           => "{$posttype}_downloads_text",
                'label'         => __('Downloads kop tekst', '_SBB'),
                'name'          => 'downloads_text',
                'type'          => 'wysiwyg',
                'media_upload'  => false,
                'tabs'          => 'visual',
                'toolbar'       => 'contentcenter'
            ],
            [
                'key'           => "{$posttype}_downloads_files",
                'label'         => __('Downloads', '_SBB'),
                'name'          => 'downloads_files',
                'type'          => 'repeater',
                'sub_fields'    => [
                    [
                        'key'           => "{$posttype}_downloads_files_name",
                        'label'         => __('Naam', '_SBB'),
                        'name'          => 'downloads_files_name',
                        'type'          => 'text',
                    ],
                    [
                        'key'           => "{$posttype}_downloads_files_file",
                        'label'         => __('Bestand', '_SBB'),
                        'name'          => 'downloads_files_file',
                        'type'          => 'file',
                    ],
                ],
            ],
            [
                'key'           => "{$posttype}_technical_tab",
                'label'         => __('Technische tekeningen', '_SBB'),
                'name'          => 'technical_tab',
                'type'          => 'tab',
                'placement'      => 'left',
            ],
            [
                'key'           => "{$posttype}_technical_drawings",
                'label'         => __('Technische tekeningen', '_SBB'),
                'name'          => 'technical_drawings',
                'type'          => 'repeater',
                'sub_fields'    => [
                    [
                        'key'           => "{$posttype}_technical_drawing",
                        'label'         => __('Technische tekening', '_SBB'),
                        'name'          => 'technical_drawing',
                        'type'          => 'image',
                    ],
                ],
            ],
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
        'parent'     => 'edit.php?post_type=product',
        'menu_slug'  => 'product_settings',
    ]);

    $prefix = 'product_setting';

    acf_add_local_field_group([
        'key'    => $prefix,
        'title'  => __('Product instellingen', '_SBB'),
        'fields' => [
            [
                'key'       => "{$prefix}_product_archive_tab",
                'label'     => __('Archief', '_SBB'),
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
                'name'      => "{$prefix}_single_tab",
                'key'       => "{$prefix}_single_tab",
                'type'      => 'tab',
                'label'     => __('Bericht pagina', '_SBB'),
                'placement' => 'left',
            ],
            [
                'label'      => __('Bericht andere berichten content', '_SBB'),
                'name'       => "{$prefix}_single_other_posts",
                'key'        => "{$prefix}_single_other_posts",
                'type'       => 'group',
                'sub_fields' => [
                    [
                        'key'   => "{$prefix}_single_other_posts_sub_title",
                        'name'  => 'sub_title',
                        'type'  => 'text',
                        'label' => __('Subtitel', '_SBB'),
                    ],
                    [
                        'key'   => "{$prefix}_single_other_posts_title",
                        'name'  => 'title',
                        'type'  => 'text',
                        'label' => __('Titel', '_SBB'),
                    ],
                    [
                        'key'          => "{$prefix}_single_other_posts_content",
                        'name'         => 'content',
                        'type'         => 'wysiwyg',
                        'toolbar'      => 'contentcenter',
                        'tabs'         => 'visual',
                        'media_upload' => false,
                        'label'        => __('Tekst', '_SBB'),
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'product_settings',
                ],
            ],
        ],
    ]);
});
