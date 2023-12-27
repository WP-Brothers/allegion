<?php

$prefix     = 'block_message';
$block_data = [
    'key'    => $prefix,
    'fields' => [
        [
            'key'     => "{$prefix}_message",
            'label'   => __('Over dit blok', '_SBB'),
            'name'    => 'content_tab',
            'type'    => 'message',
            'message' => __('Dit block heeft geen instellingen aangezien Yoast de kruimelpad opbouwd', '_SBF'),
        ],
    ],
];

return $block_data;
