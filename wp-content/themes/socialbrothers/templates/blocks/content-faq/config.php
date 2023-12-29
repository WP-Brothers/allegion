<?php

$prefix     = 'block_content-faq';

$fields = array_merge(ContentFieldGroup($prefix), faqFieldGroup($prefix));

$block_data = [
    'key'    => $prefix,
    'fields' => $fields
];

return $block_data;
