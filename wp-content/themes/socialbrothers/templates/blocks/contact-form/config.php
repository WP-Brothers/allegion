<?php

$prefix     = 'block_contact_form';

$fields = array_merge(getTabFields($prefix, 0, 'form', __('Formulier', '_SBB')), getTitleFields($prefix), getSubTitleFields($prefix), getFormFields($prefix));

$block_data = [
    'key'    => $prefix,
    'title'  => __('Contact form', '_SBB'),
    'fields' => $fields,
];

return $block_data;
