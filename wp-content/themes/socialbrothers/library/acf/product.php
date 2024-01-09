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
});
