<?php


$prefix     = 'block_latest-news';

$block_data = [
    'key'    => $prefix,
    'fields' => array_merge(getTabFields($prefix, 1, 'content', __('Content', '_SBB')), getTitleFields($prefix), getRelationshipFields($prefix, 'news', 'news', __('Nieuws', '_SBB')))
];

return $block_data;