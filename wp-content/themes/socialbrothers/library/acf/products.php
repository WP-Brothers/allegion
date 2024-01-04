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
});
