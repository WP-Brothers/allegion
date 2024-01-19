<?php

$prefix     = 'block_content-product-categories';

$customSwitch = [
    [
        'key'           =>  "{$prefix}_switch",
        'label'         =>  __('Categorieën', '_SBB'),
        'name'          =>  'category_products',
        'type'          =>  'repeater',
        'max'           =>  4,
    ]
    ];

$categorySelectConditionalLogic = [
    'field' => $prefix . '_switch',
];

$fields = array_merge(ContentFieldGroup($prefix, 1, 0), getTabFields($prefix, 0, 'product_categories', __('Categorieën', '_SBB')), getCategorySelect($prefix));

$block_data = [
    'key'    => $prefix,
    'fields' => $fields
];

return $block_data;
