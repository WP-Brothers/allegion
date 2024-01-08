<?php


$prefix     = 'block_content-image-video';

$block_data = [
    'key'    => $prefix,
    'fields' => array_merge(getTabFields($prefix, 1, 'content', __('Content', '_SBB')), getTitleFields($prefix), getContentFields($prefix), getOrderSwitch($prefix), imageVideoFieldGroup($prefix, 0))
];

return $block_data;