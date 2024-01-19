<?php


$prefix     = 'block_video';



$fields = array_merge(getTabFields($prefix, 1, 'content', __('Content', '_SBB')), getTitleFields($prefix), getButtonFields($prefix), getTabFields($prefix, 0, 'video', __('Video', '_SBB')), getVideoFields($prefix));

$block_data = [
    'key'    => $prefix,
    'fields' => $fields
];


return $block_data;