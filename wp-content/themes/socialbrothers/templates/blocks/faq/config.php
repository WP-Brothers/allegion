<?php

$prefix     = 'block_faq';

$fields = array_merge(getTabFields($prefix, 1, 'faq', __('FAQ', '_SBB')), faqFieldGroup($prefix));

$block_data = [
    'key'    => $prefix,
    'fields' => $fields
];

return $block_data;
