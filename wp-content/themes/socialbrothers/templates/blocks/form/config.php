<?php

$prefix     = 'block_form';
$block_data = [
    'key'    => $prefix,
    'fields' => [
        [
            'key'          => "{$prefix}_content",
            'label'        => __('Content', '_SBB'),
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
            'key'     => "{$prefix}_form_id",
            'name'    => 'form_id',
            'label'   => __('Formulier', '_SBB'),
            'type'    => 'select',
            'choices' => wpb_get_gforms(),
        ],
    ],
];

return $block_data;
