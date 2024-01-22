<?php

$prefix     = 'block_content-product-categories';

$fields = array_merge(ContentFieldGroup($prefix, 1, 0), getTabFields($prefix, 0, 'product_categories', __('Categorieën', '_SBB')));

$block_data = [
    'key'    => $prefix,
    'fields' => $fields
];

return $block_data;
