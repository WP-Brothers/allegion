<?php


$prefix = 'block_content-image-video';

$fields = array_merge(getTabFields($prefix, 1, 'content', __('Content', '_SBB')), getTitleFields($prefix), getContentFields($prefix), geOrderSwitch($prefix), imageVideoFieldGroup($prefix, 0));

$block_data = [
    'key'    => $prefix,
    'fields' => $fields
];

return $block_data;
