<?php

$prefix     = 'block_hero';

$fields = array_merge(ContentFieldGroup($prefix, 1, 0), getTabFields($prefix, 0, 'background', __('Achtergrond', '_SBB')), getImageFields($prefix));
$block_data = [
    'key'    => $prefix,
    'fields' => $fields
];

return $block_data;
