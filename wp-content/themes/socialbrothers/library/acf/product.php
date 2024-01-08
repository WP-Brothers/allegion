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
                        'label'        => __('Teskt', '_SBB'),
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
