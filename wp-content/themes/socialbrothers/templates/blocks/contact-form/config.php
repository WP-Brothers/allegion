<?php

$prefix     = 'block_contact_form';
$block_data = [
    'key'    => $prefix,
    'title'  => __('Contact form', '_SBB'),
    'fields' => [
        [
            'key'          => "{$prefix}_top_tab",
            'label'        => __('Boven kant', '_SBB'),
            'name'         => 'top_tab',
            'type'         => 'accordion',
            'open'         => 1,
            'multi_expand' => 1,
        ],
        [
            'key'   => "{$prefix}_title",
            'label' => __('Titel', '_SBB'),
            'name'  => 'title',
            'type'  => 'text',
        ],
        [
            'key'          => "{$prefix}_content",
            'label'        => __('Tekst', '_SBB'),
            'name'         => 'content',
            'type'         => 'wysiwyg',
            'toolbar'      => 'contentcenter',
            'tabs'         => 'visual',
            'media_upload' => false,
        ],
        [
            'key'   => "{$prefix}_form_title",
            'label' => __('Titel', '_SBB'),
            'name'  => 'form_title',
            'type'  => 'text',
        ],
        [
            'key'     => "{$prefix}_form_id",
            'name'    => 'form_id',
            'label'   => __('Formulier', '_SBB'),
            'type'    => 'select',
            'choices' => wpb_get_gforms(),
        ],
    ],
];

return $block_data;
