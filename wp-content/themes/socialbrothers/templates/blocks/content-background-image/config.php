<?php

$prefix     = 'block_content-background-image';

$fields = array_merge(ContentFieldGroup($prefix, 1, 0, 1), getTabFields($prefix, 0, 'image', __('Achtergrond', '_SBB')), getImageFields($prefix));
$block_data = [
    'key'    => $prefix,
    'fields' => $fields
];

return $block_data;
