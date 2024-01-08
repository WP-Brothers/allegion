<?php

declare(strict_types=1);

add_action('acf/init', function () {
    $posttype = 'keurmerk';
    acf_add_local_field_group([
        'key'    => "{$posttype}_settings",
        'title'  => __('Keurmerk instellingen', '_SBB'),
        'fields' => [
            [
                'key'           => "{$posttype}_display_name",
                'label'         => __('Afgekorte naam', '_SBB'),
                'name'          => 'display_name',
                'type'          => 'text',
            ],
            [
                'key'           => "{$posttype}_content",
                'label'         => __('Content', '_SBB'),
                'name'          => 'content',
                'type'          => 'wysiwyg',
                'tabs'          => 'visual',
                'media_upload'  => 0,
                'toolbar'       => 'simple'
            ],
            [
                'key'           => "{$posttype}_extra_link",
                'label'         => __('Meer informatie link', '_SBB'),
                'name'          => 'extra_link',
                'type'          => 'wysiwyg',
                'tabs'          => 'visual',
                'media_upload'  => 0,
                'toolbar'       => 'link'
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
