<?php

$prefix     = 'block_contact-hero';

$fields = array_merge(getTabFields($prefix, 1, 'content', __('Content', '_SBB')), getTitleFields($prefix), getSubTitleFields($prefix), getTabFields($prefix, 0, 'background', __('Achtergrond', '_SBB')), getImageFields($prefix));
$block_data = [
    'key'    => $prefix,
    'fields' => $fields
];

return $block_data;
