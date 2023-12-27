<?php

declare(strict_types=1);

add_action('acf/init', function () {
    $prefix = 'user_info';

    acf_add_local_field_group([
        'key'    => $prefix,
        'title'  => __('Gebruikers instellingen', '_SBB'),
        'fields' => [
            [
                'name'  => "{$prefix}_base_tab",
                'key'   => "{$prefix}_base_tab",
                'type'  => 'tab',
                'label' => __('Algeneem', '_SBB'),
            ],
            [
                'key'           => "{$prefix}_avatar",
                'name'          => 'avatar',
                'type'          => 'image',
                'return_format' => 'id',
                'label'         => __('Foto', '_SBB'),
            ],
            [
                'key'       => "{$prefix}_about_me",
                'name'      => 'about_me',
                'type'      => 'textarea',
                'new_lines' => 'br',
                'label'     => __('Over mij', '_SBB'),
            ],
            [
                'key'   => "{$prefix}_more_link",
                'name'  => 'more_link',
                'type'  => 'link',
                'label' => __('Link', '_SBB'),
            ],
            [
                'name'  => "{$prefix}_contact_tab",
                'key'   => "{$prefix}_contact_tab",
                'type'  => 'tab',
                'label' => __('Contact', '_SBB'),
            ],
            [
                'key'   => "{$prefix}_phone",
                'name'  => 'phone',
                'type'  => 'text',
                'label' => __('Telefoonnummer', '_SBB'),
            ],
            [
                'key'   => "{$prefix}_email",
                'name'  => 'email',
                'type'  => 'text',
                'label' => __('E-mail', '_SBB'),
            ],
            [
                'key'        => "{$prefix}_socials",
                'name'       => 'socials',
                'type'       => 'group',
                'label'      => __('Socials', '_SBB'),
                'sub_fields' => [
                    [
                        'key'   => "{$prefix}_facebook",
                        'name'  => 'facebook',
                        'type'  => 'link',
                        'label' => __('Facebook', '_SBB'),
                    ],
                    [
                        'key'   => "{$prefix}_instagram",
                        'name'  => 'instagram',
                        'type'  => 'link',
                        'label' => __('Instagram', '_SBB'),
                    ],
                    [
                        'key'   => "{$prefix}_linkedin",
                        'name'  => 'linkedin',
                        'type'  => 'link',
                        'label' => __('Linkedin', '_SBB'),
                    ],
                    [
                        'key'   => "{$prefix}_x",
                        'name'  => 'x',
                        'type'  => 'link',
                        'label' => __('X(voorheen Twitter)', '_SBB'),
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'user_role',
                    'operator' => '==',
                    'value'    => 'all',
                ],
            ],
        ],
    ]);
});
