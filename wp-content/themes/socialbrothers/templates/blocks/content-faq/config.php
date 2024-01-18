<?php

$prefix     = 'block_content-faq';

$fields = array_merge(ContentFieldGroup($prefix, 1 , 1, 1), faqFieldGroup($prefix));

$block_data = [
    'key'    => $prefix,
    'fields' => $fields
];

return $block_data;
