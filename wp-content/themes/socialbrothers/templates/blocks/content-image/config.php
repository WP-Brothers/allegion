<?php

$prefix     = 'block_content-image';

$fields = array_merge(ContentFieldGroup($prefix, 1, 0), getOrderSwitch($prefix), getTabFields($prefix, 0, 'image_video', __('Afbeelding', '_SBB')), getImageFields($prefix));
$block_data = [
    'key'    => $prefix,
    'fields' => $fields
];

return $block_data;
