<?php


$prefix     = 'block_latest-news';

$block_data = [
    'key'    => $prefix,
    'fields' => array_merge(getTabFields($prefix, 1, 'content', __('Content', '_SBB')), getTitleFields($prefix))
];

return $block_data;
