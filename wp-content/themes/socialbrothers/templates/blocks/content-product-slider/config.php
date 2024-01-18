<?php

$prefix     = 'block_content-product-slider';

$fields = array_merge(ContentFieldGroup($prefix, 1, 0), getTabFields($prefix, 0, 'product', __('Producten', '_SBB')), getRelationshipFields($prefix, 'product', 'products', __('Producten', '_SBB')), getTabFields($prefix, 0, 'style', __('Style', '_SBB')), getOrderSwitch($prefix), getImageFields($prefix, __('Achtergrond afbeelding', '_SBB')));

$block_data = [
    'key'    => $prefix,
    'title'  => __('Content + producten slider', '_SBB'),
    'fields' => $fields
];

return $block_data;
